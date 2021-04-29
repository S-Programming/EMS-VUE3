<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="utf-8" />
  <style>
    .font-size-h3 {
      font-size: 1.5rem;
    }

    .font-size-h6 {
      font-size: 1rem;
    }

    .table {
      width: 50%;
      margin-bottom: 1rem;
      color: #343a40;
      background-color: transparent;
    }

    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    thead {
      display: table-header-group;
      vertical-align: middle;
      text-align: left;
      border-color: inherit;
    }

    tbody {
      display: table-row-group;
      vertical-align: middle;
      border-color: inherit;
    }

    td {
      padding-left: 20px;
    }

    .table thead th {
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: .0625rem;
      padding-left: 20px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f1f4f5;
    }

    tbody tr:hover {
      background: #f1f4f5;
    }

    .table-bordered th,
    .table-bordered td {
      border: 1px solid #e1e6e9;
    }

    .table-bordered thead th,
    .table-bordered thead td {
      border-bottom-width: 2px;
    }

    .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #e1e6e9;
    }
  </style>
</head>

<body>
  <p class="font-size-h3">What I Have Done Today?</p>
  <p class="font-size-h6">Modify and add new tasks to your daily
    report</p>
  <div class="block-content block-content-full">
    @if(isset($userTaskLogs) && count($userTaskLogs)>0)
    <table class="table table-bordered table-striped table-vcenter table-hover table-bordered">
      <thead>
        <tr>
          <th>Project</th>
          <th>Description</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        @foreach($userTaskLogs as $data)
        <tr>
          <td style="padding-right:10px">{{$data->project->name??''}}</td>
          <td>{!!$data->description ??''!!}</td>
          <td>{{$data->time ?? ''}}</td>
        </tr>
        @endforeach
      </tbody>


    </table>
  </div>
  <div>
    <p class="font-size-h3">What I'll do tomorrow?</p>
    <span>{{$checkinHistoryData->do_tomorrow??''}}</span>
  </div>
  <div>
    <p class="font-size-h3">Any Questions / Roadblocks?</p>
    <span>{{$checkinHistoryData->questions??''}}</span>
  </div>
  @else
  <div> Adds Tasks to show here.</div>
  @endif
</body>

</html>