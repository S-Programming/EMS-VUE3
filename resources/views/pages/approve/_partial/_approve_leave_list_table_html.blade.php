<div class="block-header">
    <h3 class="block-title">Leave Approvals <!-- <small>Full pagination</small> --></h3>
    <!-- <x-button class="btn btn-primary" onclick="commonAjaxModel('add_leave_modal')" data-validation="validation-span-id" id="validation-span-id">Add
    </x-button> -->
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
            <tr>
                <th style="width: 15%;">Start Date</th>
                <th style="width: 15%;">End Date</th>
                <th style="width: 20%;">User Name</th>
                <th style="width: 15%;">Leave Type</th>
                <th class="d-none d-sm-table-cell" style="width: 40%;">Description</th>
                <th style="width: 10%;">opertaion</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($approve_leaves) && !empty($approve_leaves))
            @foreach($approve_leaves as $approve_leave)
            <tr>
                <td class="font-w600 font-size-sm">{{$approve_leave->start_date}}</td>
                <td class="font-w600 font-size-sm">{{$approve_leave->end_date}}</td>
                <td class="font-w600 font-size-sm">{{$approve_leave->user->first_name}} {{$approve_leave->user->last_name}}</td>
                <td class="font-w600 font-size-sm">{{$approve_leave->type->type}}</td>
                <td class="font-w600 font-size-sm">{{$approve_leave->description}}</td>
                <td>
                    <button class="btn btn-success" onclick="commonAjaxModel('approve_leave_modal',{{$approve_leave->id}})">Approve</button>
                    <!-- <button class="btn btn-danger" onclick="commonAjaxModel('delete_role_modal',{{$approve_leave->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button> -->

                </td>
            </tr>
            @endforeach

            @endif
        </tbody>
    </table>
</div>
