<x-backend-layout>

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    DataTables <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Tables transformed with dynamic features.</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">DataTables</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="dropdown mr-3" align="right">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Projects
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item" onclick="location.href = '{{route('assign.project.list')}}'">Pending</button>
            <button class="dropdown-item" onclick="ajaxCallOnclick('user/working/projects',{user_id:{{($user_id??'')}}})">Working</button>
            <button class="dropdown-item" onclick="ajaxCallOnclick('user/completed/projects',{user_id:{{($user_id??'')}}})">Completed</button>
        </div>
    </div>
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full Pagination -->
        <div id="project-list-section" class="block block-rounded">
            @include('pages.admin.projects._partial._project_list_table_html',['projects' => $projects])
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
</x-backend-layout>
