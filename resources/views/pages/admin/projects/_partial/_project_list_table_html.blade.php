<div class="block-header">
    <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>
    <x-button class="btn btn-primary" onclick="commonAjaxModel('add/project/modal')" data-validation="validation-span-id"
              id="validation-span-id">Add Projects
    </x-button>
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
            <th class="text-nowrap">Project Name</th>
            <th class="text-nowrap">Project Manager</th>
            <th class="text-nowrap">Technology Stack</th>
            <th class="text-nowrap">Developers</th>
            <th class="text-nowrap">start_date</th>
            <th class="text-nowrap">Estimate Time</th>
            <th class="text-nowrap">Assign Developers</th>
            <th style="width: 15%;">opertaion</th>
        </tr>
        </thead>
        <tbody>
        @if($projects)
            @foreach($projects as $project)
                <tr>
                    <td class="font-w600 font-size-sm">{{$project->name??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project->users->first_name??''}} {{$project->users->last_name??''}}</td>
                    <td class="font-w600 font-size-sm">
                        @foreach($project->technologystack as $data)
                                     {{$data->name??''}} |
                        @endforeach
                    </td>
                    <td class="text-center font-w600 font-size-sm">{{$project->number_of_developers??''}}</td>

                    <td class="font-w600 font-size-sm">{{$project->start_date??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project->estimate_time??''}}</td>


                    @if(isset($project->project_status) && $project->project_status===0)
                        <td class="font-w600 font-size-sm text-nowrap"><button type="button" class="btn btn-secondary" disabled> Assign Developers </button></td>
                    @elseif($project->project_status===1)
                        <td class="font-w600 font-size-sm"><button type="button" class="btn btn-success" onclick="commonAjaxModel('assign/developers/modal',{{$project->id}})"> Assign Developers </button></td>
                    @endif
                    <td>
                        <button class="btn btn-info" onclick="commonAjaxModel('edit/project/modal',{{$project->id}})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-info" onclick="commonAjaxModel('view/project/modal',{{$project->id}})"><i class="fa fa-eye" aria-hidden="true"></i></button>
                        <button class="btn btn-danger" onclick="commonAjaxModel('delete/project/modal',{{$project->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>

                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
