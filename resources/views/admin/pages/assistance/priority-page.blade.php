<x-layouts.admin title="Bantuan">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Bantuan Prioritas</h3>
        </x-slot>
        <li class="breadcrumb-item">Bantuan</li>
        <li class="breadcrumb-item">Prioritas</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form action="{{ route('assistance-priority') }}" method="post">
                        @csrf
                        <x-input name="assistance_priority_name" title="Nama" placeholder="Nama Bantuan"/>
                        <x-input name="assistance_priority_alias" title="Alias" placeholder="Inisial (Alias)"/>
                        <x-input type="hidden" name="assistance_priority_id"/>
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Bantuan Prioritas</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th>Nama</th>
                                <th>Alias</th>
                                <th width="15%"><i class="bi bi-code"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($priorities as $priority)
                                @php($params = json_encode($priority))
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$priority->assistance_priority_name}}</td>
                                    <td class="text-center">{{$priority->assistance_priority_alias}}</td>
                                    <td class="text-center">
                                        {!! btnAction('update', attrBtn: "data-params='{$params}'", classBtn: 'btn-pill btn-xs btn-update') !!}
                                        {!! btnAction('delete', attrBtn: "data-params='{$params}'", classBtn: 'btn-pill btn-xs btn-delete') !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </x-card>
            </div>
        </div>
        @includeIf('layouts.admin.partials.js')
        @slot('script')
            <script>
                $('.btn-update').click(function () {
                    const params = $(this).data('params')
                    $('.assistance_priority_name').val(params.assistance_priority_name)
                    $('.assistance_priority_alias').val(params.assistance_priority_alias)
                    $('.assistance_priority_id').val(params.assistance_priority_id)
                });
                $('.btn-delete').click(function () {
                    const params = $(this).data('params')
                    swalAction(BASEURL(`assistance/priority/${params.assistance_priority_id}`), {
                        _token: "{{ csrf_token() }}"
                    })
                });
            </script>
    @endslot
</x-layouts.admin>
