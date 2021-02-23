<div class="block-header">
    {{--    <h3 class="block-title">Product Record </h3>--}}
    {{--    <x-button class="btn btn-primary" onclick="commonAjaxModel('comment_on_feedback_modal')" data-validation="validation-span-id"--}}
    {{--              id="validation-span-id">Comment--}}
    {{--    </x-button>--}}
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-sm table-striped table-vcenter">
        <thead>
        <tr>
            <th class="text-center">Project Managers</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone Number</th>
            <th class="text-center">Image</th>
            <th class="text-center">Actions</th>

        </tr>
        </thead>
        <tbody>
        @if(isset($project_managers))
            @foreach($project_managers as $project_manager)
                <tr>
                    <td class="font-w600 font-size-sm">{{$project_manager->user->first_name??''}} {{$project_manager->user->last_name??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project_manager->user->email??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project_manager->user->phone_number??''}}</td>
                    <td class="font-w600 font-size-sm">{{$project_manager->user->image_path??''}}</td>
                    <td>
                        <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('edit_project_manager_modal',{{$project_manager->user_id??''}})"><i class="far fa-edit"></i></button>
                        <button class="d-inline btn btn-sm btn-alt-danger" onclick="commonAjaxModel('delete_project_manager_modal',{{$project_manager->user_id??''}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
