<x-layouts.landing title="Strategy Page">
    <section class="framework section-py-space mt-5" id="framework">
        <div class="title">
            <h2>Strategi Penanggulangan Kemiskinan</h2>
        </div>
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="text-center">Strategi Pemerintah Provinsi Kalimantan Selatan</h6>
                </div>
                @foreach($categories as $category)
                    @php
                        $total = 0;
                        $countProgram = 0;
                        $countKegiatan = 0;
                        $countSubKegiatan = 0;
                        $params = null;
                    @endphp
                    @foreach($strategies as $strategy)
                        @if($strategy['category_strategy_id'] == $category->category_strategy_id)
                            @php
                                $total += $strategy['total'];
                                $countProgram = count($strategy['program']);
                                $countKegiatan = count($strategy['kegiatan']);
                                $countSubKegiatan = count($strategy['subkegiatan']);
                                $countSubKegiatan = count($strategy['subkegiatan']);
                                $params = json_encode($strategy);
                            @endphp
                            @break
                        @endif
                    @endforeach
                    <div class="col-md-4">
                        <x-card class="rounded-5">
                            <x-slot:header>
                                <p style="margin-bottom: 0"
                                   class="text-center fw-bold">{{ $category->category_strategy_name }}</p>
                            </x-slot:header>
                            Total Anggaran : <label>Rp. {{ numberFormat($total) }}</label>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">Program</div>
                                    <span class="badge bg-primary rounded-pill"
                                          style="font-size: 11pt">{{ $countProgram }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">Kegiatan</div>
                                    <span class="badge bg-primary rounded-pill"
                                          style="font-size: 11pt">{{ $countKegiatan }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">Sub Kegiatan</div>
                                    <span class="badge bg-primary rounded-pill"
                                          style="font-size: 11pt">{{ $countSubKegiatan }}</span>
                                </li>
                            </ol>
                            <div class="d-grid mt-3">
                                <button data-params="{{$params}}" class="btn btn-primary-gradien btn-pill btn-views">
                                    <i class="bi bi-search"></i>
                                    Nomenklatur
                                </button>
                            </div>
                        </x-card>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-card>
                        <x-slot:header>
                            <h6 class="text-center">Strategi Pemerintah Kabupaten/Kota</h6>
                        </x-slot:header>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select class="form-select select2 select-city" name="city"
                                            style="width: 100%">
                                        <option value="">.: Pilih Pemerintah :.</option>
                                        @foreach($governments as $government)
                                            @if(!is_null($government->city_code))
                                                <option
                                                    value="{{ $government->city_code }}">{{ $government->government_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="loading-spinner text-center"></div>
                                <div class="load-html">
                                    <x-alert class-txt="text-dark" title="Filter data Wilayah terlebih dahulu"/>
                                </div>
                            </div>
                        </div>
                    </x-card>
                </div>
            </div>
            <x-modal id="modal-view" class="modal-lg" title="Strategi Nomenklatur">
                <div class="table-responsive">
                    <table class="table table-bordered table-xs">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Program / Kegiatan / Sub Kegiatan</th>
                            <th>Pagu Anggaran</th>
                        </tr>
                        </thead>
                        <tbody class="table-nomenklatur">
                        </tbody>
                    </table>
                </div>
            </x-modal>
        </div>
    </section>
    <x-landing.section-footer/>
    @includeIf('layouts.landing.partials.js')
    <x-slot:script>
        <script>
            $('.select-city').change(function () {
                const cityCode = $(this).val();
                console.log(cityCode)
                loadStrategiesCity(cityCode)
            })

            async function loadStrategiesCity(city) {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('strategy.load-strategy-city') }}',
                    data: {city},
                    beforeSend: function () {
                        $('.load-html').html(``)
                        $('.loading-spinner').html(`<span class="fa fa-spinner fa-spin fa-5x "></span>`)
                    },
                    success: (response) => {
                        console.log(response)
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

            $(document).on('click', '.btn-views', function () {
                const params = $(this).data('params');
                $('#modal-view').modal('show');
                if (params) {
                    const html = htmlNomenklatur(params);
                    $('.table-nomenklatur').html(html)
                } else {
                    $('.table-nomenklatur').html(`<tr><td colspan="3" class="text-center">Data nomenklatur tidak ada.</td></tr>`)
                }

            })

            const htmlNomenklatur = (params) => {
                const programs = params.program;
                const kegiatans = params.kegiatan;
                const subkegiatans = params.subkegiatan;
                let htmls = '';
                programs.forEach((prog) => {
                    htmls += `<tr class="bg-light">
                                <td>${prog.program_code}</td>
                                <td>${prog.program_name}</td>
                                <td class="text-end">${numberFormat(prog.total)}</td>
                              </tr>`
                    kegiatans.forEach((keg) => {
                        if (prog.program_code === keg.program_code) {
                            htmls += `<tr>
                                        <td>${keg.kegiatan_code}</td>
                                        <td>${keg.kegiatan_name}</td>
                                        <td class="text-end">${numberFormat(keg.total)}</td>
                                      </tr>`
                            subkegiatans.forEach((subKeg) => {
                                if (subKeg.kegiatan_code === keg.kegiatan_code) {
                                    htmls += `<tr>
                                                <td>${subKeg.subkegiatan_code}</td>
                                                <td>${subKeg.subkegiatan_name}</td>
                                                <td class="text-end">${numberFormat(subKeg.total)}</td>
                                              </tr>`
                                }
                            })

                        }
                    })
                });
                return htmls;
            }
        </script>
    </x-slot:script>
</x-layouts.landing>
