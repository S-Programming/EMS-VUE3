<div class="block-header">
    <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
            <tr>
                {{-- <th class="text-center" style="width: 80px;">ID</th>--}}
                <th> Name </th>
                <th> Description </th>
                <th> Start Date </th>
                <th> Technology Stack </th>
                <th> Number of Developers </th>
                <th> Download Document </th>
                <th style="width: 15%;">opertaion</th>
            </tr>
        </thead>
        <tbody>
            @if($projects)
            @foreach($projects as $project)
                <tr>
                    <td class="font-w600 font-size-sm">{{$project->name??''}}</td>
                    <td class="font-w600 font-size-sm">{!!$project->description??''!!}</td>
                    <td class="font-w600 font-size-sm">{{$project->start_date??''}}</td>
                    <td class="font-w600 font-size-sm">
                    @foreach($project->technologystack as $data)
                        {{$data->name??''}}
                    @endforeach
                    </td>
                    <td class="font-w600 font-size-sm">{{$project->number_of_developers}}</td>

                <td class="font-w600 font-size-sm"><a class="btn btn-success" href="{{ asset('assets/uploads/files/$project_list->document[0]->path')}}" download="{{$project_list->document[0]->path??''}}">{{$project_list->document[0]->path??''}}</a></td>
                @if($project->project_status === 0)
                <td>
                    <button class="btn btn-info" onclick="commonAjaxModel('developers/request/modal',{{$project->id}})">Developer Request</button>
                </td>
{{--                @elseif($project->project_status === 1 OR $project->project_status === 2)--}}
                @elseif($project->project_status === 1)
                <td>
                    <button class="btn btn-secondary" disabled>Developer Request</button>
                </td>
{{--                @elseif($project->project_status === 2)--}}
{{--                    <td>--}}
{{--                        <button class="btn btn-secondary" disabled>Working</button>--}}
{{--                    </td>--}}
                @endif
            </tr>
            @endforeach
            @endif

        </tbody>
    </table>
</div>
