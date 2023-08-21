<x-card>
    <x-slot:header>
        <h5>Data Analisa</h5>
    </x-slot:header>
    <div class="mb-3">
        <a href="{{ route('analytic.export-assistance-desil', [
                'city' => $params['cityCode'],
                'year' => $params['year'],
                'desil' => $params['desilIDs'],
                'assistance' => $params['assistanceIDs'],
                ]) }}" class="btn btn-success-gradien"><i class="bi bi-cloud-download-fill"></i>
            Export Excel
        </a>
    </div>
    <div class="table-responsive">
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
                    @foreach($priorities as $priority)
                        @foreach($desils as $desil)
                            @php($familyTotal = 0)
                            @foreach($analytic->families as $family)
                                @if ($desil->desil_id == $family->desil_id && $priority->assistance_priority_id == $family->assistance_priority_id)
                                    @php($familyTotal = $family->total)
                                    @break
                                @endif
                            @endforeach
                            <td class="text-center">{{ $familyTotal }}</td>
                        @endforeach
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-card>
