<x-backend-layout>
    <!-- Page Content -->
    <x-auth-card>
        <div class="hero-static">
            <div class="content">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-10 col-xl-10">
                        <!-- Sign In Block -->
                        <div class="block block-rounded block-themed mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title text-center">Policies</h3>

                            </div>
                            <div class="block-content">

                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="sop-leave-request">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#sop-leave-request-content"
                                                        aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                    SOP - Leave Request
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="sop-leave-request-content" class="collapse show"
                                             aria-labelledby="sop-leave-request"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <ul>
                                                    <li>An employee needs to create a leave request
                                                        through KSPS’ request section at least one
                                                        hour prior to the office start time in order
                                                        for the respective day to be considered as
                                                        informed leave.
                                                    </li>
                                                    <li>It is recommended that the leave request is
                                                        generated at least one day before and an
                                                        employee should wait for the approval of
                                                        their leave request unless there is an
                                                        emergency case.
                                                    </li>
                                                    <li>In case of planned leaves exceeding 1 day,
                                                        employees must wait for the approval of
                                                        their Project Manager who will reach a
                                                        consensus after having a discussion with
                                                        higher management.
                                                    </li>
                                                    <li>8 casual and 8 sick leaves allowed in the
                                                        year.
                                                    </li>
                                                    <li>Uninformed leave(s) will effect performance
                                                        and result as deduction of salary.
                                                    </li>
                                                    <li>Approval will be required for Half day and
                                                        it should be informed at-least one day
                                                        prior.
                                                    </li>
                                                    <li>Minimum 7 productive hours required to be
                                                        consider a working day.
                                                    </li>
                                                    <li>Minimum 4 productive hours required for a
                                                        Half day otherwise it will be consider as
                                                        leave for the day.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="sop-late-arrivals">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#sop-late-arrivals-content"
                                                        aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                    SOP - Late Arrivals
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="sop-late-arrivals-content" class="collapse show"
                                             aria-labelledby="sop-late-arrivals"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <p>Strict measures will be taken against late
                                                    arrivals. You are advised to read and follow the
                                                    below mentioned points carefully:</p>
                                                <ul>
                                                    <li>Please make sure that you reach the office
                                                        on time.
                                                    </li>
                                                    <li>Relaxation in terms of penalty will only be
                                                        provided in case of two late arrivals, after
                                                        that, you will be liable for the penalties.
                                                    </li>
                                                    <li>Requests for late day removal will also not
                                                        be entertained at all, even for a genuine
                                                        reason.
                                                    </li>
                                                    <li>Exceptions will be made for scenarios, where
                                                        you have special orders from the company
                                                        itself.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="card">--}}
                                    {{-- <div class="card-header" id="sop-office-assets">--}}
                                    {{-- <h5 class="mb-0">--}}
                                    {{-- <button class="btn btn-link" data-toggle="collapse"--}}
                                    {{-- data-target="#sop-office-assets-content"--}}
                                    {{-- aria-expanded="true"--}}
                                    {{-- aria-controls="collapseOne">--}}
                                    {{-- SOP - Office Assets--}}
                                    {{-- </button>--}}
                                    {{-- </h5>--}}
                                    {{-- </div>--}}
                                    {{-- <div id="sop-office-assets-content" class="collapse"--}}
                                    {{-- aria-labelledby="sop-office-assets"--}}
                                    {{-- data-parent="#accordion">--}}
                                    {{-- <div class="card-body">--}}
                                    {{-- <p>Please follow the below mentioned SOP related to--}}
                                    {{-- company assets:</p>--}}
                                    {{-- <ul>--}}
                                    {{-- <li>If any employee needs to take the laptop or--}}
                                    {{-- any other company's asset to home for--}}
                                    {{-- official use, then they must generate a--}}
                                    {{-- request for the issuance of company assets--}}
                                    {{-- via the request section in KSPS.--}}
                                    {{-- </li>--}}
                                    {{-- <li>Please remember that all employees are--}}
                                    {{-- expected to protect the company's assets and--}}
                                    {{-- ensure their efficient use.--}}
                                    {{-- </li>--}}
                                    {{-- <li>If any asset gets lost/damaged by an--}}
                                    {{-- employee then they will be responsible to--}}
                                    {{-- repair it or pay for the damages.--}}
                                    {{-- </li>--}}
                                    {{-- </ul>--}}
                                    {{-- </div>--}}
                                    {{-- </div>--}}
                                    {{-- </div>                                 --}}
                                    <div class="card mb-4">
                                        <div class="card-header" id="sop-overtime-meal">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#sop-overtime-meal-content"
                                                        aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                    SOP - Overtime Meal
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="sop-overtime-meal-content" class="collapse show"
                                             aria-labelledby="sop-overtime-meal"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <ul>
                                                    <li>Employees can avail reimbursement on a meal
                                                        if they work for 11 hours or more.
                                                    </li>
                                                    <li>In order to avail reimbursement on an
                                                        overtime meal, the employee has to provide
                                                        an original billing receipt to the admin
                                                        manager within two business days from the
                                                        availed date.
                                                    </li>
                                                    <li>The maximum amount for reimbursement per
                                                        meal per person is Rs. 300.
                                                    </li>
                                                    <li>Reimbursement will be done by the end of the
                                                        month and the amount will be added to
                                                        employee’s upcoming salary.
                                                    </li>
                                                    <li> No money shall be given in lieu of meal.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Sign In Block -->
                    </div>
                </div>
            </div>
            <!-- <div class="content content-full font-size-sm text-muted text-center">
                <strong>KodeStudio.net</strong> &copy; <span data-toggle="year-copy"></span>
            </div> -->
        </div>
    </x-auth-card>
    <!-- END Page Content -->
</x-backend-layout>
