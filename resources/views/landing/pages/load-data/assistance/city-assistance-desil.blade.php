<x-card class="rounded-circle">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <a href="{{ route('assistance.export-city-assistance-desil') }}" class="btn btn-success-gradien">
                    <i class="bi bi-download"></i> Export Excel
                </a>
            </div>
            <div class="table-responsive">
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
