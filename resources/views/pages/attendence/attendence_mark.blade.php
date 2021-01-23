<x-backend-layout>
	<!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Attendence Mark <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Kindly mark your attendence to insure of your presence</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Attendence</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Attendence Mark</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">
                    Todays Attendence
                </h3>
            </div>
            <div class="block-content">
                <form method="POST" action="{{ route('attendence.add') }}" id="attendence-mark-form-id"
                      data-modal-id="{{$id??'common_popup_modal'}}">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            	<div class="col-4">
                            		<div class="form-group">
                            			<label for="entry_time">&nbsp Entry Time</label>
                                    	<x-input id="entry_time" class="form-control form-control-alt form-control-lg" type="text" name="entry_time" placeholder="--:--:--" disabled/>
	                                 </div>
                            	</div>
                            	<div class="col-4">
                            		<div class="form-group">
                            			<label for="entry_location">&nbsp Entry Location</label>
                                    	<x-input id="entry_location" class="form-control form-control-alt form-control-lg" type="text" name="entry_location" placeholder="Location Loading..." disabled/>
	                            		<x-input id="entry_loc" class="form-control form-control-alt form-control-lg" type="hidden" name="entry_loc"/>
	                                 </div>
                            	</div>
                            	<div class="col-4">
                            		<div class="form-group">
                            			<label for="entry_ip">&nbsp Entry IP</label>
                                    	<x-input id="entry_ip" class="form-control form-control-alt form-control-lg" placeholder="X.X.X.X" type="text" name="entry_ip" disabled/>
	                                 </div>
                            	</div>
                            </div>
                            <div class="row">
                            	<div class="col-4">
                            		<div class="form-group">
                            			<label for="exit_time">&nbsp Exit Entry</label>
                                    	<x-input id="exit_time" class="form-control form-control-alt form-control-lg" type="text" name="exit_time" placeholder="--:--:--" disabled/>
	                                 </div>
                            	</div>
                            	<div class="col-4">
                            		<div class="form-group">
                            			<label for="exit_location">&nbsp Exit Location</label>
                                    	<x-input id="exit_location" class="form-control form-control-alt form-control-lg" type="text" name="exit_location" placeholder="...." disabled/>
	                            		<x-input id="exit_loc" class="form-control form-control-alt form-control-lg" type="hidden" name="exit_loc"/>
	                                 </div>
                            	</div>
                            	<div class="col-4">
                            		<div class="form-group">
                            			<label for="exit_ip">&nbsp Exit IP</label>
                                    	<x-input id="exit_ip" class="form-control form-control-alt form-control-lg" placeholder="X.X.X.X" type="text" name="exit_ip" disabled/>
	                                 </div>
                            	</div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Cancel
                        </button>
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)"
                                  data-validation="validation-span-id"
                                  id="validation-span-id">
                            <i class="fa fa-fw fa-check mr-1"></i>{{ __('Entry Mark') }}
                        </x-button>
                        @if($attendence_entry_mark)
                        <x-button class="btn btn-primary" onclick="validateFieldsByFormId(this)"
                                  data-validation="validation-span-id"
                                  id="validation-span-id">
                            <i class="fa fa-fw fa-check mr-1"></i>{{ __('Exit Mark') }}
                        </x-button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
</x-backend-layout>