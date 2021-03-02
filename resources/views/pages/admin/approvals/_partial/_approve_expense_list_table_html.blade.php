<div class="block-header">
    <h3 class="block-title">Expense Approvals <!-- <small>Full pagination</small> --></h3>
    <!-- <x-button class="btn btn-primary" onclick="commonAjaxModel('add_leave_modal')" data-validation="validation-span-id" id="validation-span-id">Add
    </x-button> -->
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
            <tr>
                <th style="width: 15%;">Name</th>
                <th style="width: 15%;">Reason</th>
                <th style="width: 20%;">Description</th>
                <th style="width: 15%;">Comment</th>
                <th style="width: 15%;">Amount</th>
                <!-- <th style="width: 15%;">Receipt</th> -->
                <th style="width: 15%;">Status</th>
                <th style="width: 10%;">opertaion</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($approve_expense) && !empty($approve_expense))
            @foreach($approve_expense as $data)
            <tr>
                <td class="font-w600 font-size-sm">{{$data->user_id}}</td>
                <td class="font-w600 font-size-sm">{{$data->reason}}</td>
                <td class="font-w600 font-size-sm">{!! $data->description !!}</td>
                <td class="font-w600 font-size-sm">{!! $data->comment !!}</td>
                <td class="font-w600 font-size-sm">{{$data->amount}}</td>
                <td class="font-w600 font-size-sm">{{$data->requestStatus->status}}</td>
                <td>
                    <button class="btn btn-success" onclick="commonAjaxModel('approve/expense/modal',{{$data->id}})">Approve</button>


                </td>
            </tr>
            @endforeach

            @endif
        </tbody>
    </table>
</div>
