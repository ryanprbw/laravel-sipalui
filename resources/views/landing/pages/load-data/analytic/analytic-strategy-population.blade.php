<x-card>
    <x-slot:header>
        <h5>Data Analisa Strategi Individu</h5>
    </x-slot:header>
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
                <th rowspan="2">#</th>
            </tr>
            <tr>
                @foreach($priorities as $priority)
                    <th>{{ $priority->assistance_priority_alias }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($populations as $population)
                @php
                    $attrNomination = '';
                    $nameNomination = 'Nominasi';
                @endphp
                @foreach($nominations as $nomination)
                    @if($nomination->population_nik == $population->population_nik)
                        @php
                            $attrNomination = 'disabled';
                            $nameNomination = 'Selesai';
                        @endphp
                        @break
                    @endif
                @endforeach
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
                    <td class="text-center">
                        <button {{ $attrNomination }} data-params="{{ json_encode($population) }}"
                                data-request="{{ json_encode($request) }}"
                                class="btn btn-primary btn-sm btn-nomination">
                            {{ $nameNomination }}
                        </button>
                    </td>
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
            info: true,
            autoWidth: true,
            columnDefs: [
                {orderable: false, targets: [0, 1, 2, 4, 5, 6, -4, -3, -2, -1]}
            ],
            pageLength: 25
        });
    })

    $('.btn-nomination').click(function () {
        const params = $(this).data('params')
        const req = $(this).data('request')
        $.ajax({
            type: 'post',
            url: '{{ route('nomination') }}',
            data: {
                year: req.year,
                category_strategy_id: req.strategy_id,
                population_nik: params.population_nik,
                _token: "{{ csrf_token() }}",
            },
            beforeSend: function () {
                $(this).html(`<span class="fa fa-spinner fa-spin"></span>`)
            },
            success: (response) => {
                if (response.status === true) {
                    $(this).prop('disabled', true);
                    $(this).text(`Selesai`);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil ditambahkan',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    Swal.fire('Failed', response.message, 'error')
                }
            },
            complete: function () {
                $('.loading-spinner').html(``)
            },
            error: (request, status, error) => {
                Swal.fire('The Internet?', 'That thing is still around?', 'error');
            }
        })
    })
</script>
