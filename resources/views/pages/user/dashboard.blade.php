<x-backend-layout>
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
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
                    <div class="d-inline-block">

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
            </div>
        </div>
    </div>
    <!-- END Hero -->


<!-- New Dashboard huh -->
    <!-- Page Content -->
    <div class="content">
        <!-- Row-01 -->
        <div class="row">
            <div class="col-6 col-sm-4 col-md-2 col-lg-2" id="checkin-section">
                @includeWhen(!$is_checkin,'pages.user._partial._checkin_html')
                @includeWhen($is_checkin,'pages.user._partial._checkout_html')
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-success">33%</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Profit
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-dark">109</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Orders Today
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-dark">$8920</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Earnings Today
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-dark">$8920</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Earnings Today
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-primary">35</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Pending Orders
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- /Row-01 -->

        <!-- Row-02 -->
        <div class="row row-deck">
            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div
                        id="jQuery"
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">Monthly Users</dt>
                            <dd class="text-muted mb-0">This Month : {{$monthlyCheckins}}</dd>
                            <dd class="text-muted mb-0">Previous Month : {{$previousMonthCheckins}}</dd>
                            <dd class="text-muted mb-0">Current Week : {{$currentWeekCheckins}}</dd>
                            <dd class="text-muted mb-0">Past Week : {{$pastWeekCheckins}}</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-users font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all Users.
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">32</dt>
                            <dd class="text-muted mb-0">Pending Orders</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all orders
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">32</dt>
                            <dd class="text-muted mb-0">Pending Orders</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all orders
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">32</dt>
                            <dd class="text-muted mb-0">Pending Orders</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all orders
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row-02 -->

        <!-- Row-03-->
        <div class="row">
            <div class="col-xl-12 d-flex flex-column">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title bold">My Checkin History</h3>
                        <div class="block-options">

                            <div class="mt-3 mt-sm-0 ml-sm-3">
                                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle"
                                        data-target="#one-dashboard-search-orders" data-class="d-none">
                                    <i class="fa fa-search"></i>
                                </button>
                                <div class="d-inline-block">
                                    <select class="dropdown form-control "
                                            onchange="ajaxCallOnclick('user_report_history',{history_report:this.options[this.selectedIndex].text??'All Checkin History'})"
                                            name="user_id">
                                        <option>All</option>
                                        <option>Previous Week</option>
                                        <option>Current Week</option>
                                        <option>Previous Month</option>
                                        <option>Current Month</option>
                                        {{-- <option value="All">All</option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                        <!-- Search Form -->
                        <form action="#" method="POST" onsubmit="">
                            <div class="form-group push">
                                <div class="input-group">
                                    <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" id=""
                                           name="demo-search" placeholder="JS flatpickr"
                                           data-mode="range"
                                           data-min-date="today">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <button type="submit" class="btn btn-sm"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END Search Form -->
                    </div>
                    <div class="block-content" id="self-checkin-history">
                        {!!$checkin_history_html!!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row-03-->

        <!-- 04 -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title bold">My Checkin History</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row items-push">
                    <div class="col-lg-8">
                        <form action="{{ route('checkin.history.bt.dates') }}" method="POST" id="filter-form-id-bt-dates">
                            @csrf
                            <div class="form-group row">
                                <div class="col-5">
                                    <label for="">Start Date: </label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control form-control-alt form-control-lg" name="start_date" data-date-format="mm-dd-yyyy" data-autoclose="true" readonly>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                   
                                    @if($errors->has('start_date'))
                                        <div class="error">{{ $errors->first('start_date') }}</div>
                                    @endif
                                    {{-- @error('start_date')
                                        <div class="error">{{ $message }}</div>
                                    @enderror --}}
                                </div>
                                <div class="col-5">
                                    <label for="d2">End Date: </label>                
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" class="form-control form-control-alt form-control-lg" name="end_date" data-date-format="mm-dd-yyyy" data-autoclose="true" readonly>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>

                                    {{-- <input type="text" name="end_date" id="end_date" class="js-datepicker form-control js-datepicker-enabled" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" readonly /> --}}

                                    {{-- <input type="date" name="end_date" id="end_date" class="datepicker"data-date-format="yyyy-mm-dd" readonly /> --}}

                                    {{-- <input type="date" name="end_date" id="end_date" class="datepicker" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" readonly /> --}}
                                    {{-- @if($errors->has('end_date'))
                                        <div class="error">{{ $errors->first('end_date') }}</div>
                                    @endif --}}
                                    @error('end_date')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-2">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-dark btn-sm form-control" onclick="validateFieldsByFormId(this)"
                                    data-validation="validation-span-id"
                                    id="validation-span-id">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="block-options">
                            <div class="mt-3 mt-sm-0 ml-sm-3">
                                {{-- <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle"
                                        data-target="#one-dashboard-search-orders" data-class="d-none">
                                    <i class="fa fa-search"></i>
                                </button> --}}
                                <label>Choose History</label>
                                <div class="Zd-inline-block">
                                    <select class="dropdown form-control " onchange="ajaxCallOnclick('user_report_history',{history_report:this.options[this.selectedIndex].text??'All Checkin History'})" name="user_id">
                                        <option>All</option>
                                        <option>Previous Week</option>
                                        <option>Current Week</option>
                                        <option>Previous Month</option>
                                        <option>Current Month</option>
                                        {{-- <option value="All">All</option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content bg-body-light">
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
                <div class="block-content" id="self-checkin-history">
                    {!!$checkin_history_html ??''!!}
                </div>
            </div>
        </div>
        <!-- /04 -->

        <!-- Row-05 -->
        <div class="row">
            <div class="col-lg-6">
                <div class="block block-rounded block-mode-loading-oneui">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Earnings in $</h3>
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
                    <div class="block-content p-0 text-center">
                        <div class="pt-3" style="height: 360px;">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas class="js-chartjs-dashboard-earnings chartjs-render-monitor"
                                    style="display: block; height: 344px;"
                                    height="344"></canvas>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row items-push text-center py-3">
                            <div class="col-6 col-xl-3">
                                <i class="fa fa-wallet fa-2x text-muted"></i>
                                <div class="text-muted mt-3">$148,000</div>
                            </div>
                            <div class="col-6 col-xl-3">
                                <i class="fa fa-angle-double-up fa-2x text-muted"></i>
                                <div class="text-muted mt-3">+9% Earnings</div>
                            </div>
                            <div class="col-6 col-xl-3">
                                <i class="fa fa-ticket-alt fa-2x text-muted"></i>
                                <div class="text-muted mt-3">+20% Tickets</div>
                            </div>
                            <div class="col-6 col-xl-3">
                                <i class="fa fa-users fa-2x text-muted"></i>
                                <div class="text-muted mt-3">+46% Clients</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="block block-rounded block-mode-loading-oneui">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Sales</h3>
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
                    <div class="block-content p-0 text-center">
                        <div class="pt-3" style="height: 360px;">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas class="js-chartjs-dashboard-sales chartjs-render-monitor"
                                    style="display: block;"
                                    height="344"></canvas>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row items-push text-center py-3">
                            <div class="col-6 col-xl-3">
                                <i class="fab fa-wordpress fa-2x text-muted"></i>
                                <div class="text-muted mt-3">+20%</div>
                            </div>
                            <div class="col-6 col-xl-3">
                                <i class="fa fa-font fa-2x text-muted"></i>
                                <div class="text-muted mt-3">+25% Fonts</div>
                            </div>
                            <div class="col-6 col-xl-3">
                                <i class="fa fa-archive fa-2x text-muted"></i>
                                <div class="text-muted mt-3">-10% Icons</div>
                            </div>
                            <div class="col-6 col-xl-3">
                                <i class="fa fa-paint-brush fa-2x text-muted"></i>
                                <div class="text-muted mt-3">+8% Graphics</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row-05 -->

        <!-- Row 06 -->
        <!-- Statistics -->
        <div class="row">
            <div class="col-xl-8 d-flex flex-column">
                <!-- Earnings Summary -->
                <div class="block block-rounded flex-grow-1 d-flex flex-column">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Earnings Summary</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
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
                                    <dt class="font-size-h2 font-w700">570</dt>
                                    <dd class="text-muted mb-0">Total Orders</dd>
                                </dl>
                                <div>
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-light">
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
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-light">
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
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-light">
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
        <!-- /Row 06 -->

        <!-- Row-07 -->
        <div class="row">
            <div class="col-xl-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Top Products</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter font-size-sm">
                            <tbody>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.965</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Diablo III</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.154</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Control</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.523</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Minecraft</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.423</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Hollow Knight</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.391</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Sekiro: Shadows Die Twice</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.218</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">NBA 2K20</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.995</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Forza Motorsport 7</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.761</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Minecraft</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.860</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Dark Souls III</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.952</a>
                                </td>
                                <td>
                                    <a href="be_pages_ecom_product_edit.html">Age of Mythology</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Latest Orders</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter font-size-sm">
                            <tbody>
                            <tr>
                                <td class="font-w600 text-center" style="width: 100px;">
                                    <a href="be_pages_ecom_order.html">ORD.7116</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Lori Moore</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Delivered</span>
                                </td>
                                <td class="font-w600 text-right">$867,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7115</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Brian Cruz</a>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Canceled</span>
                                </td>
                                <td class="font-w600 text-right">$168,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7114</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Lori Moore</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Delivered</span>
                                </td>
                                <td class="font-w600 text-right">$948,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7113</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Adam McCoy</a>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Processing</span>
                                </td>
                                <td class="font-w600 text-right">$983,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7112</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Jesse Fisher</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Delivered</span>
                                </td>
                                <td class="font-w600 text-right">$583,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7111</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Alice Moore</a>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Processing</span>
                                </td>
                                <td class="font-w600 text-right">$775,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7110</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Helen Jacobs</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Delivered</span>
                                </td>
                                <td class="font-w600 text-right">$158,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7109</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Sara Fields</a>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Processing</span>
                                </td>
                                <td class="font-w600 text-right">$459,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7108</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Lori Moore</a>
                                </td>
                                <td>
                                    <span class="badge badge-success">Delivered</span>
                                </td>
                                <td class="font-w600 text-right">$653,00</td>
                            </tr>
                            <tr>
                                <td class="font-w600 text-center">
                                    <a href="be_pages_ecom_order.html">ORD.7107</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="be_pages_ecom_customer.html">Ryan Flores</a>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Canceled</span>
                                </td>
                                <td class="font-w600 text-right">$100,00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row-07 -->

        <!-- Row-08 -->
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Orders Overview</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div style="height: 400px;">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas class="js-chartjs-overview chartjs-render-monitor"
                                    style="display: block; width: 1009px; height: 400px;" width="1009"
                                    height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row-08 -->
    </div>
    <!-- /Page Content -->
</x-backend-layout>

