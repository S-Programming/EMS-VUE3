<select class="form-control form-control-alt form-control-lg" name="status">
    @if(isset($request_status) &&!empty($request_status))
        @foreach($request_status as $data)
            {{-- <option value="{{$request_status->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option> --}}
            <option value="{{$data->id??0}}">{{$data->status??''}}</option>
        @endforeach
    @endif
</select>
