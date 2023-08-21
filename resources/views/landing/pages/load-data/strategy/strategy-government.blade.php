<div class="row">
    @foreach($categories as $category)
        @php
            $total = 0;
            $countProgram = 0;
            $countKegiatan = 0;
            $countSubKegiatan = 0;
            $params = null;
        @endphp
        @foreach($strategies as $strategy)
            @if($strategy['category_strategy_id'] == $category->category_strategy_id)
                @php
                    $total += $strategy['total'];
                    $countProgram = count($strategy['program']);
                    $countKegiatan = count($strategy['kegiatan']);
                    $countSubKegiatan = count($strategy['subkegiatan']);
                    $countSubKegiatan = count($strategy['subkegiatan']);
                    $params = json_encode($strategy);
                @endphp
                @break
            @endif
        @endforeach
        <div class="col-md-4">
            <x-card class="rounded-5">
                <x-slot:header>
                    <p style="margin-bottom: 0"
                       class="text-center fw-bold">{{ $category->category_strategy_name }}</p>
                </x-slot:header>
                Total Anggaran : <label>Rp. {{ numberFormat($total) }}</label>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">Program</div>
                        <span class="badge bg-primary rounded-pill"
                              style="font-size: 11pt">{{ $countProgram }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">Kegiatan</div>
                        <span class="badge bg-primary rounded-pill"
                              style="font-size: 11pt">{{ $countKegiatan }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">Sub Kegiatan</div>
                        <span class="badge bg-primary rounded-pill"
                              style="font-size: 11pt">{{ $countSubKegiatan }}</span>
                    </li>
                </ol>
                <div class="d-grid mt-3">
                    <button data-params="{{$params}}" class="btn btn-primary-gradien btn-pill btn-views">
                        <i class="bi bi-search"></i>
                        Nomenklatur
                    </button>
                </div>
            </x-card>
        </div>
    @endforeach
</div>

