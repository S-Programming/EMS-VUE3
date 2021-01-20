<x-backend-layout>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title bold">Checkin History</h3>
            <div class="block-options">
                <form method="POST" action="{{ route('checkin.history.user') }}" id="filter-form-id">
                            @csrf
                <div class="row">

                    <div class="col-sm-4">

                        <select class="dropdown form-control "  name="user_days">
                            <option>All</option>
                            <option>Previous Week</option>
                            <option>Current Week</option>
                            <option>Previous Month</option>
                            <option>Current Month</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control" name="user_id">
                            @if(isset($users) && !empty($users))
                                <option value="All">All</option>
                                @foreach($users as $user)
                                    <option
                                        value="{{$user->id}}">{{$user->first_name}}{{" "}}{{$user->last_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <x-button class="checkout-btn btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation=" validation-span-id"
                              id="validation-span-id" >
                        <i class="fa fa-fw fa-search-in-alt mr-1"></i>{{ __('Search') }}
                        </x-button>
                    </div>
                
                </div>
                </form>
                <!-- <div class="row">
                    <div class="col-sm-6">
                        <select class="dropdown form-control " onchange="ajaxCallOnclick('get_user_checkin',{user_id:'{{$users[0]->id??0}}',history_report:this.options[this.selectedIndex].text??'All Checkin History'})" name="user_days">
                            <option>All</option>
                            <option>Previous Week</option>
                            <option>Current Week</option>
                            <option>Previous Month</option>
                            <option>Current Month</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control"
                                onchange="ajaxCallOnclick('get_user_checkin',{user_id:this.options[this.selectedIndex].value??'All'})"
                                name="user_id">
                            @if(isset($users) && !empty($users))
                                <option value="All">All</option>
                                @foreach($users as $user)
                                    <option
                                        value="{{$user->id}}">{{$user->first_name}}{{" "}}{{$user->last_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- <div id="one-dashboard-search-orders" class="block-content border-bottom d-none" >
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search"
                               name="one-ecom-orders-search" placeholder="Search krecent orders..">
                        <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </span>
                        </div>
                    </div>
                </div>
            </form>

        </div> -->
        <div id="checkin-history" class="block-content">
            {!! $user_history_html??'' !!}
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
</x-backend-layout>
