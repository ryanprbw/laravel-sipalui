<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                @foreach($priorities as $priority)
                    @php
                        $status = 'Tidak';
                            $color = 'danger';
                    @endphp
                    @foreach($receives as $receive)
                        @if ($receive->assistance_priority_id == $priority->assistance_priority_id)
                            @php
                                $status = 'Ya';
                                $color = 'success';
                            @endphp
                            @break
                        @endif
                    @endforeach
                    <tr>
                        <td width="60%">{{$priority->assistance_priority_name}}</td>
                        <td width="5%">:</td>
                        <td><label class="badge badge-{{$color}}">{{$status}}</label></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
