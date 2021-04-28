<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="utf-8" />
</head>

<body>
  <h2>Task Log Detail</h2>
  <div class="block-content block-content-full">
    @if(isset($userTaskLogs) && count($userTaskLogs)>0)
    <table class="table table-bordered table-striped table-vcenter table-hover table-bordered">
      <thead>
        <tr>
          <!-- <th>User Name</th> -->
          <th>Project</th>
          <th>Description</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        @foreach($userTaskLogs as $data)
        <tr>
          <!-- <td>{{$data->user->first_name??''}} {{$data->user->last_name??''}}</td> -->
          <td>{{$data->project->name??''}}</td>
          <td>{!!$data->description ??''!!}</td>
          <td>{{$data->time ?? ''}}</td>
        </tr>
        @endforeach
      </tbody>


    </table>

    <table class="table table-bordered table-striped table-vcenter table-hover table-bordered">
      <thead>
        <tr>
          <!-- <th>User Name</th> -->
          <th>Do Tomorrow</th>
          <th>Question</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        @dd($userTaskLogs->checkin())
          <!-- <td>{{$data->user->first_name??''}} {{$data->user->last_name??''}}</td> -->
          <td>{{$userTaskLogs->checkin->do_tomorrow??''}}</td>
          <td>{{$userTaskLogs->checkin->questions??''}}</td>
        </tr>
      </tbody>


    </table>

    @else
    <div> Adds Tasks to show here.</div>
    @endif

  </div>

</body>

</html>