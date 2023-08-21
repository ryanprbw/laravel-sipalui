<x-card>
    <x-slot:header>
        <h3>Bantuan</h3>
    </x-slot:header>
    <div class="row mb-3">
        <div class="col-md-6">
            <ul class="list-group">
                @foreach($priorities as $priority)
                    <li class="list-group-item">
                        <input name="assistance[]"
                               class="form-check-input me-1"
                               type="checkbox" id="checked-priority-{{ $priority->assistance_priority_id }}"
                               value="{{ $priority->assistance_priority_id }}">
                        <label class="form-check-label"
                               for="checked-priority-{{ $priority->assistance_priority_id }}">
                            {{ $priority->assistance_priority_name." ($priority->assistance_priority_alias)" }}
                        </label>

                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="list-group mb-3">
                @foreach($desils as $desil)
                    <li class="list-group-item">
                        <input name="desil[]" id="checked-desil-{{ $desil->desil_id }}"
                               class="form-check-input me-1 checked-desil"
                               type="checkbox" value="{{ $desil->desil_id }}">
                        <label class="form-check-label"
                               for="checked-desil-{{ $desil->desil_id }}">
                            {{ "(Desil {$desil['desil_id']}) ". $desil->desil_name }}
                        </label>

                    </li>
                @endforeach
            </ul>
            <div class="d-grid">
                <button class="btn btn-primary-gradien btn-filter">
                    <i class="bi bi-search"></i> Filter
                </button>
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
        let assistanceIDs = $("input[name='assistance[]']:checked").map(function () {
            return $(this).val()
        }).get();
        let desilIDs = $("input[name='desil[]']:checked").map(function () {
            return $(this).val()
        }).get();
        if (desilIDs.length === 0 || assistanceIDs.length === 0) {
            $('.html-render').html(`<x-alert title="Silahkan pilih Filter data." />`)
        }
        getAssistanceDesil('{{$params['cityCode']}}', '{{ $params['year'] }}', assistanceIDs, desilIDs)
    })

    const getAssistanceDesil = async (city, year, assistance, desil) => {
        return $.ajax({
            type: 'get',
            dataType: "html",
            url: '{{ route('analytic.load-data-assistance-desil') }}',
            data: {city, year, assistance, desil},
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
</script>
