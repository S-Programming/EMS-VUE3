<x-backend-layout>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <div class="col-md-6">
                <h3 class="block-title bold">User Attendance</h3>
            </div>
            <div class="block-options col-md-6" style="float: right;">
                <form method="POST" action="{{ route('attendance.history.user') }}" id="attendence-filter-form-id">
                            @csrf
                    <div class="row">
                        <div class="col-4">
                            <select class="dropdown form-control " name="user_days">
                                <option value="Current Month">Current Month</option>
                                <option value="Previous Month">Previous Month</option>
                            </select>
                        </div>
                        <div class="col-4">
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
                      <div class="col-4">
                            <x-button class="checkout-btn btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation=" validation-span-id"
                                  id="validation-span-id" >
                            <i class="fa fa-fw fa-search mr-1"></i>{{ __('Search') }}
                            </x-button>
                        </div>

                    </div>
                </form>
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
	    <div id="attendance-section" class="block block-rounded">

            {!!$user_attendance_history_html??''!!}
	   </div>
	    <!-- END Dynamic Table Full Pagination -->

	</div>
</x-backend-layout>
