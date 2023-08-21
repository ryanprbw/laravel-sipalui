<div class="row m-5 justify-content-end">
    <div class="col-md-{{$col ?? '12'}}">
        @if(session()->has('message'))
            <div class="alert alert-{{session('status') ? 'success' : 'danger'}} alert-dismissible fade show"
                 id="session-notif" role="alert">
                <i class="bi {{ session('status') ?  'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
                <strong> {{session('message')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
