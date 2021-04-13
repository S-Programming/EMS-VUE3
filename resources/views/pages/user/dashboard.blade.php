<x-backend-layout>
    <!-- Hero -->


    <!-- New Dashboard huh -->
    <!-- Page Content -->
    <div class="content">
        <!-- Row-01 -->
        <div class="row">
            <div class="col-6 col-sm-4 col-md-2 col-lg-2" id="checkin-section">
                {{-- @dd("asdsadadsasddadasdasdasdasdas");--}}

                {{-- @dd($is_checkin)--}}
                @includeWhen(!$is_checkin,'pages.user._partial._checkin_html')
                @includeWhen($is_checkin,'pages.user._partial._checkout_html')
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center bg-danger" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-light">0</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Absent
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center bg-danger" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-light">0</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Missing Punches
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center bg-warning" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-light">0</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Short Duration
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center bg-warning" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-light">0</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Late Arrivals
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-lg-2">
                <a class="block block-rounded block-link-shadow text-center bg-warning" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-h3 text-light">0</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Early Left
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

                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <!-- <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            Leaves Summary
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a> -->
                        <dt class="font-size-h3 font-w600 text-dark text-center">Leaves Summary</dt>
                    </div>

                    <div id="jQuery" class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center bg-info">
                        <dl class="mb-0">
                            <dd class="text-muted mb-0">
                                <p class="text-light"> This Month : {{$monthlyCheckins}} </p>
                            </dd>
                            <dd class="text-muted mb-0">
                                <p class="text-light"> Previous Month : {{$previousMonthCheckins}} </p>
                            </dd>
                            <dd class="text-muted mb-0">
                                <p class="text-light"> Current Week : {{$currentWeekCheckins}} </p>
                            </dd>
                            <dd class="text-muted mb-0">
                                <p class="text-light"> Past Week : {{$pastWeekCheckins}} </p>
                            </dd>
                        </dl>
                        <!-- <div class="item item-rounded bg-body">
                            <i class="fa fa-users font-size-h3 text-primary"></i>
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all leaves summary.
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <!-- <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            Leaves Summary
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a> -->
                        <dt class="font-size-h3 font-w600 text-dark text-center">Total Leaves</dt>
                    </div>
                    <div class="block-content block-content-full flex-grow-1 flex-column d-flex justify-content-center align-items-center bg-secondary">
                        <p class="text-light text-center font-size-h2 font-w700">0</p>
                        <p class="text-light text-center font-size-h2 font-w700">Leaves</p>
                        <!-- <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all Leaves
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <!-- <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            Leaves Summary
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a> -->
                        <dt class="font-size-h3 font-w600 text-dark text-center">Total Presents</dt>
                    </div>
                    <div class="block-content block-content-full flex-grow-1 flex-column d-flex justify-content-center align-items-center bg-success">
                        <p class="text-light text-center font-size-h2 font-w700">0</p>
                        <p class="text-light text-center font-size-h2 font-w700">Presents</p>
                        <!-- <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all Presents
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm bg-warning">
                        <!-- <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all Presents
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a> -->
                        <dt class="font-size-h3 font-w600 text-dark text-center">Current Time</dt>
                    </div>
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center bg-primary">
                        <p class="text-light text-center" id="current-timer"></p>
                        <!-- <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all times
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>



        </div>
        <!-- /Row-02 -->

        <!-- Row-03-->

        <!-- /Row-03-->

        <!-- Row-05 -->
        <div class="row">
            <div class="col-lg-6">
                <div class="block block-rounded block-mode-loading-oneui">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Leaves</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
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
                            <canvas class="js-chartjs-dashboard-earnings chartjs-render-monitor" style="display: block; height: 344px;" height="344"></canvas>
                        </div>
                    </div>
                    <!-- <div class="block-content">
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
                </div> -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="block block-rounded block-mode-loading-oneui">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Presents</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
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
                            <canvas class="js-chartjs-dashboard-sales chartjs-render-monitor" style="display: block;" height="344"></canvas>
                        </div>
                    </div>
                    <!-- <div class="block-content">
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
                </div> -->
                </div>
            </div>
        </div>
        <!-- /Row-05 -->

        <!-- Row 06 -->
        <!-- Statistics -->
        <!-- <div class="row">
        <div class="col-xl-8 d-flex flex-column">
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
        </div>
        <div class="col-xl-4 d-flex flex-column">
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
                            <span class="js-sparkline" data-type="line" data-points="[33,29,32,37,38,30,34,28,43,45,26,45,49,39]" data-width="100%" data-height="70px" data-chart-range-min="20" data-line-color="rgba(210, 108, 122, .4)" data-fill-color="rgba(210, 108, 122, .15)" data-spot-color="transparent" data-min-spot-color="transparent" data-max-spot-color="transparent" data-highlight-spot-color="#D26C7A" data-highlight-line-color="#D26C7A" data-tooltip-suffix="Orders"></span>
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
                            <span class="js-sparkline" data-type="line" data-points="[716,1185,750,1365,956,890,1200,968,1158,1025,920,1190,720,1352]" data-width="100%" data-height="70px" data-chart-range-min="300" data-line-color="rgba(70,195,123, .4)" data-fill-color="rgba(70,195,123, .15)" data-spot-color="transparent" data-min-spot-color="transparent" data-max-spot-color="transparent" data-highlight-spot-color="#46C37B" data-highlight-line-color="#46C37B" data-tooltip-prefix="$"></span>
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
                            <span class="js-sparkline" data-type="line" data-points="[25,15,36,14,29,19,36,41,28,26,29,33,23,41]" data-width="100%" data-height="70px" data-chart-range-min="0" data-line-color="rgba(70,195,123, .4)" data-fill-color="rgba(70,195,123, .15)" data-spot-color="transparent" data-min-spot-color="transparent" data-max-spot-color="transparent" data-highlight-spot-color="#46C37B" data-highlight-line-color="#46C37B" data-tooltip-prefix="$"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <!-- END Statistics -->
        <!-- /Row 06 -->

        <!-- Row-07 -->
        <!-- <div class="row">
        <div class="col-xl-6">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Top Products</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
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
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
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
    </div> -->
        <!-- /Row-07 -->

        <!-- Row-08 -->
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Leaves Summary Overview</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
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
                            <canvas class="js-chartjs-overview chartjs-render-monitor" style="display: block; width: 1009px; height: 400px;" width="1009" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row-08 -->
    </div>
    <!-- /Page Content -->
</x-backend-layout>