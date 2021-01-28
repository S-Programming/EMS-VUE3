<div class="block-content block-content-full">
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
            <th>User ID</th>
            {{-- @if(isset($name) && !empty($name)) --}}
            <th>User Name</th>
            {{-- @endif --}}
            <th>Is Present</th>
            <th>Created At</th>
            {{--<th>Description</th>
            @can('isAdmin')
            <th>opertaion</th>
            @endcan --}}
        </tr>
        </thead>
        <tbody>
            {{-- @if(isset($todayAttendance) && !empty($todayAttendance)) --}}
                @foreach($todayAttendance as $data)
                    <tr>
                        <td>{{$data->user_id??''}}</td>
                        {{-- @if(isset($name) && !empty($name)) --}}
                        <td>{{ $data->user->first_name . ' ' . $data->user->last_name  ?? '' }}</td>
                        {{-- @endif --}}
                        <td>{{($data->is_present == '0') ? 'Absent' : 'Present'}}</td>
                        <td>{{$data->created_at->format('d M') ?? ''}}</td>
                        {{--<td>{!!$data->description??'' !!}</td>
                        @can('isAdmin') --}}
                        {{-- <td>
                           <button class="btn btn-info" onclick="commonAjaxModel('edit_checkin_user_modal', {{$data->id}})"><i class="fa fa-edit"></i></button>
                           <button class="btn btn-danger" onclick="commonAjaxModel('delete_checkin_user_modal',{{$data->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                       </td> --}}
                       {{-- @endcan --}}
                    </tr>
                @endforeach
            {{-- @endif --}}
            </tbody>
    </table>
</div>
