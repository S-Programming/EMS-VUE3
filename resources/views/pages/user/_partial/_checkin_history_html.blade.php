<div class="table-responsive">
    <table class="table table-borderless table-striped table-vcenter">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Check In Time</th>
            <th>Check Out Time</th>
            <th>Day</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
            <tbody>
            @if(isset($user_history) && !empty($user_history))
                @foreach($user_history as $data)
                    <tr>
                        <th>{{$data->user_id??''}}</th>
                        <th>{{$data->checkin??''}}</th>
                        <th>{{$data->checkout ??''}}</th>
                        <th>{{$data->created_at->format('d M') ?? ''}}</th>
                        <th>{!!$data->description??'' !!}</th>
                        <th>
                         <button class="btn btn-info" onclick="commonAjaxModel('edit_user_modal',{{$data->id}})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="commonAjaxModel('delete_checkin_user_modal',{{$data->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>

                        </th>
                    </tr>
                @endforeach
            @endif
            </tbody>
    </table>
</div>
