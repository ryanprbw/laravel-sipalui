<x-layouts.admin title="Nomenklatur">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Data Nomenklatur</h3>
        </x-slot>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item">Nomenklatur</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <form method="GET">
                    <x-card>
                        <label>Pilih Posisi Nomenklator</label>
                        <select class="form-select " name="position" onchange="this.form.submit()">
                            <option selected disabled value="">.: Posisi :.</option>
                            <option {{ $params['position'] == 1 ?'selected' :'' }} value="1">
                                Pemerintah Provinsi
                            </option>
                            <option {{ $params['position'] == 2 ?'selected' :'' }} value="2">
                                Pemerintah Kabupaten / Kota
                            </option>

                        </select>
                    </x-card>
                </form>
            </div>
            <div class="col-md-8">
                @if ($params['position'])
                    <x-card>
                        @slot('header')
                            <h5>Data Nomenklatur</h5>
                        @endslot
                        <table class="table table-bordered datatable-populations" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">Kode</th>
                                <th>Posisi</th>
                                <th>Nomenklator</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </x-card>
                @else
                    <x-alert title="Pilih Posisi Nomenklatur terlebih dahulu."/>
                @endif
            </div>
        </div>
        @includeIf('layouts.admin.partials.js')
        @slot('script')
            <script>
                $(function () {
                    $('.datatable-populations').DataTable({
                        processing: true,
                        serverSide: true,
                        info: true,
                        autoWidth: true,
                        pageLength: 50,
                        ajax: {
                            url: '{!! route('nomenclature-datatable') !!}',
                            type: 'GET',
                            data: {position: '{{ $params['position'] }}'}
                        },
                        columns: [
                            {data: 'code', name: 'code'},
                            {data: 'position', name: 'position'},
                            {data: 'name', name: 'name'}
                        ],
                    });
                });

            </script>
    @endslot
</x-layouts.admin>
