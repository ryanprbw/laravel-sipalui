<table class="table table-bordered">
    <thead>
    <tr>
        <th rowspan="2">#</th>
        <th rowspan="2">Kabupaten/kota</th>
        @foreach($priorities as $priority)
            <th colspan="{{ $desil->count() }}">{{ $priority->assistance_priority_alias }}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($priorities as $priority)
            @foreach($desil as $ds)
                <th>{{ $ds->desil_id }}</th>
            @endforeach
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($analyticCities as $analytic)
        <tr>
            <td>{{$analytic->prov_code.sprintfNumber($analytic->city_code,2)}}</td>
            <td>{{$analytic->city_name}}</td>
            @foreach($analytic->families as $family)
                <td class="text-center">{{ numberFormat($family->total)}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
