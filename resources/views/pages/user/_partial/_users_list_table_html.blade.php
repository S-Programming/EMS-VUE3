<div class="block-header">
    <h3 class="block-title">User Record </h3>
    <x-button class="btn btn-primary" onclick="commonAjaxModel('add_user_modal')" data-validation="validation-span-id"
              id="validation-span-id">Add
    </x-button>
    {{-- <x-button class="btn btn-primary">Upload CSV</x-button> --}}
    <form id="upload_csv" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="custom-file">
            <div class="col-12 mt-5">
                <input type="file" name="csv_file" accept=".csv" class="form-control rounded-0" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" >
            </div>
        </div>
        <input class="mt-3 btn btn-primary mb-4 mt-5 float-right rounded-0 px-4 btn-save" type="submit" onclick="usersCsvUploadByAdmin()" name="upload" id="upload" value="Upload">
    </form>
    {{-- onclick="usersCsvUploadByAdmin()" --}}

</div>
<div class="block-content block-content-full">
    {{-- ajaxCallOnclick('import_users_by_csv')  visitorCsvUploadByOrganizer() --}}
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter  js-dataTable-buttons">
        <thead>
        <tr>
            <th class="text-center" style="width: 80px;">ID</th>
            <th>Name</th>
            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
            <th style="width: 15%;">Registered</th>
            <th style="width: 15%;">opertaion</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($users))
            @foreach($users as $user)
                <tr>
                    <td class="text-center font-size-sm">{{$user->id}}</td>
                    <td class="font-w600 font-size-sm">{{$user->first_name}} {{$user->last_name}}</td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        <em class="text-muted">{{$user->email}}</em>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-primary">{{$user->roles[0]->name??''}}</span>
                    </td>
                    <td>
                        <em class="text-muted font-size-sm">{{(isset($user->created_at)?$user->created_at->format('d M'):'')}}</em>
                    </td>
                    <td>
                         <button class="btn btn-info" onclick="commonAjaxModel('edit_user_modal',{{$user->id}})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="commonAjaxModel('delete_user_modal',{{$user->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button>

                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
