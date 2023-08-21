<x-layouts.admin title="Pemerintahan">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Pemerintah Daerah</h3>
        </x-slot>
        <li class="breadcrumb-item">Pemerintah</li>
        <li class="breadcrumb-item">Daerah</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <x-card>
                    @slot('header')
                        <h5>Form Input</h5>
                    @endslot
                    <form action="{{ route('government-local') }}" method="post">
                        @csrf
                        <div class="mb-3 select-city ">
                            <label>Pemerintah</label>
                            <select class="form-select select2" name="city_code">
                                @php($dis = '')
                                @foreach($governments as $gov)
                                    @if ($gov->city_code == null)
                                        @php($dis = 'disabled')
                                        @break
                                    @endif
                                @endforeach()
                                <option {{$dis}} value="">PROVINSI KALIMANTAN SELATAN</option>
                                @foreach($cities as $city)
                                    @php($disabled = '')
                                    @foreach($governments as $gov)
                                        @if ($gov->city_code == $city->city_code)
                                            @php($disabled = 'disabled')
                                            @break
                                        @endif
                                    @endforeach()
                                    <option
                                        {{ $disabled }} value="{{ $city->city_code }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input name="government_name" title="Nama Pemerintahan" placeholder="Nama Pemerintahan"/>
                        <x-input name="government_alias" title="Singkatan" placeholder="Nama Singkatan"/>
                        <x-input type="hidden" name="government_id"/>
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    </form>
                </x-card>
            </div>
            <div class="col-md-8">
                <x-card>
                    @slot('header')
                        <h5>Data Bantuan Prioritas</h5>
                    @endslot
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Kabupaten / Kota</th>
                            <th>Nama</th>
                            <th>Alias</th>
                            <th width="15%"><i class="bi bi-code"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($governments as $government)
                            @php($params = json_encode($government))
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$government->city->city_name ?? ''}}</td>
                                <td>{{$government->government_name}}</td>
                                <td class="text-center">{{$government->government_alias}}</td>
                                <td class="text-center">
                                    {!! btnAction('update', attrBtn: "data-params='$params'", classBtn: 'btn-pill btn-xs btn-update') !!}
                                    {!! btnAction('delete', attrBtn: "data-params='$params'", classBtn: 'btn-pill btn-xs btn-delete') !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-card>
            </div>
        </div>
        @includeIf('layouts.admin.partials.js')
        @slot('script')
            <script>
                $('.btn-update').click(function () {
                    const params = $(this).data('params')
                    $('.select-city').prop('hidden', true)
                    $('.government_name').val(params.government_name)
                    $('.government_alias').val(params.government_alias)
                    $('.government_id').val(params.government_id)
                });
                $('.btn-delete').click(function () {
                    const params = $(this).data('params')
                    swalAction(BASEURL(`government/local/${params.government_id}`),
                        {_token: "{{ csrf_token() }}"},
                        {method: 'delete'}
                    )
                });
            </script>
    @endslot
</x-layouts.admin>
