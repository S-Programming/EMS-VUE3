<select class="form-control form-control-alt form-control-lg" name="roles">
    @if(isset($roles) &&!empty($roles))
        @if($user_id === 1)
            @foreach($roles as $role)
                @if($role->id==2)
                <option value="{{$role->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option>
                @endif
            @endforeach
        @else
            if($user_id === 2)
            @foreach($roles as $role)
                @if($role->id>2)
                    <option value="{{$role->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option>
                @endif
            @endforeach
        @endif
    @endif
</select>
