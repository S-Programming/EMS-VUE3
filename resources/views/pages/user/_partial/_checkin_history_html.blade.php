<div class="table-responsive">
    <table class="table table-borderless table-striped table-vcenter">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Check In Time</th>
            <th>Check Out Time</th>
            <th>Day</th>
            <th>Description</th>
        </tr>
        </thead>
            <tbody>
            @if(isset($user_history) && !empty($user_history))
                @foreach($user_history as $data)
                    <tr>
                        <th>{{$data->user_id??''}}</th>
                        <th>{{$data->checkin??''}}</th>
                        <th>{{$data->checkout ?? ""}}</th>
                        <th>{{$data->created_at->format('d M') ?? ""}}</th>
                        <th>{!!$data->description??'' !!}</th>
                    </tr>
                @endforeach
            @endif
            </tbody>
    </table>
</div>