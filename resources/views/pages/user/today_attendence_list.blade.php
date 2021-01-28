<x-backend-layout>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title bold">Today Attendance</h3>
            <div class="block-options">
                {{-- onchange="ajaxCallOnclick('get_user_attendance',{attendance_month:this.options[this.selectedIndex].text??'Current Month'})" --}}
                {{-- <select class="form-control" name="user_days">
                    <option>Current Month</option>
                    <option>Previous Month</option>
                </select> --}}
                <form method="POST" action="{{ route('get.user.attendance') }}" id="filter-form-id">
                            @csrf
                <div class="row">

                    <div class="col-sm-4">

                        <select class="dropdown form-control " name="user_days">
                            <option>Current Month</option>
                            <option>Previous Month</option>
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
                 {{-- <div class="row">
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
                    </div>--}}
                </div>
            </div>
        </div>
	<!-- Hero -->
	{{-- <div class="bg-body-light">
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
	</div> --}}
	<!-- END Hero -->

	<!-- Page Content -->
	<div class="content">
	    <!-- Dynamic Table Full Pagination -->
	    <div id="monthly-attendance-section" class="block block-rounded">

	    @include('pages.user._partial._user_attendance_html',['todayAttendance' => $todayAttendance])
		</div>
	    <!-- END Dynamic Table Full Pagination -->

	</div>
</x-backend-layout>
