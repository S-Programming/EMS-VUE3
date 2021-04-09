<x-backend-layout>
    <div class="content">
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
                                        <div class="error">{{ $message }}
                                </div>
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
                                        <div class="error">{{ $errors->first('end_date') }}
                            </div>
                            @endif --}}
                            @error('end_date')
                            <div class="error">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-2">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-dark btn-sm form-control" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id" id="validation-span-id">Search</button>
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
                            <select class="dropdown form-control " onchange="ajaxCallOnclick('user/report/history',{history_report:this.options[this.selectedIndex].text??'All Checkin History'})" name="user_id">
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
        <div class="block-content bg-body-light">
            <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                <!-- Search Form -->
                <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                    <div class="form-group push">
                        <div class="input-group">
                            <input type="text" class="form-control" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search recent orders..">
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
            <div class="block-content" id="checkin-history-section">
                {!!$checkin_history_html ??''!!}
            </div>
        </div>
    </div>
</x-backend-layout>