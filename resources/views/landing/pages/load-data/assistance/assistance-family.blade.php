<x-card class="rounded-circle">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-25">
                    <thead>
                    <tr>
                        <th width="5%" rowspan="2">#</th>
                        <th rowspan="2">Nama KK</th>
                        <th rowspan="2">Tanggal Lahir</th>
                        <th rowspan="2">Usia</th>
                        <th rowspan="2">Desil</th>
                        <th colspan="{{ $priorities->count() }}">Bantuan</th>
                    </tr>
                    <tr>
                        @foreach($priorities as $priority)
                            <th>
                                {{ $priority->assistance_priority_alias }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($families as $family)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $family->population->population_name }}</td>
                            <td class="text-center">{{  formatDateIndo($family->population->population_date_birth)  }}</td>
                            <td class="text-center">{{ calculateAge($family->population->population_date_birth).' Tahun' }}</td>
                            <td class="text-center">{{ $family->desil_id }}</td>
                            @foreach($priorities as $priority)
                                @php($stts = 'Tidak')
                                @foreach($family->receiver_priority as $prio)
                                    @if($prio->assistance_priority_id == $priority->assistance_priority_id)
                                        @php($stts = 'Ya')
                                        @break
                                    @endif
                                @endforeach
                                <td class="text-center">{{ $stts }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
