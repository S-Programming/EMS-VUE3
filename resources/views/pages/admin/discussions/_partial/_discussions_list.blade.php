<div class="block-header">
    <h3 class="block-title">User Interaction Record </h3>
{{--    <x-button class="btn btn-primary" onclick="commonAjaxModel('add_userInteraction_point_modal',{{$user_id??''}})" data-validation="validation-span-id"--}}
{{--              id="validation-span-id">Add User Interaction Point--}}
{{--    </x-button>--}}
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-sm table-striped table-vcenter">
        <thead>
        <tr>
            {{--            <th class="text-center">Name</th>--}}
{{--            <th class="text-center">Staff Id</th>--}}
            <th class="text-center">User Name</th>
            <th class="text-center">Description</th>
        </tr>
        </thead>
        <tbody>
{{--        @dd($userInteractions['users'])--}}
        @if(isset($userInteractions))
            @foreach($userInteractions as $userInteraction)
{{--            @dd($userInteraction->users->first_name)--}}
                <tr>
                    <td class="font-w600 font-size-sm">{{$userInteraction->users->first_name??''}}</td><td class="font-w600 font-size-sm">{!!$userInteraction->description??''!!}</td>
                </tr>

            @endforeach
        @endif

        </tbody>
    </table>
</div>
