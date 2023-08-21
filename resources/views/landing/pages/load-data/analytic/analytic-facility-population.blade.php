<x-card>
    <x-slot:header>
        <h5>Data Analisa Fasilitas Individu</h5>
    </x-slot:header>
    <div class="mb-3">
        <a href="{{ route('analytic.export-facility-population', [
    'house' => $request['house'] ?? [],
    'defecation' => $request['defecation'] ?? [],
    'roof' => $request['roof'] ?? [],
    'wall' => $request['wall'] ?? [],
    'floor' => $request['floor'] ?? [],
    'lighting' => $request['lighting'] ?? [],
    'cooking' => $request['cooking'] ?? [],
    'drinking' => $request['drinking'] ?? [],
    'education' => $request['education'] ?? [],
    'desil' => $request['desil'],
    'city' => $request['city'],
    'year' => $request['year'],
]) }}" class="btn btn-success-gradien">
            <i class="bi bi-cloud-download-fill"></i>
            Export Excel
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-25">
            <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Tanggal Lahir</th>
                <th rowspan="2">Usia</th>
                <th rowspan="2">Desil</th>
                <th colspan="{{ $priorities->count() }}">Bantuan</th>
            </tr>
            <tr>
                @foreach($priorities as $priority)
                    <th>{{ $priority->assistance_priority_alias }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($populations as $population)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $population->population_name }}</td>
                    <td class="text-center">{{  formatDateIndo($population->population_date_birth)  }}</td>
                    <td class="text-center">{{ calculateAge($population->population_date_birth).' Tahun' }}</td>
                    <td class="text-center">{{ $population->desil_id }}</td>
                    @foreach($priorities as $priority)
                        @php($status = 'Tidak')
                        @foreach($population->receiver_priority as $receiver)
                            @if ($receiver->assistance_priority_id == $priority->assistance_priority_id)
                                @php($status = 'Ya')
                                @break
                            @endif
                        @endforeach
                        <td class="text-center">{{ $status }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-card>
<script>
    $(document).ready(function () {
        $('.table-25').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            pageLength: 25
        });
    })
</script>
