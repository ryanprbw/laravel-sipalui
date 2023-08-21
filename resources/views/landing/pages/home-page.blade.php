<x-layouts.landing title="Home Page">
    <style>
        .header-background {
            padding-top: 150px;
            padding-bottom: 100px;
            background-image: url('{{ asset('assets/images/backround_landing.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .text-header {
            background-color: rgba(255, 255, 255, 0.6);
            border: 0;
            border-radius: 25px;
        }
    </style>

    <section class="header-background">
        <div class="container">
            <div class="text-center">
                <div class="card text-header py-3">
                    <div class="card-body">
                        <p>
                            <img class="mb-4 " src="{{ asset('assets/images/logo_kalsel.png') }}" alt=""
                                 width="100" height="120">
                            <img class=" mx-3 mb-4 " src="{{ asset('assets/images/logo-bappeda.png') }}"
                                 alt=""
                                 width="150" height="150">
                        </p>


                        <h1 class="fw-bold"><span class="txt-danger fw-bold">SI</span> PALUI <span
                                class="txt-danger fw-bold">EKSIS</span></span></h1>
                        <h2>Sistem Informasi
                            <br><span> Penghapusan Kemiskinan Ekstrem Berbasis Geospasial Terintegerasi</span>
                        </h2>
                        <p style="font-size: 14pt" class="px-5">
                            Data Pensasaran Percepatan Penghapusan Kemiskinan Ekstrem (P3KE) adalah kumpulan informasi
                            dan data keluarga serta individu anggota keluarga hasil pemutakhiran Basis Data Keluarga
                            Indonesia (Pendataan Keluarga Badan Kependudukan dan Keluarga Berencana Nasional/PK-BKKBN
                            2021) di setiap wilayah pemutakhiran (RT/Dusun/RW) dan setiap tingkatan wilayah administrasi
                            (desa/kelurahan, kecamatan, kabupaten/kota, provinsi dan pusat) yang tersimpan dalam file
                            elektronik dan sudah divalidasi NIK oleh DUKCAPIL serta memiliki status kesejahteraan
                            (Desil).
                        </p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="{{ route('analytic') }}"
                               class="btn btn-primary-gradien btn-lg btn-pill px-4 gap-3"><i
                                    class="bi bi-search"></i> Data Analisa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="framework section-py-space light-bg" id="framework">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12 wow pulse">
                    <div class="title">
                        <h2>Sebaran Kemiskinan Kabupaten/Kota</h2>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home">
                            <div class="loading-spinner-distribution text-center"></div>
                            <div class="load-html-distribution"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="demo-section section-py-space" id="demo">
        <div class="title">
            <h2>Persentase Sebaran Kabupaten/Kota</h2>
        </div>
        <div class="custom-container">
            <div class="loading-spinner-distribution-persen text-center"></div>
            <div class="load-html-distribution-persen"></div>
        </div>
    </section>
    <section class="demo-section section-py-space" id="demo">
        <div class="title">
            <h2>Diagram Posisi Relatif Penduduk Miskin</h2>
        </div>
        <div class="custom-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="container-column-population"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="container-column-family"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-landing.section-footer/>
    @includeIf('layouts.landing.partials.js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <x-slot:script>
        <script>

            $(document).ready(function () {
                chartColumnPopulation();
                chartColumnFamily();
                getDistributionCity();
                getDistributionPersenCity();
            })

            const getDistributionCity = () => {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('home.load-distribution-city') }}',
                    data: {},
                    beforeSend: function () {
                        $('.load-html-distribution').html(``)
                        $('.loading-spinner-distribution').html(`<span class="fa fa-spinner fa-spin fa-5x "></span>`)
                    },
                    success: (response) => {
                        $('.load-html-distribution').html(response)
                    },
                    complete: function () {
                        $('.loading-spinner-distribution').html(``)
                    },
                    error: (request, status, error) => {
                        console.log(request.responseText);
                        $('.loading-spinner-distribution').html(``)
                        $('.load-html-distribution').html(`<x-alert title="Terjadi Kesalahan, silahkan Hubungi Admin." />`)
                    }
                })
            }

            const getDistributionPersenCity = () => {
                return $.ajax({
                    type: 'get',
                    dataType: "html",
                    url: '{{ route('home.load-distribution-persen-city') }}',
                    data: {},
                    beforeSend: function () {
                        $('.load-html-distribution-persen').html(``)
                        $('.loading-spinner-distribution-persen').html(`<span class="fa fa-spinner fa-spin fa-5x "></span>`)
                    },
                    success: (response) => {
                        $('.load-html-distribution-persen').html(response)
                    },
                    complete: function () {
                        $('.loading-spinner-distribution-persen').html(``)
                    },
                    error: (request, status, error) => {
                        console.log(request.responseText);
                        $('.loading-spinner-distribution-persen').html(``)
                        $('.load-html-distribution-persen').html(`<x-alert title="Terjadi Kesalahan, silahkan Hubungi Admin." />`)
                    }
                })
            }


            function chartColumnPopulation() {
                Highcharts.chart('container-column-population', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Penduduk Miskin'
                    },
                    xAxis: {
                        categories: @json($nameCities),
                    },
                    yAxis: {
                        title: {
                            useHTML: true,
                            text: 'Total Jiwa'
                        }
                    },
                    tooltip: {
                        headerFormat: `<span style="font-size:10px">{point.key}</span>`,
                        pointFormat: `<table><tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y}</b></td></tr></table>`,
                        footerFormat: '',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: @json($columnChartPopulations)
                });
            }

            function chartColumnFamily() {
                Highcharts.chart('container-column-family', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Keluarga Miskin'
                    },
                    xAxis: {
                        categories: @json($nameCities),
                    },
                    yAxis: {
                        title: {
                            useHTML: true,
                            text: 'Total Keluarga'
                        }
                    },
                    tooltip: {
                        headerFormat: `<span style="font-size:10px">{point.key}</span>`,
                        pointFormat: `<table><tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y}</b></td></tr></table>`,
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: @json($columnChartFamily)
                });
            }


        </script>
    </x-slot:script>
</x-layouts.landing>
