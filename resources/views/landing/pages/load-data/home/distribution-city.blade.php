<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="container-pie-family"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="container-pie-population"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-25">
                    <thead>
                    <tr>
                        <th width="5%" rowspan="2">No</th>
                        <th rowspan="2">Kabupaten/Kota</th>
                        <th colspan="4">Keluarga</th>
                        <th colspan="4">Individu</th>
                    </tr>
                    <tr>
                        @foreach($desil as $ds)
                            <th>Desil {{ $ds->desil_id }}</th>
                        @endforeach
                        <th>Jumlah</th>

                        @foreach($desil as $ds)
                            <th>Desil {{ $ds->desil_id }}</th>
                        @endforeach
                        <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $city)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$city->city_name}}</td>

                            @foreach($city->families as $df)
                                <td class="text-end">{{ numberFormat($df->total)  }}</td>
                            @endforeach
                            <td class="text-end">
                                <b>{{ numberFormat($city->families->sum('total')) }}</b></td>
                            @foreach($city->populations as $dp)
                                <td class="text-end">{{ numberFormat($dp->total)  }}</td>
                            @endforeach
                            <td class="text-end">{{ numberFormat($city->populations->sum('total')) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-center" colspan="2">Total</td>
                        @php($totalDf = 0)
                        @foreach($desilFamily as $ttlDf)
                            @php($totalDf += $ttlDf['total'])
                            <td class="text-end">{{ numberFormat($ttlDf['total']) }}</td>
                        @endforeach
                        <td class="text-end">{{ numberFormat($totalDf) }}</td>
                        @php($totalDp = 0)
                        @foreach($desilPopulation as $ttlDp)
                            @php($totalDp += $ttlDp['total'])
                            <td class="text-end">{{ numberFormat($ttlDp['total']) }}</td>
                        @endforeach
                        <td class="text-end">{{ numberFormat($totalDp) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        chartPiePopulation();
        chartPieFamily();
    })

    function chartPieFamily() {
        Highcharts.chart('container-pie-family', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Keluarga'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Persentasi',
                colorByPoint: true,
                data: @json($columnFamilies)
            }]
        });
    }

    function chartPiePopulation() {
        Highcharts.chart('container-pie-population', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Individu'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: @json($columnPopulations)
            }]
        });
    }
</script>
