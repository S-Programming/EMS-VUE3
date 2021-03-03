<div class="block-header">
    <h3 class="block-title">User Interaction Record </h3>
    <x-button class="btn btn-primary" onclick="commonAjaxModel('add/user/interaction/point/modal',{{$user_id??''}})" data-validation="validation-span-id"
              id="validation-span-id">Add User Interaction Point
    </x-button>
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-sm table-striped table-vcenter">
        <thead>
        <tr>
            {{--            <th class="text-center">Name</th>--}}
            <th class="text-center">Staff Name</th>
            <th class="text-center">User Name</th>
            <th class="text-center">Description</th>
            <th class="text-center">Date</th>
{{--            <th class="text-center">Date</th>--}}
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($user_interactions))
            @foreach($user_interactions as $user_interaction)
                <tr>
{{--                    <td class="font-w600 font-size-sm">{{$userInteraction->staff_id??''}}</td>--}}
                    <td class="font-w600 font-size-sm">{{$user_name??''}}</td>
                    <td class="font-w600 font-size-sm">{{$user_interaction->users->first_name??''}} {{$user_interaction->users->last_name??''}}</td>
{{--                    <td class="font-w600 font-size-sm">{{$userInteraction->user_id??''}}</td>--}}
                    <td class="font-w600 font-size-sm">{!!$user_interaction->description??''!!}</td>
                    <td class="font-w600 font-size-sm">{!!$user_interaction->date??''!!}</td>
{{--                    <td class="font-w600 font-size-sm">{{$userInteraction->created_at->format('Y-m-d')??''}}</td>--}}
{{--                    <td class="font-w600 font-size-sm">{{$userInteraction->created_at->format('M d Y')??''}}</td>--}}
                                <td>
                                    <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('delete/user/interaction/modal',{{$user_interaction->id??''}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
{{--                                    <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('users_edit_discussionPoint',{{$userInteraction->id??''}})"><i class="fa fa-edit" aria-hidden="true"></i></button>--}}
                    {{--                <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('view_product_modal',{{$stock->product->id??''}})"><i class="fa fa-eye" aria-hidden="true"></i></button>--}}
                                </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
