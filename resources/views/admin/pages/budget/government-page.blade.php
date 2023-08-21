<x-layouts.admin title="Anggaran">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Anggaran Pemerintah Daerah</h3>
        </x-slot>
        <li class="breadcrumb-item">Anggaran</li>
        <li class="breadcrumb-item">Pemerintah Daerah</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="GET">
                    <x-card>
                        <div class="row">
                            <label>Filter</label>
                            <div class="col-md-4">
                                <select class="form-select select2" name="government" style="width: 100%" required>
                                    <option value="">.: Pemerintah Daerah :.</option>
                                    @foreach($governmentsLocal as $govLocal)
                                        <option
                                            {{ $params['government'] == $govLocal->government_id ? 'selected' : '' }}
                                            value="{{ encrypt($govLocal->government_id) }}">{{$govLocal->government_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" name="year" style="width: 100%" required>
                                    <option value="">.: Pilih Tahun :.</option>
                                    @for($i = startYear(); $i <= year('y'); $i++)
                                        <option {{ $i == $params['year'] ? 'selected' : '' }}
                                                value="{{ $i }}">{{'Tahun '. $i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-pill btn-air-primary btn-primary-gradien"><i
                                            class="bi bi-search"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </x-card>
                </form>
            </div>

            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5 class="ps-0">Data Pagu Anggaran</h5>
                    @endslot
                    @if ($params['government'] && $params['year'])
                        <div class="mb-2">
                            <button class="btn btn-primary-gradien btn-add-modal"
                                    data-position="{{ $local['position'] }}"
                                    data-government="{{ $params['government'] }}"
                                    data-year="{{ $params['year'] }}">
                                <i class="bi bi-plus"></i> Sub Kegiatan
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" style="width: 100%">
                                <thead>
                                <tr>
                                    <th width="5%">Kode</th>
                                    <th>Sub Kegiatan</th>
                                    <th width="15%">Pagu Anggaran</th>
                                    <th width="15"><i class="bi bi-code"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-secondary">
                                    <td colspan="2" class=" fw-bold">Total Anggaran</td>
                                    <td class="text-end fw-bold">
                                        {{ numberFormat($budgets->sum('budget_government_ceiling')) }}
                                    </td>

                                    <td></td>
                                </tr>
                                @forelse($budgets as $budget)
                                    <tr>
                                        <td>{{ $budget->subkegiatan_code }}</td>
                                        <td>{{ $budget->subkegiatan->subkegiatan_name }}</td>
                                        <td class="text-end">
                                            {{ numberFormat($budget->budget_government_ceiling) }}
                                        </td>
                                        <td class="text-center">
                                            {!! btnAction('delete', classBtn: 'btn-pill btn-xs') !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <x-alert title="Tidak ada data anggaran"/>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <x-modal id="modal-add" title="Form Input Anggaran">
                            <form method="POST" action="{{ route('budget-government') }}">
                                @csrf
                                <div class="mb-3">
                                    <label>Sub Kegiatan</label>
                                    <select class="form-control select2serverside" name="" required style="width: 100%">
                                        <option selected disabled value="">.: Pilih Sub Kegiatan :.</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Strategi</label>
                                    <select class="form-control" name="category_strategy_id" required
                                            style="width: 100%">
                                        <option selected disabled value="">.: Pilih Strategi :.</option>
                                        @foreach($strategies as $strategy)
                                            <option value="{{ $strategy->category_strategy_id }}">
                                                {{$strategy->category_strategy_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" name="budget_government_ceiling" class="form-control "
                                           placeholder="Pagu Anggaran" required>
                                    <span class="input-group-text">,00</span>
                                </div>
                                <x-input type="hidden" name="budget_government_year"/>
                                <x-input type="hidden" name="government_id"/>
                                <x-input type="hidden" name="position"/>
                                <x-input type="hidden" name="urusan_code"/>
                                <x-input type="hidden" name="bidang_code"/>
                                <x-input type="hidden" name="program_code"/>
                                <x-input type="hidden" name="kegiatan_code"/>
                                <x-input type="hidden" name="subkegiatan_code"/>
                                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                            </form>
                        </x-modal>
                    @else
                        <x-alert title="Pilih Pemerintahan da Tahun"/>
                    @endif

                </x-card>
            </div>
        </div>
        @includeIf('js.select2')
        @includeIf('layouts.admin.partials.js')
        @slot('script')
            <script>
                $('.btn-add-modal').click(function (e) {
                    $('#modal-add').modal('show');
                    const year = $(this).data('year')
                    const government = $(this).data('government')
                    const position = $(this).data('position')
                    $('.budget_government_year').val(year)
                    $('.government_id').val(government)
                    $('.position').val(position)
                });

                $('.btn-delete').click(function () {
                    const params = $(this).data('params')
                    swalAction(BASEURL(`government/local/${params.government_id}`),
                        {_token: "{{ csrf_token() }}"},
                        {method: 'delete'}
                    )
                });

                $(function () {
                    $('.select2serverside').select2({
                        placeholder: "Pilih Sub Kegiatan",
                        templateResult: format,
                        templateSelection: formatSelection,
                        minimumInputLength: 5,
                        multiple: false,
                        ajax: {
                            type: 'post',
                            url: '{{ route('select-subkegiatan') }}',
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    _token: "{{ csrf_token() }}",
                                    position: "{{ $local['position'] ?? '' }}",
                                    search: params.term,
                                    page: params.page
                                };
                            },
                            processResults: function (data, params) {
                                params.page = params.page || 1;
                                return {
                                    results: data.items
                                };
                            },
                        }
                        // cache: true;
                    });
                    $(".select2serverside").change(async function () {
                        const response = $(this).select2('data');
                        const subkegiatanID = (response[0].subkegiatan_id).toString();
                        const dataSub = await loadSubKegiatan(subkegiatanID);
                        $('.urusan_code').val(dataSub.data[0].urusan_code)
                        $('.bidang_code').val(dataSub.data[0].bidang_code)
                        $('.program_code').val(dataSub.data[0].program_code)
                        $('.kegiatan_code').val(dataSub.data[0].kegiatan_code)
                        $('.subkegiatan_code').val(dataSub.data[0].subkegiatan_code)
                    });
                });

                const loadSubKegiatan = (subkegiatanID) => {
                    return $.getJSON(BASEURL(`reference/nomenclature/load-subkegiatan-id/${subkegiatanID}`));
                }
            </script>
    @endslot
</x-layouts.admin>
