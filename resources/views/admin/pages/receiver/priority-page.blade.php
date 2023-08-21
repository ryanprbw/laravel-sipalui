<x-layouts.admin title="Penerima">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Penerima Bantuan</h3>
        </x-slot>
        <li class="breadcrumb-item">Penerima</li>
        <li class="breadcrumb-item">Bantuan Prioritas</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    <form method="GET">
                        <div class="row">
                            <label>Filter</label>
                            <div class="col-md-4">
                                <select class="form-select select2 select-government" name="government"
                                        style="width: 100%"
                                        required>
                                    <option value="">.: Pemerintah Daerah :.</option>
                                    @foreach($governments  as $gov)
                                        <option
                                            data-government_id={{ $gov->government_id }}
                                            {{ $params['governmentID'] == $gov->government_id ? 'selected' : '' }}
                                                value="{{ encrypt($gov->government_id) }}">{{$gov->government_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select select2 select-agency" name="agency" style="width: 100%"
                                        required>
                                    <option value="">.: Pilih SKPD :.</option>
                                    @foreach($agencies as $agency)
                                        @if($agency->government_id == $params['governmentID'])
                                            <option {{ $params['agencyID'] == $agency->agency_id ? 'selected' : '' }}
                                                    value="{{ encrypt($agency->agency_id) }}">{{ $agency->agency_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="year" style="width: 100%" required>
                                    <option value="">.: Pilih Tahun :.</option>
                                    @for($i = startYear(); $i <= year('y'); $i++)
                                        <option {{ $i == $params['year'] ? 'selected' : '' }}
                                                value="{{ $i }}">{{'Tahun '. $i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-pill btn-air-primary btn-primary-gradien"><i
                                            class="bi bi-search"></i> Filter
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
        @if($params['governmentID'] && $params['agencyID'])
            <div class="row">
                <div class="col-md-4">
                    <x-card>
                        <div class="list-group">
                            @foreach($priorities as $priority)
                                <a href="{{ route('receive-priority', ['government' => encrypt($params['governmentID']), 'agency' => encrypt($params['agencyID']), 'priority' => $priority]) }}"
                                   class="list-group-item list-group-item-action fw-bold {{ $params['priorityID'] == $priority->assistance_priority_id ? 'active' : '' }}"
                                   aria-current="true">
                                    {{$priority->assistance_priority_name}}
                                    ({{$priority->assistance_priority_alias}})
                                </a>
                            @endforeach
                        </div>
                    </x-card>
                </div>
                <div class="col-md-8">
                    <x-card>
                        <x-slot:header>
                            <h5 class="ps-0">Data Penerima Bantuan</h5>
                        </x-slot:header>
                        <div class="mb-2">
                            <button class="btn btn-primary-gradien btn-add-modal"
                                    data-government="{{ encrypt($params['governmentID']) }}"
                                    data-agency="{{ encrypt($params['agencyID']) }}"
                                    data-priority="{{ encrypt($params['priorityID']) }}">
                                <i class="bi bi-plus"></i> Data Keluarga
                            </button>
                        </div>
                        <table class="table table-sm table-bordered datatable-priority" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="15%">#</th>
                                <th>NIK KK</th>
                                <th>Nama KK</th>
                                <th>Desil</th>
                                <th>Sumber Dana</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </x-card>
                </div>
            </div>
            <x-modal id="modal-add" title="Form Penerima Bantuan">
                <form method="POST" action="{{ route('receive-priority') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Kabupaten/Kota</label>
                        <select class="form-select select2 select-city" name="city_code" required style="width: 100%">
                            <option selected disabled value="">.: Pilih Kab / Kota :.</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->city_code }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Kecamatan</label>
                        <select class="form-select select2 select-district" name="district_code" required
                                style="width: 100%">
                            <option selected disabled value="">.: Pilih Kecamatan :.</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Kelurahan/Desa</label>
                        <select class="form-select select2 select-village" name="village_code" required
                                style="width: 100%">
                            <option selected disabled value="">.: Pilih Kelurahan/Desa :.</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Data Keluarga</label>
                        <select class="form-select select2 select-family" name="family_id" required style="width: 100%">
                            <option selected disabled value="">.: Pilih NIK Kepala Keluarga :.</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Sumber Dana</label>
                        <select class="form-control" name="source_fund_id" required style="width: 100%">
                            <option selected disabled value="">.: Pilih Sumber Dana :.</option>
                            @foreach($sourceFunds as $fund)
                                <option value="{{ $fund->source_fund_id }}">{{ $fund->source_fund_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input type="hidden" name="assistance_priority_id"/>
                    <x-input type="hidden" name="government_id"/>
                    <x-input type="hidden" name="agency_id"/>
                    <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                </form>
            </x-modal>
        @else
            <x-alert class-txt="txt-dark" title="Pilih Pemerintahan dan SKPD"/>
        @endif

    </div>
    @includeIf('js.select2')
    @includeIf('layouts.admin.partials.js')
    <script>
        $('.select-government').change(async function () {
            const govID = $(this).find('option:selected').data('government_id')
            const dataAgency = await loadAgency(govID);
            let htmls = '<option value="">.: Pilih SKPD :.</option>'
            htmls += dataAgency.data.map((agency) => `<option value="${agency.encrypt_id}">${agency.agency_name}</option>`)
            $('.select-agency').html(htmls);
        })

        $('.select-city').change(async function () {
            const city_code = $(this).val();
            const loadDistrict = await loadDistricts(city_code);
            let htmls = `<option value="">.: Pilih Kecamatan :.</option>`
            loadDistrict.data.map((district) => {
                htmls += `<option data-city_code="${city_code}" value="${district.district_code}">${district.district_name}</option>`
            })
            $('.select-district').html(htmls)
        })

        $('.select-district').change(async function () {
            const city_code = $(this).find('option:selected').data('city_code');
            const district_code = $(this).val();
            const loadVillage = await loadVillages(city_code, district_code);
            let htmls = `<option value="">.: Pilih Kelurahan/Desa :.</option>`
            loadVillage.data.map((village) => {
                htmls += `<option data-city_code="${city_code}"
                                    data-district_code="${district_code}"
                                    value="${village.village_code}">${village.village_name}</option>`
            })
            $('.select-village').html(htmls)
        })

        $('.select-village').change(async function () {
            const city_code = $(this).find('option:selected').data('city_code');
            const district_code = $(this).find('option:selected').data('district_code');
            const village_code = $(this).val();
            const dataFamily = await loadFamily(city_code, district_code, village_code);
            let htmls = `<option value="">.: Pilih NIK Kepala Keluarga :.</option>`
            dataFamily.data.map((family) => {
                htmls += `<option value="${family.encryptID}">${family.population_nik} - ${family.population.population_name}</option>`
            })
            $('.select-family').html(htmls)
        })

        $('.btn-add-modal').click(function (e) {
            $('#modal-add').modal('show');
            const priority = $(this).data('priority')
            const government = $(this).data('government')
            const agency = $(this).data('agency')
            $('.assistance_priority_id').val(priority)
            $('.government_id').val(government)
            $('.agency_id').val(agency)
        });

        $(function () {
            $('.datatable-priority').DataTable({
                processing: true,
                serverSide: true,
                info: true,
                autoWidth: true,
                pageLength: 50,
                ajax: {
                    url: '{!! route('receive-priority-datatable') !!}',
                    type: 'GET',
                    data: {
                        government: '{{$params['governmentID'] ?? ''}}',
                        priority: '{{$params['priorityID'] ?? ''}}',
                        year: '{{$params['year'] ?? ''}}',
                    }
                },
                columnDefs: [
                    {"class": false, "targets": [-1]}
                ],
                columns: [
                    {data: 'family_id', name: 'family_id'},
                    {data: 'population_nik', name: 'population_nik'},
                    {data: 'population_name', name: 'population.population_name'},
                    {data: 'desil', name: 'population.desil', className: "text-center"},
                    {data: 'source_fund_name', name: 'source_fund.source_fund_name', className: "text-center"},
                    {
                        render: function (data, type, row) {
                            return `<button data-receiver_priority_id="${row.receiver_priority_id}" class="btn btn-danger-gradien btn-delete"><i class="bi bi-trash"></button>`;
                        },
                        className: "text-center",
                    }
                ],
            });

            $(document).on('click', '.btn-delete', function () {
                const ID = $(this).data('receiver_priority_id')
                swalAction(BASEURL(`receiver/priority/${ID}`),
                    {_token: "{{ csrf_token() }}"},
                    {method: 'delete'}
                )
            })
        });

        const loadAgency = (government) => {
            return $.getJSON(BASEURL(`government/load-agency-government`), {government});
        }

        const loadDistricts = (city_code) => {
            return $.getJSON(BASEURL(`reference/district/load-district/${city_code}`));
        }

        const loadVillages = (city_code, district_code) => {
            return $.getJSON(BASEURL(`reference/village/load-village/${city_code}/${district_code}`));
        }

        const loadFamily = (city_code, district_code, village_code) => {
            return $.getJSON(BASEURL(`p3ke/load-family-region`), {city_code, district_code, village_code});
        }
    </script>
</x-layouts.admin>
