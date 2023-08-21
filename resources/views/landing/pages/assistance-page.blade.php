<x-layouts.landing title="Assistance Page">
    <section class="demo-section section-py-space mt-5 light-bg" id="demo">
        <div class="title">
            <h2>Sebaran Bantuan Kabupaten/Kota</h2>
        </div>
        <div class="custom-container">
            <div class="loading-spinner-analytic text-center">
                <span class="fa fa-spinner fa-spin fa-5x "></span>
            </div>
            <div class="load-html-analytic"></div>
        </div>
    </section>
    <section class="framework section-py-space " id="framework">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Penerima Bantuan</h2>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home">
                            <x-card>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Pilih Wilayah :</label>
                                                <div class="mb-3">
                                                    <select class="form-select select2 select-city" name="city" required
                                                            style="width: 100%">
                                                        <option value="">.: Pilih Kabupaten :.</option>
                                                        @foreach($cities as $city)
                                                            <option
                                                                value="{{ $city->city_code }}">{{ $city->city_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-select select2 select-district" name="district"
                                                            required
                                                            style="width: 100%">
                                                        <option value="">.: Pilih Kecamatan :.</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-select select2 select-village" name="village"
                                                            required style="width: 100%">
                                                        <option value="">.: Pilih Kel / Desa :.</option>
                                                    </select>
                                                </div>
                                                <div class="d-grid">
                                                    <button class="btn btn-primary-gradien filter-assistance"><i
                                                            class="bi bi-filter"></i> Filter Data
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Pilih Desil :</label>
                                                <select class="form-select select-desil">
                                                    <option value="">.: Semua Desil :.</option>
                                                    @foreach($desil as $ds)
                                                        <option
                                                            value="{{ $ds->desil_id }}">{{ 'Desil '.$ds->desil_id.' ('. $ds->desil_name.')' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Keterangan :</label>
                                        <ol class="list-group list-group-numbered">
                                            @foreach($priorities as $priority)
                                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto">
                                                        {{ $priority->assistance_priority_name }}
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">
                                                        {{ $priority->assistance_priority_alias }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </x-card>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="loading-spinner text-center"></div>
                                    <div class="load-html">
                                        <x-alert class-txt="text-dark"
                                                 title="Filter data Wilayah terlebih dahulu"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-landing.section-footer/>
    @includeIf('layouts.landing.partials.js')
    <x-slot:script>
        <script>
            $(document).ready(function () {
                getCityAssistanceDesil();
            })
            const getCityAssistanceDesil = () => {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('assistance.load-city-assistance-desil') }}',
                    data: {},
                    beforeSend: function () {
                        $('.load-html-analytic').html(``)
                        $('.loading-spinner-analytic').html(`<span class="fa fa-spinner fa-spin fa-5x "></span>`)
                    },
                    success: (response) => {
                        $('.load-html-analytic').html(response)
                    },
                    complete: function () {
                        $('.loading-spinner-analytic').html(``)
                    },
                    error: (request, status, error) => {
                        console.log(request.responseText);
                        $('.loading-spinner-analytic').html(``)
                        $('.load-html-analytic').html(`<x-alert title="Terjadi Kesalahan, silahkan Hubungi Admin." />`)
                    }
                })
            }

            $('.select-city').change(async function () {
                const cityCode = $(this).val()
                const htmls = await selectDistrict(cityCode)
                $('.select-district').html(htmls)
            })

            $('.select-district').change(async function () {
                const cityCode = $(this).find('option:selected').data('city_code')
                console.log('City ' + cityCode)
                const districtCode = $(this).val()
                const htmls = await selectVillage(cityCode, districtCode)
                $('.select-village').html(htmls)
            })

            $('.filter-assistance').click(async function () {
                const cityCode = $('.select-city').val();
                const districtCode = $('.select-district').val();
                const villageCode = $('.select-village').val();
                const desilID = $('.select-desil').val();
                if (cityCode == '' || districtCode == '' || villageCode == '') {
                    $('.load-html').html(`<x-alert type="danger" class-txt="text-dark" title="Filter data Wilayah tidak boleh ada yang kosong."/>`)
                } else {
                    await getAssistanceFamily(cityCode, districtCode, villageCode, desilID);
                }
            })

            async function selectDistrict(cityCode, districtCode = null) {
                const loadDistrict = await getDistrict(cityCode);
                const districts = loadDistrict.data;
                let htmls = '<option  selected value="">.: Pilih Kecamatan :.</option>';
                if (districts.length) {
                    districts.forEach((district) => {
                        const attr = districtCode === district.district_code ? 'selected' : '';
                        htmls += `<option ${attr} data-city_code="${district.city_code}" value="${district.district_code}">${district.district_name}</option>`;
                    });
                }
                return htmls;
            }

            async function selectVillage(cityCode, districtCode, villageCode = null) {
                const loadVillage = await getVillage(cityCode, districtCode);
                const villages = loadVillage.data;
                let htmls = '<option selected value="">.: Pilih Kelurahan / Desa :.</option>';
                if (villages.length) {
                    villages.forEach((village) => {
                        const attr = villageCode === village.village_code ? 'selected' : '';
                        htmls += `<option ${attr} value="${village.village_code}">${village.village_name}</option>`;
                    });
                }
                return htmls;
            }

            const getDistrict = (cityCode) => {
                return $.getJSON(BASEURL(`reference/district/load-district/${cityCode}`))
            }

            const getVillage = (cityCode, districtCode) => {
                return $.getJSON(BASEURL(`reference/village/load-village/${cityCode}/${districtCode}`))
            }

            const getAssistanceFamily = async (city_code, district_code, village_code, desil_id) => {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('assistance.load-data-family') }}',
                    data: {city_code, district_code, village_code, desil_id},
                    beforeSend: function () {
                        $('.load-html').html(``)
                        $('.loading-spinner').html(`<span class="fa fa-spinner fa-spin fa-5x "></span>`)
                    },
                    success: (response) => {
                        $('.load-html').html(response)
                    },
                    complete: function () {
                        $('.loading-spinner').html(``)
                    },
                    error: (request, status, error) => {
                        console.log(request.responseText);
                    }
                })
            }
        </script>
    </x-slot:script>
</x-layouts.landing>
