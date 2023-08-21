<x-card>
    <x-slot:header>
        <h5>DATA SEBARAN {{ $city->city_name }}</h5>
    </x-slot:header>
    <div class="mb-3">
        <a href="{{ route('distribution.export-distinct', ['city' => $city->city_code]) }}"
           class="btn btn-success-gradien"><i class="bi bi-download"></i> Export Excel</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%" rowspan="2">No</th>
                <th rowspan="2">Kecamatan</th>
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
            @foreach($districts as $district)
                <tr>
                    <td>{{$district->prov_code.sprintfNumber($district->city_code,2).sprintfNumber($district->district_code,2)}}</td>
                    <td>{{$district->district_name}}</td>
                    @foreach($district->families as $df)
                        <td class="text-end">{{ numberFormat($df->total)  }}</td>
                    @endforeach
                    <td class="text-end">
                        <b>{{ numberFormat($district->families->sum('total')) }}</b></td>
                    @foreach($district->populations as $dp)
                        <td class="text-end">{{ numberFormat($dp->total)  }}</td>
                    @endforeach
                    <td class="text-end"><b>{{ numberFormat($district->populations->sum('total')) }}</b></td>
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
    </div>
</x-card>
