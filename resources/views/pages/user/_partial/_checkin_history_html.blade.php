<div class="block-content block-content-full">
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Check In Time</th>
            <th>Check Out Time</th>
            <th>Day</th>
            <th>Description</th>
            @can('isAdmin')
            <th>opertaion</th>
            @endcan
        </tr>
        </thead>
            <tbody>
            @if(isset($user_history) && !empty($user_history))
                @foreach($user_history as $data)
                    <tr>
                        <td>{{$data->user_id??''}}</td>
                        <td>{{$data->checkin??''}}</td>
                        <td>{{$data->checkout ??''}}</td>
                        <td>{{$data->created_at->format('d M') ?? ''}}</td>
                        <td>{!!$data->description??'' !!}</td>
                        @can('isAdmin')
                        <td>
                           <button class="btn btn-info" onclick="commonAjaxModel('edit_checkin_user_modal', {{$data->id}})"><i class="fa fa-edit"></i></button>
                           <button class="btn btn-danger" onclick="commonAjaxModel('delete_checkin_user_modal',{{$data->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                       </td>
                       @endcan
                    </tr>
                @endforeach
            @endif
            </tbody>
    </table>
</div>
