<x-backend-layout>
    <!-- Hero -->


    <!-- New Dashboard huh -->
    <!-- Page Content -->
    <div class="content">
        <!-- Row-01 -->
        <div class="row row-deck">

            <div class="col-6 col-sm-12 col-md-12 col-xl-8">
                <div class="block block-rounded d-flex flex-column">
                    <div class="card-body">
                        <form method="POST" action="{{ route('confirm.checkout') }}" id="checkout-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <p class="font-size-h3">What I Have Done Today?</p>
                                    <p class="font-size-h6">Modify and add new tasks to your daily report</p>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary float-right" onclick="commonAjaxModel('add/report/modal')">Add Report</button>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <textarea class="form-control form-control-lg" name="done_today" disabled required autofocus></textarea>
                            </div> -->

                            <div class="block-content" id="user-task-logs">
                                {!! $user_report_html??'' !!}
                            </div>
                            <div class="py-3">
                                <p class="font-size-h3">What I'll do tomorrow?</p>
                                <div class="form-group">
                                    <textarea class="form-control form-control-lg" name="do_tomorrow" required autofocus></textarea>
                                </div>
                            </div>
                            <div class="py-3">
                                <p class="font-size-h3">Any Questions / Roadblocks?</p>
                                <div class="form-group">
                                    <textarea class="form-control form-control-lg" name="questions" required autofocus></textarea>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <x-button class="checkout-btn btn-lg btn-block btn btn-primary" onclick="validateFieldsByFormId(this)" data-validation="validation-span-id" id="validation-span-id">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Submit Report') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row-01 -->
    </div>
    <!-- /Page Content -->
</x-backend-layout>