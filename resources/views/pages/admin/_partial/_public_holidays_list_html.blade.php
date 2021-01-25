<div class="block-header">
    <h3 class="block-title">Holiday List </h3>
    @can('isAdmin')
    <x-button class="btn btn-primary" onclick="commonAjaxModel('add_public_holiday_modal')" data-validation="validation-span-id"
              id="validation-span-id">Add
    </x-button>
    @endcan
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
            <th class="text-center" style="width: 80px;">ID</th>
            <th>Date</th>
            <th>Name</th>
            <th style="width: 15%;">Registered</th>
            @can('isAdmin')
            <th style="width: 15%;">opertaion</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        @if(isset($holidays))
            @foreach($holidays as $data)
                <tr>
                    <td class="text-center font-size-sm">{{$data->id}}</td>
                    <td class="font-w600 font-size-sm">{{$data->date}}</td>
                    <td class="font-w600 font-size-sm">{{$data->name}}</td>
                    <td>
                        <em class="text-muted font-size-sm">{{(isset($data->created_at)?$data->created_at->format('d M'):'')}}</em>
                    </td>
                    @can('isAdmin')
                    <td>
                         <button class="btn btn-info" onclick="commonAjaxModel('edit_public_holiday_modal',{{$data->id}})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="commonAjaxModel('delete_public_holiday_modal',{{$data->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>

                    </td>
                    @endcan
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
