<!--<div class="form-group">-->
<!--    <select class="browser-default custom-select" id="" name="status">-->
<!--        @if(isset($query_statuses))-->
<!--            @foreach($query_statuses as $query_status)-->
<!--        <option value="{{$query_status->id??''}}">{{$query_status->query_status??''}}</option>-->
<!--            @endforeach-->
<!--        @endif-->
<!--    </select>-->
<!--</div>-->
<select class="form-control form-control-alt form-control-lg" name="status">
    @if(isset($query_statuses) &&!empty($query_statuses))
        @foreach($query_statuses as $data)
            <option value="{{$data->id??0}}">{{$data->query_status??''}}</option>
        @endforeach
    @endif
</select>
