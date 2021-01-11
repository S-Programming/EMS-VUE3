<select class="form-control form-control-alt form-control-lg" name="roles">
    @if(isset($roles) &&!empty($roles))
        @foreach($roles as $role)
            <option value="{{$role->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option>
        @endforeach
    @endif
</select>
