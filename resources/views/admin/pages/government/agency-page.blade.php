<x-layouts.admin title="Pemerintahan">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Pemerintah SKPD</h3>
        </x-slot>
        <li class="breadcrumb-item">Pemerintah</li>
        <li class="breadcrumb-item">SKPD</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    <div class="mb-3 select-city ">
                        <form method="GET">
                            <label>Pemerintah</label>
                            <select class="form-select" name="government" onchange="this.form.submit()">
                                <option disabled selected value="">.: Pilih Pemerintah :.</option>
                                @foreach($governments as $gov)
                                    <option
                                        {{ $params['governmentID']==$gov->government_id ? 'selected' : '' }} value="{{ $gov->government_id }}">{{ $gov->government_name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </x-card>
                @if($params['governmentID'])
                    <x-card>
                        @slot('header')
                            <h5>Form Input</h5>
                        @endslot
                        <form action="{{ route('government-agency') }}" method="post">
                            @csrf
                            <x-input name="agency_name" title="SKPD Pemerintah" placeholder="Nama SKPD Pemerintah"/>
                            <x-input type="hidden" name="agency_id"/>
                            <x-input type="hidden" name="government_id" value="{{ $params['governmentID'] }}"/>
                            <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        </form>
                    </x-card>
                @endif
            </div>
            <div class="col-md-8">
                @if($params['governmentID'])
                    <x-card>
                        @slot('header')
                            <h5>Data SKPD Pemerintah</h5>
                        @endslot
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%">
                                <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Pemerintah</th>
                                    <th>Nama</th>
                                    <th width="15%"><i class="bi bi-code"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($agencies as $agency)
                                    @php($params = json_encode($agency))
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$agency->government->government_name}}</td>
                                        <td>{{$agency->agency_name}}</td>
                                        <td class="text-center">
                                            {!! btnAction('update', attrBtn: "data-params='$params'", classBtn: 'btn-pill btn-xs btn-update') !!}
                                            {!! btnAction('delete', attrBtn: "data-params='$params'", classBtn: 'btn-pill btn-xs btn-delete') !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-card>
                @else
                    <x-alert title="Pilih Pemerintahan"/>
                @endif
            </div>
        </div>
        @includeIf('layouts.admin.partials.js')
        @slot('script')
            <script>
                $('.btn-update').click(function () {
                    const params = $(this).data('params')
                    $('.agency_name').val(params.agency_name)
                    $('.agency_id').val(params.agency_id)
                });
                $('.btn-delete').click(function () {
                    const params = $(this).data('params')
                    swalAction(BASEURL(`government/agency/${params.agency_id}`),
                        {_token: "{{ csrf_token() }}"},
                        {method: 'delete'}
                    )
                });
            </script>
    @endslot
</x-layouts.admin>
