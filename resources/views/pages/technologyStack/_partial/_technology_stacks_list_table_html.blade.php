<div class="block-header">
    <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>
    <x-button class="btn btn-primary" onclick="commonAjaxModel('add/technology/stack/modal')" data-validation="validation-span-id"
              id="validation-span-id">Add
    </x-button>
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
        <thead>
        <tr>
            <th class="text-center" style="width: 80px;">ID</th>
            <th>Name</th>
            <!-- <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
            <th style="width: 15%;">Registered</th> -->
            <th style="width: 15%;">opertaion</th>
        </tr>
        </thead>
        <tbody>
        @if($technology_stacks)
            @foreach($technology_stacks as $technology_stack)
                <tr>
                    <td class="text-center font-size-sm">{{$technology_stack->id}}</td>
                    <td class="font-w600 font-size-sm">{{$technology_stack->name}}</td>
                    <td>
                         <button class="btn btn-info" onclick="commonAjaxModel('edit/technology/stack/modal',{{$technology_stack->id}})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="commonAjaxModel('delete/technology/stack/modal',{{$technology_stack->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>

                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
