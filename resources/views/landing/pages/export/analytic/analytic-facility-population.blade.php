<table class="table table-bordered table-25">
    <thead>
    <tr>
        <th rowspan="2">#</th>
        <th rowspan="2">Nama</th>
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
            <td>{{ hideNIK($population->population_nik, rand: true) }}</td>
            <td>{{ $population->population_name }}</td>
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
