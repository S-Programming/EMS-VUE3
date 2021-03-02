<div class="block-header">
    <h3 class="block-title">Status List<!--  <small>Full pagination</small> --></h3>
    <x-button class="btn btn-primary" onclick="commonAjaxModel('add/status/modal')" data-validation="validation-span-id" id="validation-span-id">Add
    </x-button>
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
            <tr>
                <th class="text-center" style="width: 80px;">ID</th>
                <th>Status</th>
                <th style="width: 15%;">opertaion</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($request_status) && !empty($request_status))
            @foreach($request_status as $data)
            <tr>
                <td class="text-center font-size-sm">{{$data->id}}</td>
                <td class="font-w600 font-size-sm">{{$data->status}}</td>
                <td>
                    <button class="btn btn-info" onclick="commonAjaxModel('edit/status/modal',{{$data->id}})"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="commonAjaxModel('delete/status/modal',{{$data->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>

                </td>
            </tr>
            @endforeach

            @endif
        </tbody>
    </table>
</div>
