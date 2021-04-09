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
                        <dt class="font-size-h2 font-w600 text-dark text-center">Leaves Summary</dt>
                    </div>

                    <div id="jQuery" class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center bg-warning">
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
                    <div class="block-content block-content-full flex-grow-1 flex-column d-flex justify-content-center align-items-center bg-primary">
                        <p class="text-light text-center font-size-h2 font-w700">0</p>
                        <p class="text-light text-center font-size-h2 font-w700">Total Projects</p>
                        <!-- <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all Total Projects
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 flex-column d-flex justify-content-center align-items-center bg-success">
                        <p class="text-light text-center font-size-h2 font-w700">0</p>
                        <p class="text-light text-center font-size-h2 font-w700">Working Projects</p>
                        <!-- <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all Working Projects
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-xl-3">
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 flex-column d-flex justify-content-center align-items-center bg-warning">
                        <p class="text-light text-center font-size-h2 font-w700">0</p>
                        <p class="text-light text-center font-size-h2 font-w700">Pending Projects</p>
                        <!-- <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all Pending Projects
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Row 2 -->

        <!-- Row 3 -->
        <div class="row">
            <div class="col-xl-8 d-flex flex-column">
                <div class="block block-rounded flex-grow-1 d-flex flex-column">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Completed vs Working Projects Summary</h3>
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
                            <div class="col-sm-6">
                                <dl class="mb-0">
                                    <dt class="font-size-h3 font-w700">
                                        <i class="fa fa-arrow-up font-size-lg text-success"></i> 0%
                                    </dt>
                                    <dd class="text-muted mb-0">Completed Projects</dd>
                                </dl>
                            </div>
                            <div class="col-sm-6">
                                <dl class="mb-0">
                                    <dt class="font-size-h3 font-w700">
                                        <i class="fa fa-arrow-down font-size-lg text-danger"></i> 0%
                                    </dt>
                                    <dd class="text-muted mb-0">Working Projects</dd>
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
                                    <dd class="text-muted mb-0">Working Projects</dd>
                                </dl>
                                <div>
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-light">
                                        <i class="fa fa-caret-down mr-1"></i>
                                        0%
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
                                    <dd class="text-muted mb-0">Completed Projects</dd>
                                </dl>
                                <div>
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-light">
                                        <i class="fa fa-caret-up mr-1"></i>
                                        0%
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
                                    <dd class="text-muted mb-0">Total Projects</dd>
                                </dl>
                                <div>
                                    <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-success bg-success-light">
                                        <i class="fa fa-caret-up mr-1"></i>
                                        0%
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
        </div>
        <!-- End Row 3 -->
    </div>
    <!-- /Page Content -->
</x-backend-layout>