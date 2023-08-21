<x-layouts.admin title="Import Keluarga">
    <x-alert-session col="6"/>
    <x-breadcrumb>
        <x-slot name="breadcrumb_title">
            <h3>Import Keluarga</h3>
        </x-slot>
        <li class="breadcrumb-item">Import</li>
        <li class="breadcrumb-item">Keluarga</li>
    </x-breadcrumb>
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <form method="GET">
                    <x-card>
                        <label>Pilih Wilayah :</label>
                        <select class="form-select select2 select-city" name="city" style="width: 100%"
                                onchange="this.form.submit()">
                            <option value="">.: Pilih Kabupaten :.</option>
                            @foreach($cities as $city)
                                <option
                                    {{ $params['city_code'] == $city->city_code ? 'selected' : '' }} value="{{ $city->city_code }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                    </x-card>
                </form>
            </div>
            @if($params['city_code'])
                <div class="col-md-4">
                    <x-card>
                        <form method="post" action="{{ route('import-keluarga') }}" enctype="multipart/form-data">
                            @csrf
                            <label>Import Data P3KE Keluarga Format (xls/csv)</label>
                            <div class="input-group">
                                <input type="file" class="form-control" name="file" aria-label="Upload">
                                <button class="btn btn-primary-gradien" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </x-card>
                </div>
            @endif
        </div>
        @if($params['city_code'])
            <div class="row">
                <div class="col-md-12">
                    <x-card>
                        @slot('header')
                            <h5>Data Keluarga</h5>
                        @endslot
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! btnAction('add', attrBtn: "data-city_code='{$params['city_code']}'",labelBtn:  'Simpan ke Database', classBtn: 'btn-insert') !!}
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered datatable-family" style="width: 100%">
                            <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="5%">ID</th>
                                <th>Kab / Kota</th>
                                <th>Kecamatan</th>
                                <th>Kel / Desa</th>
                                <th>Alamat</th>
                                <th>NIK</th>
                                <th>Kepala Keluarga</th>
                                <th>Tanggal Lahir</th>
                                <th>Status Desil</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($keluarga as $klg)
                                @php
                                    $tglLahir = trim(str_replace('/', '-', str_replace('0:00:00', '', $klg->tanggal_lahir)));
                                        $dd = explode('-', $tglLahir);
                                        $tglLahir = $dd[2].'-'.$dd[1].'-'.$dd[0];
                                @endphp
                                <tr>
                                    <th scope="row">{{ ($keluarga->currentPage() - 1) * $keluarga->perPage() + $loop->iteration }}</th>
                                    <td>{{ $klg->id_keluarga_P3KE }}</td>
                                    <td>{{ $klg->kabupaten_kota }}</td>
                                    <td>{{ $klg->kecamatan }}</td>
                                    <td>{{ $klg->desa_kelurahan }}</td>
                                    <td>{{ $klg->alamat }}</td>
                                    <td>{{ $klg->nik }}</td>
                                    <td>{{ $klg->kepala_keluarga }}</td>
                                    <td>{{ $tglLahir  }}</td>
                                    <td>{{ $klg->desil_kesejahteraan }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            {!! $keluarga->appends(['city' => $params['city_code']])->links() !!}
                        </div>
                    </x-card>
                </div>
            </div>
            <x-modal id="modal-insert" title="Progress Bar Input Data">
                <div class="mb-3">
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" id="progress-send" role="progressbar" style="width: 0%;"
                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span id="progress-text-send" class="progress-text"></span>
                    <span id="progress-number-send" class="progress-number"></span>
                    <div class="total-record"></div>
                </div>
                <x-input type="hidden" name="city_code"/>
                <div class="d-flex justify-content-between">
                    <div class="btn-close-modal"></div>
                    <button type="button" class="btn btn-danger btn-run"><i class="bi bi-save"></i> Run</button>
                </div>

            </x-modal>
        @endif
        @includeIf('layouts.admin.partials.js')
        @slot('script')
            <script>
                $('.btn-insert').click(function (e) {
                    $('#modal-insert').modal('show');
                    const city_code = $(this).data('city_code')
                    $('.city_code').val(city_code)
                });

                $('.btn-run').click(async function () {
                    const city_code = $('.city_code').val()
                    const keluarga = await loadAllCity(city_code);
                    let no = 0;
                    let jlm = keluarga.data.length;
                    $('.list-response').html('');
                    keluarga.data.forEach(function (item) {
                        $.ajax({
                            type: "POST",
                            data: {
                                item: item,
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: 'json',
                            url: '{{ route('family') }}',
                            async: true
                        }).done(function (response) {
                            no += 1;
                            console.log(response.data)
                            $(this).prop('disabled', true).text('loading . . . .')
                        }).fail(function (xhr) {
                            no += 1;
                            console.log(JSON.parse(xhr.responseText))
                        }).always(function (response) {
                            progressBar(jlm, no);
                        });
                    });
                })

                function progressBar(jlm = 0, no = 0) {
                    let loading = parseInt((no / jlm) * 100);
                    $('.total-record').html(`<p>Total Data : ${jlm} / ${no}`)
                    $("#progress-text-send").html('Proses input data ...');
                    $("#progress-number-send").html('<b>' + loading + ' %' + '</b>');
                    $("#progress-send").attr("style", "width : " + loading + '%')
                    if (loading == 100) {
                        $("#progress-text-send").html('Selesai');
                        $("#progress-send").attr("class", "progress-bar progress-bar-striped")
                        $('.btn-close-modal').html(`<button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>`)
                    }
                }

                async function loadAllCity(city_code) {
                    return await $.getJSON(BASEURL('p3ke/import-keluarga/load-all-city'), {city_code})
                }

            </script>
    @endslot
</x-layouts.admin>
