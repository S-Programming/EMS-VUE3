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
                        <form method="POST" action="{{ route('report.submit') }}"
                              id="checkout-form-id" data-modal-id="{{$id??'common_popup_modal'}}">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <p class="font-size-h3">What I Have Done Today?</p>
                                    <p class="font-size-h6">Modify and add new tasks to your daily
                                        report</p>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary float-right"
                                            onclick="commonAjaxModel('report/create/modal')">Add
                                        Report
                                    </button>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <textarea class="form-control form-control-lg" name="done_today" disabled required autofocus></textarea>
                            </div> -->

                            <div class="content">
                                <!-- Dynamic Table Full Pagination -->
                                <div id="task-log-table-section" class="block block-rounded">
                                    @include('pages.report._partial._task_log_table_html',['userTaskLogs' => $userTaskLogs ?? ''])
                                </div>
                                <!-- END Dynamic Table Full Pagination -->

                            </div>

                        <!-- <div class="block-content" id="user-task-logs">
                                {!! $user_report_html??'' !!}
                            </div> -->
                            <div class="py-3">
                                <p class="font-size-h3">What I'll do tomorrow?</p>
                                <div class="form-group">
                                    <textarea class="form-control form-control-lg"
                                              name="do_tomorrow"></textarea>
                                </div>
                            </div>
                            <div class="py-3">
                                <p class="font-size-h3">Any Questions / Roadblocks?</p>
                                <div class="form-group">
                                    <textarea class="form-control form-control-lg"
                                              name="questions"></textarea>
                                </div>
                            </div>
                            @if(isset($is_submit_report)&&$is_submit_report==1)
                                <div
                                    class="block-content block-content-full text-center border-top">
                                    <div class="checkout-btn btn-lg btn-block btn btn-primary disabled" >
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Report Submitted') }}
                                    </div>
                                </div>
                            @else
                                <div
                                    class="block-content block-content-full text-center border-top">
                                    <x-button class="checkout-btn btn-lg btn-block btn btn-primary"
                                              id="submit-report-span-id"
                                              onclick="event.preventDefault();validateFieldsByFormId(this)"
                                              data-validation="submit-report-span-id">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{ __('Submit Report') }}
                                    </x-button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row-01 -->
    </div>
    <!-- /Page Content -->
</x-backend-layout>
