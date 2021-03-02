<div class="block-header">
    <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>
{{--    <x-button class="btn btn-primary" onclick="commonAjaxModel('add_project_modal')" data-validation="validation-span-id"--}}
{{--              id="validation-span-id">Projects In Working--}}
{{--    </x-button>--}}
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
            {{--            <th class="text-center" style="width: 80px;">ID</th>--}}
            <th>Project Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Project Manager</th>
            <th>Number of Developers</th>
            <th>Technology Stack</th>
{{--            <th>Assign Developers</th>--}}
            <!-- <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
            <th style="width: 15%;">Registered</th> -->
{{--            <th style="width: 15%;">opertaion</th>--}}
        </tr>
        </thead>
        <tbody>
        @if($projects)
            @foreach($projects as $project)
                <tr>
                    {{--                    <td class="text-center font-size-sm">{{$project->id}}</td>--}}
                    <td class="font-w600 font-size-sm">{{$project->name??''}}</td>
{{--                    <td class="font-w600 font-size-sm">{!!$project->description??''!!}</td>--}}
                    <td class="font-w600 font-size-sm">{{$project->start_date??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project->end_date??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project->users->first_name??''}} {{$project->users->last_name??''}}</td>
                    <td class="text-center font-w600 font-size-sm">{{$project->number_of_developers??''}}</td>
                    <td class="font-w600 font-size-sm">
                        @foreach($project->technologystack as $data)
                            {{$data->name??''}}
                        @endforeach
                    </td>
{{--                    <td class="font-w600 font-size-sm">{{$project->technologystack[0]->name??''}}</td>--}}
{{--                    @if(isset($project->in_working_list) && $project->in_working_list===1)--}}
{{--                        --}}{{--                        false--}}
{{--                        <td class="font-w600 font-size-sm"><button type="button" class="btn btn-success" disabled> Submit </button></td>--}}
{{--                    @else--}}
{{--                        --}}{{--                        true--}}
{{--                        <td class="font-w600 font-size-sm"><button type="button" class="btn btn-success" onclick="commonAjaxModel('assign_developers_modal',{{$project->id}})"> Assign </button></td>--}}

{{--                    @endif--}}
                    {{--                    <td class="font-w600 font-size-sm"><button type="button" class="btn btn-success" disabled="{{((isset($project->in_working_list))&&($project->in_working_list===1)?true:false}}"> Submit </button></td>--}}
{{--                    <td>--}}
{{--                        <button class="btn btn-info" onclick="commonAjaxModel('edit_project_modal',{{$project->id}})"><i class="fa fa-edit"></i></button>--}}
{{--                        <button class="btn btn-danger" onclick="commonAjaxModel('delete_project_modal',{{$project->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}

{{--                    </td>--}}
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
