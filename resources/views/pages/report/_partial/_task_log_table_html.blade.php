<div class="block-content block-content-full">
    @if(isset($userTaskLogs) && count($userTaskLogs)>0)
    <table class="table table-bordered table-striped table-vcenter table-hover table-bordered">
        <thead>
            <tr>
                <!-- <th>User Name</th> -->
                <th>Project</th>
                <th>Description</th>
                <th>Time</th>
                @if(isset($is_show_action))
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($userTaskLogs as $data)
            <tr>
                <!-- <td>{{$data->user->first_name??''}} {{$data->user->last_name??''}}</td> -->
                <td>{{$data->project->name??''}}</td>
                <td>{!!$data->description ??''!!}</td>
                <td>{{minutesToReadableFormat($data->time ?? 0)}}</td>
                @if(isset($is_show_action))
                <td>
                    <button class="btn btn-info" onclick="commonAjaxModel('report/edit/modal', {{$data->id??0}})"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="commonAjaxModel('report/delete/modal',{{$data->id??0}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div> Adds Tasks to show here.</div>
    @endif

</div>
