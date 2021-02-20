<div class="block-header">
    <h3 class="block-title">Comments On Feedbacks </h3>
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
            <th class="text-center">Admin Comment</th>
            <th class="text-center">viewed</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($user_quries))
            @foreach($user_quries as $user_qurie)
                <tr>
                    {{--            <td class="font-size-sm">{{$feedback->first_name??''}}  {{$feedback->last_name??''}}</td>--}}
{{--                    <td class="font-w600 font-size-sm">{{$feedback->email??''}}</td>--}}
                    <td class="font-w600 font-size-sm">{{$user_qurie->topic??''}}</td>
                    <td class="font-w600 font-size-sm">{!!$user_qurie->description??''!!}</td>
                    <td class="font-w600 font-size-sm">{{$user_qurie->rate_status??''??''}}</td>
                    <td class="font-w600 font-size-sm">{!!$user_qurie->admin_comment??''!!}</td>
                    <td class="text-center text-info font-w600 font-size-sm">{{$user_qurie->is_view??''}}</td>

                    {{--            <td>--}}
                    {{--                <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('edit_product_modal',{{$stock->product->id??''}})"><i class="fa fa-edit"></i></button>--}}
                    {{--                <button class="d-inline btn btn-sm btn-alt-danger" onclick="commonAjaxModel('delete_product_modal',{{$stock->product->id??''}})"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                    {{--                <button class="d-inline btn btn-sm btn-alt-info" onclick="commonAjaxModel('view_product_modal',{{$stock->product->id??''}})"><i class="fa fa-eye" aria-hidden="true"></i></button>--}}
                    {{--            </td>--}}
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>
