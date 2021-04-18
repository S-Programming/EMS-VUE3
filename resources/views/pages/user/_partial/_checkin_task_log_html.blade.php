<div class="block-content block-content-full">
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Project Name</th>
                <th>Description</th>
                <th>Time</th>
                <th>opertaion</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($user_task_logs) && !empty($user_task_logs))
            @foreach($user_task_logs as $data)
            <tr>
                <td>{{$data->user->first_name??''}} {{$data->user->last_name??''}}</td>
                <td>{{$data->project->name??''}}</td>
                <td>{{$data->description ??''}}</td>
                <td>{{$data->time ?? ''}}</td>
                <td>
                    <button class="btn btn-info" onclick="commonAjaxModel('edit/checkin/user/modal', {{$data->id}})"><i class="fa fa-edit"></i></button>
                    <!-- <button class="btn btn-danger" onclick="commonAjaxModel('delete/checkin/user/modal',{{$data->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button> -->
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>