<x-layouts.admin title="User">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>User Administrator</h3>
        </x-slot>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item">Administrator</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form action="{{ route('user-store') }}" method="post">
                        @csrf
                        <x-input name="username" title="Username" placeholder="Username"/>
                        <x-input type="password" name="password" title="Password" placeholder="xxxxxxxx"/>
                        <x-input type="hidden" name="level_id" value="1"/>
                        <x-input name="name" title="Nama" placeholder="Nama"/>
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data User</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th>Level</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th width="15%"><i class="bi bi-code"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @php($params = json_encode($user))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->level->level_name }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td class="text-center">
                                        @if($user->is_active == 0)
                                            {!! btnAction(labelBtn: 'Non Aktif', classBtn: 'btn-xs btn-status', typeBtn: 'danger') !!}
                                        @else
                                            {!! btnAction(labelBtn: 'Aktif', classBtn: 'btn-xs btn-status', typeBtn: 'primary') !!}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {!! btnAction('delete', attrBtn: "data-params='$params'", classBtn: 'btn-pill btn-xs btn-delete') !!}
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
                $('.btn-delete').click(function () {
                    const params = $(this).data('params')
                    swalAction(BASEURL(`user/${params.id}`),
                        {_token: "{{ csrf_token() }}"},
                        {method: 'delete'}
                    )
                });
            </script>
    @endslot
</x-layouts.admin>
