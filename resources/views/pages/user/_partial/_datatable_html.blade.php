<div class="block-header">
    <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>
    <x-button class="btn btn-primary" onclick="commonAjaxModel('adduser_modal')" data-validation="validation-span-id"
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
            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
            <th style="width: 15%;">Registered</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td class="text-center font-size-sm">{{$user->id}}</td>
                    <td class="font-w600 font-size-sm">{{$user->first_name}}{{" "}}{{$user->last_name}}</td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        <em class="text-muted">{{$user->email}}</em>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-primary">Personal</span>
                    </td>
                    <td>
                        <em class="text-muted font-size-sm">{{(isset($user->created_at)?$user->created_at->format('d M'):'')}}</em>
                    </td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td class="text-center font-size-sm">2</td>
            <td class="font-w600 font-size-sm">Carl Wells</td>
            <td class="d-none d-sm-table-cell font-size-sm">
                client2<em class="text-muted">@example.com</em>
            </td>
            <td class="d-none d-sm-table-cell">
                <span class="badge badge-warning">Trial</span>
            </td>
            <td>
                <em class="text-muted font-size-sm">6 days ago</em>
            </td>
        </tr>
        <tr>
            <td class="text-center font-size-sm">3</td>
            <td class="font-w600 font-size-sm">Scott Young</td>
            <td class="d-none d-sm-table-cell font-size-sm">
                client3<em class="text-muted">@example.com</em>
            </td>
            <td class="d-none d-sm-table-cell">
                <span class="badge badge-success">VIP</span>
            </td>
            <td>
                <em class="text-muted font-size-sm">9 days ago</em>
            </td>
        </tr>
        </tbody>
    </table>
</div>
