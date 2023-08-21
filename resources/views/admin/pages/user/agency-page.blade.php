<x-layouts.admin title="User">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>User SKPD</h3>
        </x-slot>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item">SKPD</li>
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
                        <x-input type="hidden" name="level_id" value="3"/>
                        <div class="mt-3 mb-3 row">
                            <label>SKPD</label>
                            <select class="select2 select-group" name="agency_id">
                                <option selected disabled value="">.: Pilih SKPD :.</option>
                                @foreach($agencies as $agency)
                                    <option
                                        data-name="{{$agency->government->government_name.' - '. $agency->agency_name}}"
                                        data-government_id="{{ $agency->government->government_id }}"
                                        value="{{ $agency->agency_id }}">{{ $agency->government->government_name.' -> '. $agency->agency_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input attr="readonly" name="name" title="Nama"
                                 placeholder="Nama"/>
                        <x-input type="hidden" name="government_id"/>
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
                        <table class="table table-bordered table-25" style="width: 100%">
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
                                            {!! btnAction(attrBtn: "data-params='$params'", labelBtn: 'Non Aktif', classBtn: 'btn-xs btn-status', typeBtn: 'danger') !!}
                                        @else
                                            {!! btnAction(attrBtn: "data-params='$params'", labelBtn: 'Aktif', classBtn: 'btn-xs btn-status', typeBtn: 'primary') !!}
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
                $('.select-group').change(function () {
                    const selectFind = $(this).find('option:selected');
                    const name = selectFind.data('name')
                    const government_id = selectFind.data('government_id')
                    $('.name').val(name)
                    $('.government_id').val(government_id)
                })
                $('.btn-delete').click(function () {
                    const params = $(this).data('params')
                    swalAction(BASEURL(`user/${params.id}`),
                        {_token: "{{ csrf_token() }}"},
                        {method: 'delete'}
                    )
                });

                $('.btn-status').click(function () {
                    const params = $(this).data('params')
                    swalAction(BASEURL(`user/${params.id}`),
                        {_token: "{{ csrf_token() }}"},
                        {method: 'put', textBtn: 'Update'}
                    )
                });
            </script>
    @endslot
</x-layouts.admin>
