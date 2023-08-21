<x-layouts.landing title="Distribution Page">
    <section class="framework section-py-space mt-5" id="framework">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12 wow pulse">
                    <div class="title">
                        <h2>Sebaran Data</h2>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home">
                            <x-card>
                                <label>Pilih Wilayah :</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-select select2 select-city" name="city" style="width: 100%">
                                            <option value="">.: Pilih Kabupaten :.</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->city_code }}">{{ $city->city_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select select2 select-district" name="district"
                                                style="width: 100%">
                                            <option value="">.: Pilih Kecamatan :.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 d-grid">
                                        <button class="btn btn-primary-gradien filter-distribution"><i
                                                class="bi bi-filter"></i> Filter Data
                                        </button>
                                    </div>
                                </div>

                            </x-card>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="loading-spinner text-center"></div>
                                    <div class="load-html">
                                        <x-alert class-txt="text-dark" title="Filter data Wilayah terlebih dahulu"/>
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

            $('.select-city').change(async function () {
                const cityCode = $(this).val()
                const htmls = await selectDistrict(cityCode)
                $('.select-district').html(htmls)
            })

            $('.filter-distribution').click(async function () {
                const cityCode = $('.select-city').val();
                const districtCode = $('.select-district').val();
                await loadDistribution(cityCode, districtCode);

            })

            async function loadDistribution(city_code, district_code) {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('distribution.load-data') }}',
                    data: {city_code, district_code},
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

            async function loadCity(city_code) {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('distribution.load-data') }}',
                    data: {city_code},
                    beforeSend: function () {
                        $('.loading-spinner').html(`<span class="fa fa-spinner fa-spin fa-5x "></span>`)
                    },
                    success: (response) => {
                        console.log('sukses')
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

            const getDistrict = (cityCode) => {
                return $.getJSON(BASEURL(`reference/district/load-district/${cityCode}`))
            }

        </script>
    </x-slot:script>
</x-layouts.landing>
