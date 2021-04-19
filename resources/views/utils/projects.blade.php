<select class="form-control form-control-alt form-control-lg" name="project_id">
    @if(isset($projects_data) &&!empty($projects_data))
        @foreach($projects_data as $project_data)
            <option value="{{$project_data->project->id??0}}">{{$project_data->project->name??''}}</option>            
        @endforeach
    @endif
</select>
