<div class="modal fade" id="{{ $id }}" tabindex="-99" role="dialog">
    <div class="modal-dialog {{ $size ?? '' }}" role="document">
        <div>
            <button class="btn-close theme-close" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
