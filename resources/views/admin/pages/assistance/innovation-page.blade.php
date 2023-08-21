<x-layouts.admin title="Bantuan">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Bantuan Inovasi</h3>
        </x-slot>
        <li class="breadcrumb-item">Bantuan</li>
        <li class="breadcrumb-item">Inovasi</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form action="{{ route('assistance-innovation') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Bantuan Prioritas</label>
                            <select class="form-select" name="assistance_priority_id">
                                <option selected disabled value="">.: Pilih Bantuan Prioritas :.</option>
                                @foreach($priorities as $priority)
                                    <option value="{{ $priority->assistance_priority_id }}">
                                        {{ $priority->assistance_priority_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-input name="assistance_innovation_name" title="Nama" placeholder="Nama Bantuan"/>
                        <x-input name="assistance_innovation_alias" title="Alias" placeholder="Inisial (Alias)"/>
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Bantuan Inovasi</h5>
                    @endslot
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th>Prioritas</th>
                                <th>Nama</th>
                                <th>Alias</th>
                                <th width="15%"><i class="bi bi-code"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($innovations as $innovation)
                                @php($params = json_encode($innovation))
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$innovation->priority->assistance_priority_name}}</td>
                                    <td>{{$innovation->assistance_innovation_name}}</td>
                                    <td class="text-center">{{$innovation->assistance_innovation_alias}}</td>
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
                $('.btn-delete').click(function () {
                    const params = $(this).data('params')
                    swalAction(BASEURL(`assistance/innovation/${params.assistance_innovation_id}`), {
                        _token: "{{ csrf_token() }}"
                    })
                });
            </script>
        @endslot
    </div>
</x-layouts.admin>
