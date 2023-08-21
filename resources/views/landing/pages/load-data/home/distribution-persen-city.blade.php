<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div id="container-bubble"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-scroll">
                    <thead>
                    <tr>
                        <th width="5%" rowspan="2">No</th>
                        <th rowspan="2">Kabupaten/Kota</th>
                        <th colspan="3">Keluarga</th>
                        <th colspan="3">Individu</th>
                    </tr>
                    <tr>
                        @foreach($desil as $ds)
                            <th>Desil {{ $ds->desil_id }}</th>
                        @endforeach
                        @foreach($desil as $ds)
                            <th>Desil {{ $ds->desil_id }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $city)
                        @php($totalPopulation = $city->populations->sum('total'))
                        @php($totalFamily = $city->populations->sum('total'))
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$city->city_name}}</td>
                            @foreach($city->families as $df)
                                <td class="text-end">{{ round($df->total / $totalPopulation * 100, 2) }}</td>
                            @endforeach
                            @foreach($city->populations as $dp)
                                <td class="text-end">{{ round($dp->total / $totalPopulation * 100, 2) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        chartBubble();
    })

    function chartBubble() {
        Highcharts.chart('container-bubble', {
            chart: {
                type: 'packedbubble',
                height: '100%'
            },
            title: {
                text: 'Data Berdasarkan Kabupaten/Kota'
            },
            tooltip: {
                useHTML: true,
                pointFormat: '<b>{point.name}:</b> {point.value:1f}%</sub>'
            },
            plotOptions: {
                packedbubble: {
                    minSize: '10%',
                    maxSize: '70%',
                    zMin: 0,
                    zMax: 100,
                    layoutAlgorithm: {
                        gravitationalConstant: 0.05,
                        splitSeries: true,
                        seriesInteraction: false,
                        dragBetweenSeries: true,
                        parentNodeLimit: true
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}',
                        filter: {
                            property: 'y',
                            operator: '>',
                            value: 250
                        },

                    }
                }
            },
            series: @json($bubbles)
        });
    }
</script>
