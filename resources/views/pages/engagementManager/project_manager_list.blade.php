{{--<x-backend-layout>--}}
{{--    <!-- Hero -->--}}
{{--    <div class="bg-body-light">--}}
{{--        <div class="content content-full">--}}
{{--            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">--}}
{{--                <h1 class="flex-sm-fill h3 my-2">--}}
{{--                    Project Managers <!-- <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Tables transformed with dynamic features.</small> -->--}}
{{--                </h1>--}}
{{--                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">--}}
{{--                    <ol class="breadcrumb breadcrumb-alt">--}}
{{--                        <li class="breadcrumb-item">Tables</li>--}}
{{--                        <li class="breadcrumb-item" aria-current="page">--}}
{{--                            <a class="link-fx" href="">DataTables</a>--}}
{{--                        </li>--}}
{{--                    </ol>--}}
{{--                </nav>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- END Hero -->--}}
{{--    <!-- Page Content -->--}}
{{--    <div class="content">--}}
{{--        <!-- Dynamic Table Full Pagination -->--}}
{{--        --}}{{--        @dd($query_statuses)--}}
{{--        <div id="project-manager-list-section" class="block block-rounded">--}}
{{--            @include('pages.engagmentManager._partial._project_manager_list_table_html',['project_managers' => $project_managers])--}}
{{--        </div>--}}
{{--        <!-- END Dynamic Table Full Pagination -->--}}
{{--    </div>--}}
{{--</x-backend-layout>--}}
<x-backend-layout>
    <!-- Hero -->
    <div class="block-header">
        <h3 class="block-title">Project Managers </h3>
        <x-button class="btn btn-primary" onclick="commonAjaxModel('add/project/manager')" data-validation="validation-span-id"
                  id="validation-span-id">Add Project Manager
        </x-button>
    </div>
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    User <!-- <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Tables transformed with dynamic features.</small> -->
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

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full Pagination -->
        <div id="project-manager-list-section" class="block block-rounded">

            @include('pages.engagementManager._partial._project_manager_list_table_html',['project_managers' => $project_managers])
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
</x-backend-layout>
