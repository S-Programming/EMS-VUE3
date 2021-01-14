<div class="block-header">
    <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>
    {{-- <x-button class="btn btn-primary" onclick="commonAjaxModel('adduser_modal')" data-validation="validation-span-id"
              id="validation-span-id">Add
    </x-button> --}}
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
            <th class="text-center" style="width: 80px;">User ID</th>
            <th>Check In Time</th>
            <th class="d-none d-sm-table-cell" style="width: 30%;">Check Out Time</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Day</th>
            <th style="width: 15%;">Description</th>
        </tr>
        </thead>
        <tbody>
        @if($pastWeekCheckins)
            @foreach($pastWeekCheckins as $report)
                <tr>
                    <td class="text-center font-size-sm">{{$report->user_id??''}}</td>
                    <td class="font-w600 font-size-sm">{{$report->checkin??''}}</td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        <em class="text-muted">{{$report->checkout ?? ""}}</em>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-primary">{{$report->created_at->format('d M') ?? ""}}</span>
                    </td>
                    <td>
                        <em class="text-muted font-size-sm">{!!$report->description??'' !!}</em>
                    </td>
                    <td>
                         {{-- <button class="btn btn-info" onclick="commonAjaxModel('edituser_modal',{{$user->id}})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="commonAjaxModel('deleteuser_modal',{{$user->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button> --}}

                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
