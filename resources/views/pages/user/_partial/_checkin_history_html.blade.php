<div class="block-content block-content-full">
    <table data-order='[[ 0, "desc" ]]' id="table-desc" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
            <tr>
                <!-- <th>User ID</th> -->
                <th>Check In Time</th>
                <th>Check Out Time</th>
                <th>Day</th>
                <th>Tags</th>
                <th>Do Tomorrow</th>
                <th>Any Question</th>
                <!-- <th>Done Today</th> -->
                <th>Summary Detail</th>
                @can('isAdmin')
                <th>opertaion</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @if(isset($user_history) && !empty($user_history))
            @foreach($user_history as $data)
            <tr>
                <!-- <td>{{$data->user_id??''}}</td> -->
                <td>{{$data->checkin??''}}</td>
                <td>{{$data->checkout ??''}}</td>
                <td>{{$data->created_at->format('d M') ?? ''}}</td>
                <td>
                    @if(isset($data) && !empty($data))
                    @foreach($data->tags as $tag)
                    <span class="badge text-white" style="background-color: {{$tag->color}}"> {{$tag->name ?? ''}}</span>
                    @endforeach
                    @endif
                </td>
                <td>{!!$data->do_tomorrow??'' !!}</td>
                <td>{!!$data->questions??'' !!}</td>
                <!-- <td>{!!$data->done_today??'' !!}</td> -->
                <td class="text-center"><button class="btn btn-primary" onclick="commonAjaxModel('report/today/modal', {{$data->id}})"><span class="text-center">Summary</span></button></td>
                @can('isAdmin')
                <td>
                    <button class="btn btn-info" onclick="commonAjaxModel('edit/checkin/user/modal', {{$data->id}})"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="commonAjaxModel('delete/checkin/user/modal',{{$data->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
                @endcan
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>