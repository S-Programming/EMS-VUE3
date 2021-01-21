<select class="form-control form-control-alt form-control-lg" name="status">
    @if(isset($leaveStatus) &&!empty($leaveStatus))
        @foreach($leaveStatus as $leaveStatuss)
            {{-- <option value="{{$leaveStatus->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option> --}}
            <option value="{{$leaveStatuss->id??0}}">{{$leaveStatuss->status??''}}</option>
        @endforeach
    @endif
</select>
