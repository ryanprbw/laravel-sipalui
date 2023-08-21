<table class="table table-bordered">
    <thead>
    <tr>
        <th width="5%" rowspan="2">#</th>
        <th rowspan="2">Desa</th>
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
    @foreach($villages as $village)
        <tr>
            <td>{{$village->prov_code.sprintfNumber($village->city_code,2).sprintfNumber($village->district_code,2).$village->village_code}}</td>
            <td>{{$village->village_name}}</td>
            @foreach($desil as $ds)
                @php($familyTotal = 0)
                @foreach($village->families as $df)
                    @if($df->desil_id == $ds->desil_id)
                        @php($familyTotal = $df->total)
                        @break
                    @endif
                @endforeach
                <td class="text-end">
                    {{ numberFormat($familyTotal)  }}
                </td>
            @endforeach
            <td class="text-end">
                <b>{{ numberFormat($village->families->sum('total')) }}</b>
            </td>
            @foreach($desil as $ds)
                @php($populationTotal = 0)
                @foreach($village->populations as $dp)
                    @if($dp->desil_id == $ds->desil_id)
                        @php($populationTotal = $dp->total)
                        @break
                    @endif
                @endforeach
                <td class="text-end">
                    {{ numberFormat($populationTotal)  }}
                </td>
            @endforeach
            <td class="text-end">
                <b>{{ numberFormat($village->populations->sum('total')) }}</b>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-center" colspan="2">Total</td>
        @php($totalDf = 0)
        @foreach($desilFamilies as $ttlDf)
            @php($totalDf += $ttlDf['total'])
            <td class="text-end">{{ numberFormat($ttlDf['total']) }}</td>
        @endforeach
        <td class="text-end">{{ numberFormat($totalDf) }}</td>
        @php($totalDp = 0)
        @foreach($desilPopulations as $ttlDp)
            @php($totalDp += $ttlDp['total'])
            <td class="text-end">{{ numberFormat($ttlDp['total']) }}</td>
        @endforeach
        <td class="text-end">{{ numberFormat($totalDp) }}</td>
    </tr>
    </tfoot>
</table>
