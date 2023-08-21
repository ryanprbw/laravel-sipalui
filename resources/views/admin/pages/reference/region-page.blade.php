<x-layouts.admin title="Wilayah">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Data Wilayah</h3>
        </x-slot>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item">Wilayah</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <x-card>
                    @slot('header')
                        <h5>Data Wilayah</h5>
                    @endslot
                    <table class="table table-bordered datatable-populations" style="width: 100%">
                        <thead>
                        <tr>
                            <th width="5%">Kode</th>
                            <th>Posisi</th>
                            <th>Nama</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </x-card>
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
                            url: '{!! route('region-datatable') !!}',
                            type: 'GET'
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
