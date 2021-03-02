<select class="form-control form-control-alt form-control-lg" name="technology_stack_id[]" multiple>
    @if(isset($technologies) &&!empty($technologies))
        @foreach($technologies as $technology)
            {{--            <option value="{{$role->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option>--}}
            <option value="{{$technology->id??0}}">{{$technology->name??''}}</option>
        @endforeach
    @endif
</select>
