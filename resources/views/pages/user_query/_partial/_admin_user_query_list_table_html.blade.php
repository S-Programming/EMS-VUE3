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
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Topic</th>
            <th class="text-center">Description</th>
            <th class="text-center">Status</th>
            <th class="text-center">Comment</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($user_quries))
            @foreach($user_quries as $user_qurie)
                <tr>
                    <td class="font-w600 font-size-sm">{{$user_qurie->users->first_name??''}} {{$user_qurie->users->last_name??''}}</td>
                    <td class="font-w600 font-size-sm">{{$user_qurie->users->email??''}}</td>
                    <td class="font-w600 font-size-sm">{{$user_qurie->topic??''}}</td>
                    <td class="font-w600 font-size-sm">{!!$user_qurie->description??''!!}</td>
                    <td class="font-w600 font-size-sm text-center">{{$user_qurie->query_statuses->query_status??''}}</td>
                    <td class="font-w600 font-size-sm">{!!$user_qurie->comment??''!!}</td>

                    <td>
                        <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('comment/on/userquery/modal',{{$user_qurie->id??''}})"><i class="far fa-edit"></i></button>
                        <button class="d-inline btn btn-sm btn-alt-danger" onclick="commonAjaxModel('delete/user/query/modal',{{$user_qurie->id??''}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
