<x-card>
    <x-slot:header>
        <h3>Fasilitas dan Individu :</h3>
    </x-slot:header>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-xs">
                    <tbody>
                    <tr>
                        <td class="px-0" width="20%"></td>
                        <td class="px-0" width="2%"></td>
                        <td class="px-0"></td>
                    </tr>
                    <tr>
                        <td class="px-0">Kepemilikan Rumah</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($houses as $house)
                                <input name="house[]" class="form-check-input me-1" type="checkbox"
                                       id="checked-house-{{ $house->family_house_id }}"
                                       value="{{ $house->family_house_name }}">
                                <label class="form-check-label  me-3" for="checked-house-{{ $house->family_house_id }}">
                                    {{ $house->family_house_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Fasilitas BAB</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($defecations as $defecation)
                                <input name="defecation[]" class="form-check-input me-1" type="checkbox"
                                       id="checked-defecation-{{ $defecation->facility_defecation_id }}"
                                       value="{{ $defecation->facility_defecation_name }}">
                                <label class="form-check-label  me-3"
                                       for="checked-defecation-{{ $defecation->facility_defecation_id }}">
                                    {{ $defecation->facility_defecation_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Jenis Atap</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($roofs as $roof)
                                <input name="roof[]" class="form-check-input" type="checkbox"
                                       id="checked-roof-{{ $roof->facility_roof_id }}"
                                       value="{{ $roof->facility_roof_name }}">
                                <label class="form-check-label me-3" for="checked-roof-{{ $roof->facility_roof_id }}">
                                    {{ $roof->facility_roof_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Jenis Dinding</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($walls as $wall)
                                <input name="wall[]" class="form-check-input" type="checkbox"
                                       id="checked-wall-{{ $wall->facility_wall_id }}"
                                       value="{{ $wall->facility_wall_name }}">
                                <label class="form-check-label me-3"
                                       for="checked-wall-{{ $wall->facility_wall_id }}">
                                    {{ $wall->facility_wall_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Jenis Lantai</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($floors as $floor)
                                <input name="floor[]" class="form-check-input" type="checkbox"
                                       id="checked-floor-{{ $floor->facility_floor_id }}"
                                       value="{{ $floor->facility_floor_name }}">
                                <label class="form-check-label me-3"
                                       for="checked-floor-{{ $floor->facility_floor_id }}">
                                    {{ $floor->facility_floor_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Sumber Penerangan</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($lightings as $lighting)
                                <input name="lighting[]" class="form-check-input" type="checkbox"
                                       id="checked-lighting-{{ $lighting->facility_lighting_id }}"
                                       value="{{ $lighting->facility_lighting_name }}">
                                <label class="form-check-label me-3"
                                       for="checked-lighting-{{ $lighting->facility_lighting_id }}">
                                    {{ $lighting->facility_lighting_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Bahan Bakar Masak</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($cookings as $cooking)
                                <input name="cooking[]" class="form-check-input" type="checkbox"
                                       id="checked-cooking-{{ $cooking->facility_cooking_id }}"
                                       value="{{ $cooking->facility_cooking_name }}">
                                <label class="form-check-label me-3"
                                       for="checked-cooking-{{ $cooking->facility_cooking_id }}">
                                    {{ $cooking->facility_cooking_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Sumber Air Minum</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($drinkings as $drinking)
                                <input name="drinking[]" class="form-check-input" type="checkbox"
                                       id="checked-drinking-{{ $drinking->facility_drinking_id }}"
                                       value="{{ $drinking->facility_drinking_name }}">
                                <label class="form-check-label me-3"
                                       for="checked-drinking-{{ $drinking->facility_drinking_id }}">
                                    {{ $drinking->facility_drinking_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Pendidikan</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($educations as $education)
                                <input name="education[]" class="form-check-input" type="checkbox"
                                       id="checked-education-{{ $education->education_id }}"
                                       value="{{ $education->education_name }}">
                                <label class="form-check-label me-3"
                                       for="checked-education-{{ $education->education_id }}">
                                    {{ $education->education_name }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">Desil</td>
                        <td class="px-0">:</td>
                        <td class="px-0">
                            @foreach($desils as $desil)
                                <input name="desil[]" class="form-check-input" type="checkbox"
                                       id="checked-desil-{{ $desil->desil_id }}"
                                       value="{{ $desil->desil_id }}">
                                <label class="form-check-label me-3"
                                       for="checked-desil-{{ $desil->desil_id }}">
                                    Desil {{ $desil->desil_id. "({$desil->desil_name})" }}
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="px-0">
                            <div class="d-grid">
                                <button class="btn btn-primary-gradien btn-filter">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                            </div>
                        </td>
                        <td class="px-0"></td>
                        <td class="px-0"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="loading-spinner text-center"></div>
            <div class="html-render"></div>
        </div>
    </div>
</x-card>
<script>
    $('.btn-filter').click(function () {
        let houseIDs = $("input[name='house[]']:checked").map((i, response) => response.value).get();
        let defecationIDs = $("input[name='defecation[]']:checked").map((i, response) => response.value).get();
        let roofIDs = $("input[name='roof[]']:checked").map((i, response) => response.value).get();
        let wallIDs = $("input[name='wall[]']:checked").map((i, response) => response.value).get();
        let lightingIDs = $("input[name='lighting[]']:checked").map((i, response) => response.value).get();
        let floorIDs = $("input[name='floor[]']:checked").map((i, response) => response.value).get();
        let cookingIDs = $("input[name='cooking[]']:checked").map((i, response) => response.value).get();
        let drinkingIDs = $("input[name='drinking[]']:checked").map((i, response) => response.value).get();
        let educationIDs = $("input[name='education[]']:checked").map((i, response) => response.value).get();
        let desilIDs = $("input[name='desil[]']:checked").map((i, response) => response.value).get();
        // validatedValue({houseIDs, defecationIDs, roofIDs, wallIDs, lightingIDs, floorIDs, cookingIDs, drinkingIDs,educationIDs,desilIDs})
        console.log(desilIDs.length)
        if (desilIDs.length === 0) {
            $('.html-render').html(`<x-alert title="Silahkan pilih Desil." />`)
        } else {
            getFacilityPopulation('{{$params['cityCode']}}', '{{ $params['year'] }}', houseIDs, roofIDs, wallIDs, lightingIDs, floorIDs, cookingIDs, drinkingIDs, educationIDs, desilIDs)
        }
    })

    const getFacilityPopulation = async (city, year, house, roof, wall, lighting, floor, cooking, drinking, education, desil) => {
        return $.ajax({
            type: 'get',
            dataType: "html",
            url: '{{ route('analytic.load-data-facility-population') }}',
            data: {city, year, house, roof, wall, lighting, floor, cooking, drinking, education, desil},
            beforeSend: function () {
                $('.html-render').html(``)
                $('.loading-spinner').html(`<span class="fa fa-spinner fa-spin fa-5x "></span>`)
            },
            success: (response) => {
                $('.html-render').html(response)
            },
            complete: function () {
                $('.loading-spinner').html(``)
            },
            error: (request, status, error) => {
                console.log(request.responseText);
            }
        })
    }

    const validatedValue = (desilIDs) => {
        if (desilIDs.length === 0) {
            $('.html-render').html(`<x-alert title="Silahkan pilih Desil." />`)
        }
    }
</script>
