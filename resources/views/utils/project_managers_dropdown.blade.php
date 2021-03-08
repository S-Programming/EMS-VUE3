<select class="form-control form-control-alt form-control-lg" name="project_manager_id">
    @if(isset($project_managers) &&!empty($project_managers))
        @foreach($project_managers as $project_manager)
{{--            <option value="{{$role->id??0}}" {!! isset($user_roles)&& in_array($role->id,$user_roles)?'selected="selected"':''!!}">{{$role->name??''}}</option>--}}
{{--            <option value="{{$project_manager_id??0}}" {!! isset($project_manager)&& in_array($project_manager,$project_manager_id)?'selected="selected"':''!!}">{{$project_manager->user->last_name??''}}</option>--}}
            <option value="{{$project_manager->user->id??0}}">{{$project_manager->user->first_name??''}} {{$project_manager->user->last_name??''}}</option>
        @endforeach
    @endif
</select>
