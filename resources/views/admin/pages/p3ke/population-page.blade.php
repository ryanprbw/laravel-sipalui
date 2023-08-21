<x-layouts.admin title="Penduduk">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Data Penduduk</h3>
        </x-slot>
        <li class="breadcrumb-item">P3KE</li>
        <li class="breadcrumb-item">Penduduk</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="GET">
                    <x-card>
                        <label>Pilih Wilayah :</label>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Kabupaten</label>
                                <select class="form-select select2 select-city" name="city" style="width: 100%">
                                    <option value="">.: Pilih Kabupaten :.</option>
                                    @foreach($cities as $city)
                                        <option
                                            {{ $params['city'] == $city->city_code ? 'selected' : '' }} value="{{ $city->city_code }}">{{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Kecamatan</label>
                                <select class="form-select select2 select-district" name="district" style="width: 100%">
                                    <option value="">.: Pilih Kecamatan :.</option>
                                    @foreach($districts as $district)
                                        @if($params['city'] == $district->city_code)
                                            <option
                                                {{ $params['city'] == $district->city_code && $params['district'] == $district->district_code ? 'selected' : '' }}
                                                value="{{ $district->district_code }}">{{ $district->district_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Kel / Desa</label>
                                <select class="form-select select2 select-village" name="village" style="width: 100%">
                                    <option value="">.: Pilih Kel / Desa :.</option>
                                    @foreach($villages as $village)
                                        @if($params['city'] == $village->city_code &&  $params['district'] == $village->district_code)
                                            <option
                                                {{ $params['city'] == $village->city_code
                                                    && $params['district'] == $village->district_code
                                                    && $params['village'] == $village->village_code ? 'selected' : '' }}
                                                value="{{ $village->village_code }}">{{ $village->village_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary-gradien"><i class="bi bi-filter"></i> Filter Data</button>
                        </div>
                    </x-card>
                </form>

            </div>
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5>Data Penduduk</h5>
                    @endslot
                    <table class="table table-bordered datatable-populations" style="width: 100%">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Kab / Kota</th>
                            <th>Kecamatan</th>
                            <th>Kel / Desa</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status Keluarga</th>
                            <th>Status Kawin</th>
                            <th>Status Desil</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </x-card>
            </div>
        </div>
        @includeIf('layouts.admin.partials.js')
        @slot('script')
            <script>
                $(function () {
                    $('.datatable-populations').DataTable({
                        processing: true,
                        serverSide: true,
                        info: true,
                        autoWidth: true,
                        pageLength: 50,
                        ajax: {
                            url: '{!! route('population-datatable') !!}',
                            type: 'GET',
                            data: {
                                city_code: '{{$params['city']}}',
                                district_code: '{{$params['district']}}',
                                village_code: '{{$params['village']}}',
                            }
                        },
                        columnDefs: [
                            {"searchable": false, "targets": [1, 2, 3]}
                        ],
                        columns: [
                            {data: 'family_id', name: 'family_id'},
                            {data: 'city', name: 'city.city_name'},
                            {data: 'district', name: 'district.district_name'},
                            {data: 'village', name: 'village.village_name'},
                            {data: 'population_nik', name: 'population_nik'},
                            {data: 'population_name', name: 'population_name'},
                            {data: 'population_address', name: 'population_address'},
                            {
                                data: 'family_relation_name',
                                name: 'uti_family_relations.family_relation_name',
                                class: 'text-center'
                            },
                            {data: 'status_marry', name: 'status_marry', class: 'text-center'},
                            {data: 'desil_id', name: 'desil_id', class: 'text-center'},
                        ],
                    });
                });


                $('.select-city').change(async function () {
                    const cityCode = $(this).val()
                    const htmls = await selectDistrict(cityCode)
                    $('.select-district').html(htmls)
                })

                $('.select-district').change(async function () {
                    const cityCode = $(this).find('option:selected').data('city_code')
                    const districtCode = $(this).val()
                    const htmls = await selectVillage(cityCode, districtCode)
                    $('.select-village').html(htmls)
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
            </script>
    @endslot
</x-layouts.admin>
