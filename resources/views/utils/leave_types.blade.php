<select class="form-control form-control-alt form-control-lg" name="leave_types">
    @if(isset($leave_types_data) &&!empty($leave_types_data))
        @foreach($leave_types_data as $leave_type_data)
            <option value="{{$leave_type_data->id??0}}" {!! isset($leave_types)&& in_array($leave_type_data->id,$leave_types)?'selected="selected"':''!!}">{{$leave_type_data->type??''}}</option>
        @endforeach
    @endif
</select>
