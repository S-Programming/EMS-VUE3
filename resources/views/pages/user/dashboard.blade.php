<x-backend-layout :menu_data='$menu_data'>

    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div
                class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="h3 font-w700 mb-2">
                        Main Dashboard
                    </h1>
                    <h2 class="h6 font-w500 text-muted mb-0">
                        Welcome <a class="font-w600" href="javascript:void(0)">{{$user->first_name??''}}</a>, everything looks great.
                    </h2>
                </div>
                <div class="mt-3 mt-sm-0 ml-sm-3">
                    <button type="button" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-primary" id="dropdown-analytics-overview"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-calendar-alt"></i>
                            Last 30 days
                            <i class="fa fa-fw fa-angle-down">
                                <div class="bg-body-light"></div>
                            </i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right font-size-sm"
                             aria-labelledby="dropdown-analytics-overview">
                            <a class="dropdown-item font-w500" href="javascript:void(0)">This Week</a>
                            <a class="dropdown-item font-w500" href="javascript:void(0)">Previous Week</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item font-w500" href="javascript:void(0)">This Month</a>
                            <a class="dropdown-item font-w500" href="javascript:void(0)">Previous Month</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Overview -->
        <div class="row row-deck">
            <div class="col-sm-6 col-xl-3">
                <!-- Pending Orders -->
                <div id="checkin-section" class="block block-rounded d-flex flex-column">
                    @includeWhen(!$is_checkin,'pages.user._partial._checkin_html')
                    @includeWhen($is_checkin,'pages.user._partial._checkout_html')
                </div>
                <!-- END Pending Orders -->
            </div>
            <div class="col-sm-6 col-xl-3">
                <!-- Messages -->
                <div class="block block-rounded d-flex flex-column">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            {{-- <div id="checkintimer"
                                 class="block-content block-content-full block-content-sm bg-body-light font-size-sm"></div> --}}

                            <!-- <dt class="font-size-h2 font-w700">45</dt>
                            <dd class="text-muted mb-0">Messages</dd> -->
                            {{-- <div id="checkintimer" class="block-content block-content-full block-content-sm bg-body-light font-size-sm"></div>
                            <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                            </div> --}}
                           <!--  <form method="GET" action="{{route('userrecord')}}">
                            <input id="user-id" name="specificUserId" type="text" maxlength="6" size="6">
                            <br>
                            @error('specificUserId')
                            <span style="color:red;font-weight:bold;">{{ $message }}</span>
                            @enderror
                            <input type="submit" class="btn btn-block btn-alt-success">
                            </form> -->

                        </dl>

                        <div class="item item-rounded bg-body">
                            <i class="fa fa-inbox font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        {{-- <a class="font-w500 d-flex align-items-center" href="{{ route('userrecord') }}">
                              javascript:void(0)
                            View specific Record
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a> --}}
                    </div>
                </div>
                <!-- END Messages -->
            </div>
            <div class="col-sm-6 col-xl-3">
                <!-- Messages -->
                <div class="block block-rounded d-flex flex-column">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <!-- <dt class="font-size-h2 font-w700">45</dt>
                            <dd class="text-muted mb-0">Messages</dd> -->
                            <div id="jQuery" class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                                <p>Total Checkins:{{ $monthlyCheckins }}</p>
                            </div>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-inbox font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all messages
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Messages -->
            </div>
            <div class="col-sm-6 col-xl-3">
                <!-- Conversion Rate -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <p id="current-timer"></p>


                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View statistics
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Conversion Rate-->
            </div>
        </div>
        <!-- END Overview -->

        <!-- Statistics -->
        <div class="row">
            <div class="col-xl-8 d-flex flex-column">
                <!-- Earnings Summary -->
                <div class="block block-rounded flex-grow-1 d-flex flex-column">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Earnings Summary</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-settings"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full flex-grow-1 d-flex align-items-center">
                        <!-- Earnings Chart Container -->
                        <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
                        <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                        <canvas class="js-chartjs-earnings"></canvas>
                    </div>
                    <div class="block-content bg-body-light">
                        <div class="row items-push text-center w-100">
                            <div class="col-sm-4">
                                <dl class="mb-0">
                                    <dt class="font-size-h3 font-w700">
                                        <i class="fa fa-arrow-up font-size-lg text-success"></i> 2.5%
                                    </dt>
                                    <dd class="text-muted mb-0">Customer Growth</dd>
                                </dl>
                            </div>
                            <div class="col-sm-4">
                                <dl class="mb-0">
                                    <dt class="font-size-h3 font-w700">
                                        <i class="fa fa-arrow-up font-size-lg text-success"></i> 3.8%
                                    </dt>
                                    <dd class="text-muted mb-0">Page Views</dd>
                                </dl>
                            </div>
                            <div class="col-sm-4">
                                <dl class="mb-0">
                                    <dt class="font-size-h3 font-w700">
                                        <i class="fa fa-arrow-up font-size-lg text-success"></i> 1.7%
                                    </dt>
                                    <dd class="text-muted mb-0">New Products</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Earnings Summary -->
            </div>
            <div class="col-xl-4 d-flex flex-column">
                <!-- Last 2 Weeks -->
                <!-- Sparkline Charts (.js-sparkline class is initialized in Helpers.sparkline() -->
                <!-- For more info and examples you can check out http://omnipotent.net/jquery.sparkline/#s-about -->
                <div class="row row-deck flex-grow-1">
                    <div class="col-md-6 col-xl-12">
                        <div class="block block-rounded d-flex flex-column">
                            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                                <dl class="mb-0">
                                    <dt class="font-size-h2 font-w700">{{$count}}</dt>
                                    <dd class="text-muted mb-0">Total Users</dd>
                                </dl>
                                <div>
                                    <div
                                        class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-light">
                                        <i class="fa fa-caret-down mr-1"></i>
                                        2.2%
                                    </div>
                                </div>
                            </div>
                            <div class="block-content p-1 text-center overflow-hidden">
                                <!-- Sparkline Line: Orders -->
                                <span class="js-sparkline" data-type="line"
                                      data-points="[33,29,32,37,38,30,34,28,43,45,26,45,49,39]"
                                      data-width="100%"
                                      data-height="70px"
                                      data-chart-range-min="20"
                                      data-line-color="rgba(210, 108, 122, .4)"
                                      data-fill-color="rgba(210, 108, 122, .15)"
                                      data-spot-color="transparent"
                                      data-min-spot-color="transparent"
                                      data-max-spot-color="transparent"
                                      data-highlight-spot-color="#D26C7A"
                                      data-highlight-line-color="#D26C7A"
                                      data-tooltip-suffix="Orders"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-12">
                        <div class="block block-rounded d-flex flex-column">
                            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                                <dl class="mb-0">
                                    <dt class="font-size-h2 font-w700">$5,234.21</dt>
                                    <dd class="text-muted mb-0">Total Earnings</dd>
                                </dl>
                                <div>
                                    <div
                                        class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-light">
                                        <i class="fa fa-caret-up mr-1"></i>
                                        4.2%
                                    </div>
                                </div>
                            </div>
                            <div class="block-content p-1 text-center oveflow-hidden">
                                <!-- Sparkline Line: Earnings -->
                                <span class="js-sparkline" data-type="line"
                                      data-points="[716,1185,750,1365,956,890,1200,968,1158,1025,920,1190,720,1352]"
                                      data-width="100%"
                                      data-height="70px"
                                      data-chart-range-min="300"
                                      data-line-color="rgba(70,195,123, .4)"
                                      data-fill-color="rgba(70,195,123, .15)"
                                      data-spot-color="transparent"
                                      data-min-spot-color="transparent"
                                      data-max-spot-color="transparent"
                                      data-highlight-spot-color="#46C37B"
                                      data-highlight-line-color="#46C37B"
                                      data-tooltip-prefix="$"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="block block-rounded d-flex flex-column">
                            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                                <dl class="mb-0">
                                    <dt class="font-size-h2 font-w700">264</dt>
                                    <dd class="text-muted mb-0">New Customers</dd>
                                </dl>
                                <div>
                                    <div
                                        class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-light">
                                        <i class="fa fa-caret-up mr-1"></i>
                                        9.3%
                                    </div>
                                </div>
                            </div>
                            <div class="block-content p-1 text-center oveflow-hidden">
                                <!-- Sparkline Line: New Customers -->
                                <span class="js-sparkline" data-type="line"
                                      data-points="[25,15,36,14,29,19,36,41,28,26,29,33,23,41]"
                                      data-width="100%"
                                      data-height="70px"
                                      data-chart-range-min="0"
                                      data-line-color="rgba(70,195,123, .4)"
                                      data-fill-color="rgba(70,195,123, .15)"
                                      data-spot-color="transparent"
                                      data-min-spot-color="transparent"
                                      data-max-spot-color="transparent"
                                      data-highlight-spot-color="#46C37B"
                                      data-highlight-line-color="#46C37B"
                                      data-tooltip-prefix="$"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Last 2 Weeks -->
            </div>
        </div>
        <!-- END Statistics -->

        <!-- Recent Orders -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title bold">My Checkin History</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle"
                            data-target="#one-dashboard-search-orders" data-class="d-none">
                        <i class="fa fa-search"></i>
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-primary" id="dropdown-recent-orders-filters"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-flask"></i>
                            Filters
                            <i class="fa fa-angle-down ml-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right font-size-sm"
                             aria-labelledby="dropdown-recent-orders-filters">
                            <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between"
                               href="javascript:void(0)">
                                Pending..
                                <span class="badge badge-primary badge-pill">35</span>
                            </a>
                            <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between"
                               href="javascript:void(0)">
                                Processing
                                <span class="badge badge-primary badge-pill">15</span>
                            </a>
                            <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between"
                               href="javascript:void(0)">
                                For Delivery
                                <span class="badge badge-primary badge-pill">20</span>
                            </a>
                            <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between"
                               href="javascript:void(0)">
                                Canceled
                                <span class="badge badge-primary badge-pill">72</span>
                            </a>
                            <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between"
                               href="javascript:void(0)">
                                Delivered
                                <span class="badge badge-primary badge-pill">890</span>
                            </a>
                            <a class="dropdown-item font-w500 d-flex align-items-center justify-content-between"
                               href="javascript:void(0)">
                                All
                                <span class="badge badge-primary badge-pill">997</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                <!-- Search Form -->
                <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                    <div class="form-group push">
                        <div class="input-group">
                            <input type="text" class="form-control" id="one-ecom-orders-search"
                                   name="one-ecom-orders-search" placeholder="Search recent orders..">
                            <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-search"></i>
                                            </span>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END Search Form -->
            </div>
            <div class="block-content">
                <!-- Recent Orders Table -->
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Check In Time</th>
                            <th>Check Out Time</th>
                            <th>Day</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($checkin_history) && !empty($checkin_history))
                            @foreach($checkin_history as $data)
                                <tr>
                                    <th>{{$data->user_id??''}}</th>
                                    <th>{{$data->checkin??''}}</th>
                                    <th>{{$data->checkout ?? ""}}</th>
                                    <th>{{$data->created_at->format('d M') ?? ""}}</th>
                                    <th>{!!$data->description??'' !!}</th>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- END Recent Orders Table -->

                <!-- Pagination -->
                <nav aria-label="Photos Search Navigation">
                    <ul class="pagination pagination-sm justify-content-end mt-2">
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                                Prev
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- END Pagination -->
            </div>
        </div>
        <!-- END Recent Orders -->
    </div>
    <!-- END Page Content -->
</x-backend-layout>
