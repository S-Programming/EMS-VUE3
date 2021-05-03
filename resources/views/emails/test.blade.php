<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="utf-8" />
  <style>
    .font-size {
      font-size: 1.5rem;
      background-color: #87bee8;
      width: 49%;
      color: white;
      font-weight: bold;
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
      padding-left: 10px;
    }

    .table thead th {
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: .0625rem;
      padding-left: 20px;
      background: #f1f4f5;
      padding: 10px;
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

    .custom-span {
      padding-left: 10px;
    }
  </style>
</head>

<body>
  <p class="font-size" style="margin-bottom: 15px; padding-left:12px">What I Have Done Today?</p>
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
          <td>{{minutesToReadableFormat($data->time ?? 0)}}</td>
        </tr>
        @endforeach
      </tbody>


    </table>
  </div>
  <div>
    <p class="font-size" style="padding-left:12px">What I'll do tomorrow?</p>
    <span class="custom-span">{{$checkinHistoryData->do_tomorrow??''}}</span>
  </div>
  <div style="margin-top: 15px;">
    <p class="font-size custom-p" style="padding-left:12px; margin-bottom:-40px;">Any Questions / Roadblocks?</p>
    <span class="custom-span">{{$checkinHistoryData->questions??''}}</span>
  </div>
  @else
  <div> Adds Tasks to show here.</div>
  @endif
</body>

</html>