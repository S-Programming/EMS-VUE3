<div class="block-header">
    <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>
    {{--    <x-button class="btn btn-primary" onclick="commonAjaxModel('add_technology_stack_modal')" data-validation="validation-span-id"--}}
    {{--              id="validation-span-id">Add--}}
    {{--    </x-button>--}}
{{--    <div class="dropdown">--}}
{{--        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--            Dropdown button--}}
{{--        </button>--}}
{{--        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--            <button class="dropdown-item" onclick="ajaxCallOnclick('user/pending/projects',{user_id:{{($user_id??'')}}})">Pending</button>--}}
{{--            <button class="dropdown-item" onclick="ajaxCallOnclick('user/working/projects',{user_id:{{($user_id??'')}}})">Working</button>--}}
{{--            <button class="dropdown-item" onclick="ajaxCallOnclick('user/completed/projects',{user_id:{{($user_id??'')}}})">Completed</button>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
{{--            <th class="text-center" style="width: 80px;">ID</th>--}}
            <th> Name </th>
            <th> Description </th>
            <th> Start Date </th>
            <th> Technology Stack </th>
            <th> Number of Developers </th>
            <th> Assigned Developers </th>
            <th> Download Document </th>
            <th> Project Completion </th>
            <th> Comment On Progress </th>
            <!-- <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
            <th style="width: 15%;">Registered</th> -->
            <th style="width: 15%;">Progress Update</th>
        </tr>
        </thead>
        <tbody>
        @if($projects)
            @foreach($projects as $project)
                <tr>
{{--                    <td class="text-center font-size-sm">{{$project->id??''}}</td>--}}
                    <td class="font-w600 font-size-sm">{{$project->name??''}}</td>
                    <td class="font-w600 font-size-sm">{!!$project->description??''!!}</td>
                    <td class="font-w600 font-size-sm">{{$project->start_date??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project->technologystack[0]->name??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project->number_of_developers}}</td>
                    <td class="font-w600 font-size-sm">
                    @foreach($project->developers as $data)
                    {{$data->user_id}}
{{--                    {{$data->first_name}}--}}
                    @endforeach
                    </td>
                    <td class="font-w600 font-size-sm"><a class="btn btn-success" href="{{ asset('assets/uploads/files/$project->document[0]->path')}}" download="{{$project->document[0]->path??''}}">{{$project->document[0]->path??''}}</a></td>
{{--                    @if($project_list->project_status === 2)--}}
                    <td class="text-center font-size-sm">{{$project->project_progress??''}}%</td>
                    <td class="font-w600 font-size-sm">{!!$project->project_progress_comment??''!!}</td>
{{--                    <td class="font-w600 font-size-sm">Comment</td>--}}
                    @if($project->project_progress === '100')
                        <td>
                            <button class="btn btn-secondary" disabled>Completed!</button>
                            {{--                            /working/project/Status/modal--}}
                        </td>
                    @else
                        <td>
                            <button class="btn btn-secondary" onclick="commonAjaxModel('working/project/Status/modal',{{$project->id}})">Update Progress</button>
{{--                            /working/project/Status/modal--}}
                        </td>
                    @endif
{{--                    @endif--}}
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
