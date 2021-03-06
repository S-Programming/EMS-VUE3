<div class="block-header">
    <h3 class="block-title">Holiday List </h3>
{{--    @can('isAdmin')--}}
    @can('isHumanResourceManager')
     <x-button class="btn btn-success" onclick="commonAjaxModel('add/holiday/modal')" data-validation="validation-span-id"
              id="validation-span-id">Import CSV
    </x-button>
    &nbsp;
    <x-button class="btn btn-primary filepond" onclick="commonAjaxModel('add/holiday/modal')" data-validation="validation-span-id"
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
            <th>Start Date</th>
            <th>End Date</th>
            <th>Name</th>
            <th style="width: 15%;">Registered</th>
{{--            @can('isAdmin')--}}
            @can('isHumanResourceManager')
            <th style="width: 15%;">opertaion</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        @if(isset($holidays))
            @foreach($holidays as $data)
                <tr>
                    <td class="text-center font-size-sm">{{$data->id}}</td>
                    <td class="font-w600 font-size-sm">{{$data->start_date}}</td>
                    <td class="font-w600 font-size-sm">{{$data->end_date}}</td>
                    <td class="font-w600 font-size-sm">{{$data->name}}</td>
                    <td>
                        <em class="text-muted font-size-sm">{{(isset($data->created_at)?$data->created_at->format('d M'):'')}}</em>
                    </td>
{{--                    @can('isAdmin')--}}
                    @can('isHumanResourceManager')
                    <td>
                         <button class="btn btn-info" onclick="commonAjaxModel('edit/holiday/modal',{{$data->id}})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="commonAjaxModel('delete/holiday/modal',{{$data->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>

                    </td>
                    @endcan
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
