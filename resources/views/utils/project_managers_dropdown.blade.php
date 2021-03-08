<select class="form-control form-control-alt form-control-lg" name="project_manager_id">
    @if(isset($project_managers) &&!empty($project_managers))
        @foreach($project_managers as $project_manager)
            <option value="{{$project_manager->user->id??0}}" {!! isset($project_manager_name)&& in_array($project_manager_name,array($project_manager->user->first_name))?'selected="selected"':''!!}">{{$project_manager->user->first_name??''}}</option>

        @endforeach
    @endif
</select>
