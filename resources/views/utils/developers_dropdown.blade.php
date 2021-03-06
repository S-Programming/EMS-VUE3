<select class="form-control form-control-alt form-control-lg" multiple="multiple" name="developers[]" id="developers">
    @if(isset($developers) &&!empty($developers))
        @foreach($developers as $developerkey=>$developer)
            {{--            <option value="{{$role->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option>--}}
            <option value="{{$developer->user->id??0}}">{{$developer->user->first_name??''}}</option>
        @endforeach
    @endif
</select>

