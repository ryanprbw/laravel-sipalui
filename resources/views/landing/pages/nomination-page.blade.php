<x-layouts.landing title="Distribution Page">
    <section class="framework section-py-space mt-5" id="framework">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12 wow pulse">
                    <div class="title">
                        <h2>Daftar Nominasi Bantuan</h2>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home">
                            <x-card>
                                <form method="get">
                                    <label>Pilih Wilayah :</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="form-select select2 select-city" required name="city"
                                                    style="width: 100%">
                                                <option value="">.: Pilih Kabupaten :.</option>
                                                @foreach($cities as $city)
                                                    <option
                                                        {{ $city->city_code == $params['cityCode'] ? 'selected' : '' }}
                                                        value="{{ $city->city_code }}">{{ $city->city_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select select2 select-district" required name="strategy"
                                                    style="width: 100%">
                                                <option value="">.: Pilih Strategi :.</option>
                                                @foreach($strategies as $strategy)
                                                    <option
                                                        {{ $strategy->category_strategy_id == $params['strategyID'] ? 'selected' : '' }}
                                                        value="{{ $strategy->category_strategy_id }}">{{ $strategy->category_strategy_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select select2 select-year" required name="year"
                                                    style="width: 100%" required>
                                                <option value="">.: Pilih Tahun :.</option>
                                                @for($i = date('Y'); $i <= 2022; $i++)
                                                    <option
                                                        {{ $i == $params['year'] ? 'selected' : '' }} value="{{$i}}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-3 d-grid">
                                            <button class="btn btn-primary-gradien filter-distribution">
                                                <i class="bi bi-filter"></i> Filter Data
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </x-card>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    @if($params['cityCode'])
                                        <x-card>
                                            <table class="table table-bordered table-sm table-25">
                                                <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Umur</th>
                                                    <th>Desil</th>
                                                    <th>Pekerjaan</th>
                                                    <th>Pendidikan</th>
                                                    <th>Status Menikah</th>
                                                    <th>Stunting</th>
                                                    <th width="10%">#</th>
                                                    <th width="10%">#</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($nominations as $i => $nomination)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $nomination->population_name }}</td>
                                                        <td class="text-center">{{  formatDateIndo($nomination->population_date_birth)  }}</td>
                                                        <td class="text-center">{{ calculateAge($nomination->population_date_birth).' Tahun' }}</td>
                                                        <td class="text-center">{{ $nomination->desil_id }}</td>
                                                        <td class="text-center">{{ $nomination->population_job }}</td>
                                                        <td class="text-center">{{ $nomination->population_education }}</td>
                                                        <td class="text-center">{{ $nomination->status_marry }}</td>
                                                        <td class="text-center">{{ $nomination->stunting_risk_desc }}</td>
                                                        <td class="text-center">
                                                            <button data-family_id="{{ $nomination->family_id }}"
                                                                    class="btn btn-danger btn-sm btn-facility">
                                                                Fasilitas
                                                            </button>
                                                        </td>
                                                        <td class="text-center">
                                                            <button data-family_id="{{ $nomination->family_id }}"
                                                                    data-year="{{ $nomination->year }}"
                                                                    class="btn btn-primary btn-sm btn-receiver">
                                                                Bantuan
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </x-card>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                    <x-modal class="modal-lg" id="modal-facility" title="Daftar fasilitas yang dimiliki.">
                        <div class="html-facility"></div>
                    </x-modal>
                    <x-modal class="" id="modal-receiver" title="Daftar Bantuan yang dimiliki.">
                        <div class="html-receiver"></div>
                    </x-modal>
                </div>
            </div>
        </div>
    </section>
    <x-landing.section-footer/>
    @includeIf('layouts.landing.partials.js')
    <x-slot:script>
        <script>
            $('.btn-facility').click(async function () {
                const familyID = $(this).data('family_id')
                await htmlFacilityPopulation(familyID);
                $('#modal-facility').modal('show');
            })
            $('.btn-receiver').click(async function () {
                const familyID = $(this).data('family_id')
                const year = $(this).data('year')
                await htmlReceiverPopulation(familyID, year);
                $('#modal-receiver').modal('show');
            })

            const htmlFacilityPopulation = (familyID) => {
                return $.ajax({
                    type: 'get',
                    url: '{{ route('nomination.load-facility') }}',
                    data: {family: familyID},
                    success: (response) => {
                        $('.html-facility').html(response)
                    }
                })
            }

            const htmlReceiverPopulation = (familyID, year) => {
                return $.ajax({
                    type: 'get',
                    url: '{{ route('nomination.load-receiver') }}',
                    data: {family: familyID, year},
                    success: (response) => {
                        $('.html-receiver').html(response)
                    }
                })
            }

        </script>
    </x-slot:script>
</x-layouts.landing>
