<select class="form-control form-control-alt form-control-lg" name="roles">
    @if(isset($project_managers) &&!empty($project_managers))
        @foreach($project_managers as $project_manager)
{{--            <option value="{{$role->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option>--}}
            <option value="{{$project_manager->id??0}}">{{$project_manager->first_name??''}} {{$project_manager->last_name??''}}</option>
        @endforeach
    @endif
</select>
