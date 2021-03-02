<div class="block-header">
    <h3 class="block-title">Expense </h3>
    <x-button class="btn btn-primary" onclick="commonAjaxModel('claim/expense/modal')" data-validation="validation-span-id" id="validation-span-id">Claim
    </x-button>
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
            <tr>
                <th style="width: 15%;">ID</th>
                <th style="width: 15%;">Reason</th>
                <th class="d-none d-sm-table-cell" style="width: 30%;">Description</th>
                <th class="d-none d-sm-table-cell" style="width: 30%;">Comments</th>
                <th class="d-none d-sm-table-cell" style="width: 30%;">Amount</th>
                <th class="d-none d-sm-table-cell" style="width: 10%;">Status</th>

            </tr>
        </thead>
        <tbody>
            @if(isset($expense) && !empty($expense))
            @foreach($expense as $data)
            <tr>
                <td class="font-w600 font-size-sm">{{$data->id}}</td>
                <td class="font-w600 font-size-sm">{{$data->reason}}</td>
                <td class="font-w600 font-size-sm">{!! $data->description !!}</td>
                <td class="font-w600 font-size-sm">{!! $data->comments !!}</td>
                <td class="font-w600 font-size-sm">{{$data->amount}}</td>
                <td class="font-w600 font-size-sm">{{$data->requestStatus->status}}</td>

            </tr>
            @endforeach

            @endif
        </tbody>
    </table>
</div>
