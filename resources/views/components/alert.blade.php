<div class="row">
    <div class="col-md-{{$col ?? '12'}}">
        <div class="alert alert-{{$type ?? 'warning'}} alert-dismissible fade show">
            <i class="bi {{ isset($status) ?  'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }} {{ $classTxt ?? '' }}"></i>
            <strong class="{{ $classTxt ?? '' }}"> {{$title}}</strong>
        </div>
    </div>
</div>
