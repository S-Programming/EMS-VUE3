<div class="block-header">
    <h3 class="block-title">Product Record </h3>
{{--    <x-button class="btn btn-primary" onclick="commonAjaxModel('comment_on_feedback_modal')" data-validation="validation-span-id"--}}
{{--              id="validation-span-id">Comment--}}
{{--    </x-button>--}}
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-sm table-striped table-vcenter">
        <thead>
        <tr>
{{--            <th class="text-center">Name</th>--}}
{{--            <th class="text-center">Email</th>--}}
            <th class="text-center">Topic</th>
            <th class="text-center">Description</th>
            <th class="text-center">Status</th>
            <th class="text-center">Comment</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($feedbacks))
            @foreach($feedbacks as $feedback)
                <tr>
{{--                    <td class="font-size-sm">{{$feedback->first_name??''}}  {{$feedback->last_name??''}}</td>--}}
                    <td class="font-w600 font-size-sm">{{$feedback->topic??''}}</td>
{{--                    <td class="font-w600 font-size-sm">{{$feedback->email??''}}</td>--}}
                    <td class="font-w600 font-size-sm">{!!$feedback->description??''!!}</td>
                    <td class="font-w600 font-size-sm">{{$feedback->rate_status??''??''}}</td>
                    <td class="font-w600 font-size-sm">{!!$feedback->admin_comment??''??''!!}</td>

                                <td>
{{--                                    @dd($feedback->id)--}}
                                    <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('comment_on_feedback_modal',{{$feedback->id??''}})"><i class="far fa-edit"></i></button>
                                    <button class="d-inline btn btn-sm btn-alt-danger" onclick="commonAjaxModel('delete_feedback_modal',{{$feedback->id??''}})"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    {{--                <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('view_product_modal',{{$stock->product->id??''}})"><i class="fa fa-eye" aria-hidden="true"></i></button>--}}
                                </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
