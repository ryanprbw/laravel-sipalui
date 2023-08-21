<x-layouts.landing title="Analytic Page">
    <section class="framework section-py-space mt-5" id="framework">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12 wow pulse">
                    <div class="title">
                        <h2>Data Analisa</h2>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home">
                            <x-card>
                                <form method="GET">
                                    <label>Pilih Wilayah :</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-select select2 select-city" name="city"
                                                    style="width: 100%" required>
                                                <option value="">.: Pilih Kabupaten :.</option>
                                                @foreach($cities as $ct)
                                                    <option
                                                        {{ $ct->city_code == $params['cityCode'] ? 'selected' : '' }}
                                                        value="{{ $ct->city_code }}">{{ $ct->city_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select select2 select-year" name="year"
                                                    style="width: 100%" required>
                                                <option value="">.: Pilih Tahun :.</option>
                                                @for($i = date('Y'); $i <= 2022; $i++)
                                                    <option
                                                        {{ $i == $params['year'] ? 'selected' : '' }} value="{{$i}}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4 d-grid">
                                            <button class="btn btn-primary-gradien filter-distribution"><i
                                                    class="bi bi-filter"></i> Filter Data
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </x-card>
                            @if($params['cityCode'] && $params['year'])
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                                <h5>{{ $city->city_name }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3 tabs-responsive-side">
                                                        <div class="nav flex-column nav-pills border-tab nav-left"
                                                             id="v-pills-tab" role="tablist"
                                                             aria-orientation="vertical">
                                                            <a class="nav-link tab-href" id="v-pills-home-tab"
                                                               data-params="{{ json_encode($params) }}"
                                                               data-bs-toggle="pill" aria-selected="true"
                                                               href="#assistance">Bantuan</a>
                                                            <a class="nav-link tab-href" id="v-pills-profile-tab"
                                                               data-params="{{ json_encode($params) }}"
                                                               data-bs-toggle="pill" href="#facility">Fasilitas</a>
                                                            @foreach($strategies as $strategy)
                                                                <a class="nav-link tab-href" id="v-pills-profile-tab"
                                                                   data-params="{{ json_encode(array_merge($strategy->toArray(), $params)) }}"
                                                                   data-bs-toggle="pill"
                                                                   href="#strategy-{{ $strategy['category_strategy_id'] }}">{{ $strategy['category_strategy_name'] }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="tab-content" id="v-pills-tabContent">
                                                            <div class="tab-pane fade" id="assistance"
                                                                 role="tabpanel">
                                                            </div>
                                                            <div class="tab-pane fade" id="facility"
                                                                 role="tabpanel"></div>
                                                            @foreach($strategies as $strategy)
                                                                <div class="tab-pane fade"
                                                                     id="strategy-{{ $strategy['category_strategy_id'] }}"
                                                                     role="tabpanel"></div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <x-alert class-txt="text-dark" title="Filter data Wilayah dan Tahun."/>
                            @endif
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
            $('.tab-href').click(function () {
                const attrHref = $(this).attr("href");
                const params = $(this).data("params");
                if (attrHref === '#assistance') {
                    getAnalyticAssistance(params.cityCode, params.year)
                } else if (attrHref === '#facility') {
                    getAnalyticFacility(params.cityCode, params.year)
                } else if (attrHref === '#strategy-1' || attrHref === '#strategy-2' || attrHref === '#strategy-3') {
                    getAnalyticStrategy(params.cityCode, params.year, params.category_strategy_id)
                } else {
                    $(`${attrHref}`).html(`<p>Not Found.</p>`)
                }
            })

            const getAnalyticAssistance = async (city, year) => {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('analytic.load-data-assistance') }}',
                    data: {city, year},
                    success: (response) => {
                        $(`#assistance`).html(response)
                    },
                    error: (request, status, error) => {
                        console.log(request.responseText);
                    }
                })
            }
            const getAnalyticStrategy = async (city, year, strategy_id) => {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('analytic.load-data-strategy') }}',
                    data: {city, year, strategy_id},
                    success: (response) => {
                        $(`#strategy-${strategy_id}`).html(response)
                    },
                    error: (request, status, error) => {
                        console.log(request.responseText);
                    }
                })
            }

            const getAnalyticFacility = async (city, year) => {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('analytic.load-data-facility') }}',
                    data: {city, year},
                    success: (response) => {
                        $(`#facility`).html(response)
                    },
                    error: (request, status, error) => {
                        console.log(request.responseText);
                    }
                })
            }
        </script>
    </x-slot:script>
</x-layouts.landing>
