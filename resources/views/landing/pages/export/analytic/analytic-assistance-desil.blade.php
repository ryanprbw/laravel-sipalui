<table class="table table-bordered">
    <thead>
    <tr>
        <th rowspan="3">#</th>
        <th rowspan="3">Kecamatan</th>
    </tr>
    <tr>
        @foreach($priorities as $priority)
            <th colspan="{{ $desils->count() }}">{{ $priority->assistance_priority_alias }}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($priorities as $priority)
            @foreach($desils as $desil)
                <th>Desil {{ $desil->desil_id }}</th>
            @endforeach
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($analytics as $analytic)
        <tr>
            <td>{{ $analytic->prov_code.sprintfNumber($analytic->city_code, 2).sprintfNumber($analytic->district_code,2) }}</td>
            <td>{{ $analytic->district_name }}</td>
            @foreach($analytic->families as $family)
                <td class="text-center">{{ $family->total }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
