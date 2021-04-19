<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\CheckinHistory;
use App\Models\RoleUser;
use App\Models\TechnologyStack;
use App\Models\Project;
use App\Models\DevelopersProject;
use App\Models\UserTaskLog;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;

class CheckinHistoryService extends BaseService
{

    public function confirmCheckin(Request $request)
    {
        $isMarkCheckIn = true;
        ## DB operations
        $user_id = $this->getAuthUserId();
        if ($user_id > 0) {
            $checkin_history_data = CheckinHistory::where('user_id', $user_id)->latest()->first();

            if (!is_null($checkin_history_data)) {
                $today = Carbon::parse($checkin_history_data->checkin);
                /*## Need to improve logic, If user already checkin then will not be able to checkin again*/
                if ($today->isToday() && !$checkin_history_data->checkout) {
                    return $this->errorResponse('You are already Checked-in');
                } elseif (!$checkin_history_data->checkout) {
                    return $this->errorResponse('forgot to logout', ['errors' => ['You forgot to checkout last day, please logout first']]);
                }
            }
            if ($isMarkCheckIn) {

                $add_user_checkin = new CheckinHistory;
                $add_user_checkin->checkin = Carbon::now();
                $add_user_checkin->user_id = $user_id;
                $add_user_checkin->save();

                $attendence = new Attendance;
                $attendence->user_id = $user_id;
                $attendence->is_present = 1;
                $attendence->save();
            }
            $user_history = CheckinHistory::where('user_id', $user_id)->get();
            $html = view('pages.user._partial._checkout_html')->render();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history])->render();
            return $this->successResponse('You are successfully checked-in', ['html' => $html, 'html_section_id' => 'checkin-section', 'checkin_history_html' => $checkin_history_html, 'html_history_section_id' => 'checkin-history-section', 'module' => 'checkin']);
        }
    }

    public function confirmCheckout(Request $request)
    {
        $user_id = $this->getAuthUserId();
        if ($user_id > 0) {
            //  dd($html);
            $checkin_history_data = CheckinHistory::where('user_id', $user_id)->latest()->first();
            if ($checkin_history_data != null) {
                if (!$checkin_history_data->checkout) {
                    $checkin_history_data->checkout = Carbon::now();
                    $checkin_history_data->done_today = $request->done_today ?? '';
                    $checkin_history_data->do_tomorrow = $request->do_tomorrow ?? '';
                    $checkin_history_data->questions = $request->questions ?? '';
                    $checkin_history_data->save();
                    $user_history = CheckinHistory::where('user_id', $user_id)->get()->last();
                    $start_time = Carbon::parse($user_history->checkin);
                    $end_time = Carbon::parse($user_history->checkout);
                    $total_work_time = $start_time->diff($end_time)->format('%H:%I:%S');
                    Session::put('total_work_time', $total_work_time);
                    // dd($total_work_time);
                    //$checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history])->render();
                    // dd($checkin_history_html);
                    //    dd($checkin_history_html,"data");
                    $html = view('pages.user._partial._checkin_html')->render();
                    return $this->successResponse('You are successfully checked-out', ['html' => $html, 'html_section_id' => 'checkin-section', 'html_history_section_id' => 'checkin-history-section']);

                    //return $this->successResponse('CheckOut Successfully!', ['html' => $html, 'html_section_id' => 'checkin-section', 'checkin_history_html' => $checkin_history_html, 'html_history_section_id' => 'checkin-history-section']);
                }
            }
            return $this->errorResponse('Something went wrong, please contact support team, thanks', ['errors' => ['Something went wrong, please contact support team, thanks'], 'html' => $html]);
        }
    }

    public function getUserCheckinRecord(Request $request)
    {
        $user_id = $request->user_id;
        $date_filters = historyDateFilter($request->user_days);
        if ($user_id == 'All' && $date_filters == []) {
            $checkin_history_data = CheckinHistory::all();
            return $this->filter_detail($checkin_history_data);
        }

        if ($user_id == 'All' && !$date_filters == []) {
            $checkin_history_data = CheckinHistory::where($date_filters)->get();
            return $this->filter_detail($checkin_history_data);
        }

        if ($user_id > 0 && $date_filters == []) {
            $filters = ($user_id > 0) ? [['user_id', '=', $user_id]] : [];
            $checkin_history_data = CheckinHistory::where($filters)->get();
            return $this->filter_detail($checkin_history_data);
        }

        $filters = ($user_id > 0) ? [['user_id', '=', $user_id]] : [];
        $filters = array_merge($date_filters, $filters);
        $checkin_history_data = CheckinHistory::where($filters)->get();
        return $this->filter_detail($checkin_history_data);


        /*if ($request->user_days == 'All' && $request->user_id == 'All') {
            $user_history = CheckinHistory::all();
            $count = $user_history->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history, 'totalCheckins' => $count])->render();

        }

        if ($request->user_days == 'Current Month') {
            if ($user_id != 'All') {
                $currentmonthlyCheckins = CheckinHistory::where('checkin', '>=', Carbon::now()->startOfMonth()->toDateTimeString())->where('user_id', $user_id)->get();
            } else {
                $currentmonthlyCheckins = CheckinHistory::where('checkin', '>=', Carbon::now()->startOfMonth()->toDateTimeString())->get();
            }

            //  dd($user_id);
            $count = $currentmonthlyCheckins->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $currentmonthlyCheckins, 'totalCheckins' => $count])->render();
            // dd($currentmonthlyCheckins);

        } elseif ($request->user_days == 'Previous Month') {
            //Previous Month Checkins
            if ($user_id != 'All') {
                $previousMonthCheckins = CheckinHistory::whereMonth('checkin', '=', Carbon::now()->subMonth()->month)->where('user_id', $user_id)->get();
            } else {
                $previousMonthCheckins = CheckinHistory::whereMonth('checkin', '=', Carbon::now()->subMonth()->month)->get();
            }
            $count = $previousMonthCheckins->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $previousMonthCheckins, 'totalCheckins' => $count])->render();

        } elseif ($request->user_days == 'Current Week') {
            // current week
            $NowDate = Carbon::now()->format('Y-m-d');
            $currentStartWeekDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1); // gives 2016-01-3
            if ($user_id != 'All') {
                $currentWeekCheckins = CheckinHistory::whereBetween('checkin', array($currentStartWeekDate, $NowDate))->where('user_id', $user_id)->get();
            } else {
                $currentWeekCheckins = CheckinHistory::whereBetween('checkin', array($currentStartWeekDate, $NowDate))->get();
            }
            $count = $currentWeekCheckins->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $currentWeekCheckins, 'totalCheckins' => $count])->render();

        } elseif ($request->user_days == 'Previous Week') {
            // Past Week Checkins (Today is not included)
            $previousWeekStartDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->subWeek()->format('Y-m-d'); // gives 2016-01-31
            $previousWeekEndDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->format('Y-m-d');
            if ($user_id != 'All') {
                $pastWeekCheckins = CheckinHistory::whereBetween('checkin', array($previousWeekStartDate, $previousWeekEndDate))->where('user_id', $user_id)->get();
            } else {
                $pastWeekCheckins = CheckinHistory::whereBetween('checkin', array($previousWeekStartDate, $previousWeekEndDate))->get();
            }

            $count = $pastWeekCheckins->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $pastWeekCheckins, 'totalCheckins' => $count])->render();

        } else {
            $all_checkin_history = CheckinHistory::where('user_id', $user_id)->get();
            $count = $all_checkin_history->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $all_checkin_history, 'totalCheckins' => $count])->render();

            if ($count > 0) {
                return $this->successResponse('All Checkin_History Received successfully', ['html' => $checkin_history_html, 'html_section_id' => 'checkin-history']);
            } else {
                return $this->errorResponse('Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'checkin-history']);
            }
        }*/
    }

    /**
     * Method used for showing users checkins between two dates
     *
     *
     */

    public function filter_detail($checkin_history_data)
    {
        $count = $checkin_history_data->count();
        $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $checkin_history_data])->render();
        if ($count > 0) {
            return $this->successResponse('Record Found successfully', ['html' => $checkin_history_html, 'html_section_id' => 'checkin-history']);
        } else {
            return $this->errorResponse('Record Not Found', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'checkin-history']);
        }
    }

    public function checkinHistoryBtDates(Request $request)
    {

        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        // dd($start_date, '-', $end_date);
        ## End Date User Record Included
        $checkin_history_data = CheckinHistory::whereDate('checkin', '>=', $start_date)->whereDate('checkin', '<=', $end_date)->where('user_id', $this->getAuthUserId())->get();
        $count = $checkin_history_data->count();
        $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $checkin_history_data])->render();
        if ($count > 0) {
            return $this->successResponse('Record Found successfully', ['html' => $checkin_history_html, 'html_section_id' => 'checkin-history']);
        } else {
            return $this->errorResponse('Record Not Found', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'checkin-history']);
        }
    }

    /**
     * Method used for showing delete popup modal
     *
     * return delete pop up modal
     */
    public function deleteCheckinUserModal(Request $request)
    {
        $checkin_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin._partial._delete_user_checkin_modal', ['id' => $containerId, 'checkin_id' => $checkin_id])->render();

        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * method use for confirm deletion of user checkin history
     *
     * return body
     */

    public function deleteConfirmCheckinUser(Request $request)
    {
        $checkin_id = $request->checkin_id;
        $user_data = CheckinHistory::find($checkin_id);
        $user_data->delete();

        $user_history = CheckinHistory::all();
        $html = view('pages.user._partial._checkin_history_html', ['users' => $this->getAllUsers(), 'user_history' => $user_history])->render();
        // dd($html);
        return $this->successResponse('User is Successfully Deleted', ['html' => $html, 'html_section_id' => 'checkin-history']);
    }

    /**
     * Method used for showing editing the users checkin report on pop up modal
     *
     * return editing form on pop up modal
     */
    public function editCheckinUserModal(Request $request)
    {
        $user_id = $request->id;
        $user_checkin_data = CheckinHistory::find($user_id);
        // dd($user_checkin_data);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin._partial._edit_user_checkin_modal', ['id' => $containerId, 'data' => null, 'user_checkin_data' => $user_checkin_data])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * Method used for confirm update the user checkin report
     *
     * return body
     */
    public function updateCheckinUser(Request $request)
    {
        $record_id = $request->input('id');
        $user_record_to_update = CheckinHistory::where(['id' => $record_id])->first();
        $user_record_to_update->checkin = $request->input('checkin-time');
        $user_record_to_update->checkout = $request->input('checkout-time');
        $user_record_to_update->description = $request->input('description');
        $user_record_to_update->save();

        $user_history = CheckinHistory::all();
        $html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history])->render();

        return $this->successResponse('Checkin History Record Successfully Updated', ['html' => $html, 'html_section_id' => 'checkin-history']);
    }

    //Today Report
    public function addReportModal(Request $request)
    {
        $container_id = $request->input('containerId', 'common_popup_modal');
        $userId = $this->getAuthUserId();
        $projects_data = DevelopersProject::with('Project')->where('user_id', $userId)->get();
        $project_dropdown = view('utils.projects', ['projects_data' => $projects_data])->render();
        $userLastCheckinDetails = $this->userLastCheckinDetails();
        $last_checkin_id = $userLastCheckinDetails->id ?? 0;
        $last_checkin_time = $userLastCheckinDetails->checkin ?? 0;
        if (isset($last_checkin_time) && !empty($last_checkin_time)) {
            $carbon_checkin_time = Carbon::createFromDate($last_checkin_time);
            $difference_in_minutes = $carbon_checkin_time->diffInMinutes(Carbon::now());
            $sumTime = UserTaskLog::where('user_id', $userId)->whereDate('created_at', Carbon::today())->sum('time');
            $difference_in_minutes = $difference_in_minutes - intval($sumTime);
            ## We have to subtract the logged minutes here
            $minutes = $difference_in_minutes > 0 ? ($difference_in_minutes % 60) : 0;
            $hours = $difference_in_minutes > 60 ? intval((($difference_in_minutes - $minutes) / 60)) : 0;
            $last_checkin_time = $carbon_checkin_time->format('Y-m-d h:i:s A');
        }
        $modal_data = [
            'id' => $container_id,
            'last_checkin_id' => $last_checkin_id,
            'project_dropdown' => $project_dropdown,
            'last_checkin_time' => $last_checkin_time ?? '',
            'hours' => $hours ?? '',
            'minutes' => $minutes ?? '',
        ];
        $html = view('pages.user._partial._add_report_modal', $modal_data)->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    //Add Report
    public function addReport(Request $request)
    {
        $userId = $this->getAuthUserId();
        $userTaskLogs = new UserTaskLog;
        $hours = $request->hours;
        $minutes = $request->minutes;
        $userLastCheckinDetails = $this->userLastCheckinDetails();
        $last_checkin_id = $userLastCheckinDetails->id ?? 0;
        $last_checkin_time = $userLastCheckinDetails->checkin ?? 0;
        $carbon_checkin_time = Carbon::createFromDate($last_checkin_time);
        $difference_in_minutes = $carbon_checkin_time->diffInMinutes(Carbon::now());
        if ($hours > 0 && $minutes > 0) {
            $minutes = $minutes + ($hours * 60);
        }
        $sumTime = UserTaskLog::where('user_id', $userId)->whereDate('created_at', Carbon::today())->sum('time');
        $logAbleTime = $difference_in_minutes - intval($sumTime);
        if ($minutes > intval($logAbleTime)) {
            return $this->errorResponse('Your logged time exceed to actual spent time');
        }
        //        dd($minutes,$logAbleTime);
        $userTaskLogs->user_id = $this->getAuthUserId();
        $userTaskLogs->checkin_id = $request->checkin_id;
        $userTaskLogs->project_id = $request->project_id;
        $userTaskLogs->description = $request->task_details;
        $userTaskLogs->time = $minutes;
        $userTaskLogs->save();
        $user_task_logs = UserTaskLog::where('user_id', $userId)->whereDate('created_at', Carbon::today())->get();

        $html = view('pages.user._partial._user_task_log_list_table_html', compact('user_task_logs', $user_task_logs))->render();
        return $this->successResponse('Report has Successfully Added', ['html' => $html, 'html_section_id' => 'user-task-log-section']);


        //return $this->successResponse('You are successfully add report',['userTaskLogs' => $userTaskLogs]);
    }

    //Edit User Task Log
    public function editUserTaskLogModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $userTaskLogId = $request->id;
        $projects_data = DevelopersProject::with('Project')->where('user_id', $this->getAuthUserId())->get();
        $userLastCheckinDetails = $this->userLastCheckinDetails();
        $last_checkin_id = $userLastCheckinDetails->id ?? 0;
        $last_checkin_time = $userLastCheckinDetails->checkin ?? 0;
        $project_dropdown = view('utils.projects', ['projects_data' => $projects_data])->render();
        $userTaskLogData = UserTaskLog::find($userTaskLogId);
        $time = $userTaskLogData->time;
        $minutes = $time > 0 ? ($time % 60) : 0;
        $hours = $time > 60 ? intval((($time - $minutes) / 60)) : 0;
        $modal_data = [
            'id' => $containerId,
            'user_task_log_id' => $userTaskLogId,
            'project_dropdown' => $project_dropdown,
            'last_checkin_time' => $last_checkin_time ?? '',
            'hours' => $hours ?? '',
            'minutes' => $minutes ?? '',
            'description' => $userTaskLogData->description
        ];
        $html = view('pages.user._partial._edit_report_modal',  $modal_data)->render();
        // $html = view('pages.user._partial._edit_report_modal')->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    //Edit User Task Log
    public function editUserTaskLog(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Leave Type Submittion Failed');
        }
        $hours = $request->hours;
        $minutes = $request->minutes;
        $userLastCheckinDetails = $this->userLastCheckinDetails();
        $last_checkin_id = $userLastCheckinDetails->id ?? 0;
        $last_checkin_time = $userLastCheckinDetails->checkin ?? 0;
        $carbon_checkin_time = Carbon::createFromDate($last_checkin_time);
        $difference_in_minutes = $carbon_checkin_time->diffInMinutes(Carbon::now());
        if ($hours > 0 && $minutes > 0) {
            $minutes = $minutes + ($hours * 60);
        }
        $sumTime = UserTaskLog::where('user_id', $this->getAuthUserId())->whereDate('created_at', Carbon::today())->sum('time');
        $logAbleTime = $difference_in_minutes - intval($sumTime);
        if ($minutes > intval($logAbleTime)) {
            return $this->errorResponse('Your logged time exceed to actual spent time');
        }
        if (isset($request) && !empty($request)) {
            $userTaskLogId = $request->user_task_log_id;
            $user_task_logs = UserTaskLog::find($userTaskLogId);
            $user_task_logs->description = $request->task_details;
            $user_task_logs->time = $request->minutes;
            $user_task_logs->save();
        }

        $user_task_logs = UserTaskLog::where('user_id', $this->getAuthUserId())->whereDate('created_at', Carbon::today())->get();

        $html = view('pages.user._partial._user_task_log_list_table_html', compact('user_task_logs', $user_task_logs))->render();
        return $this->successResponse('Report has Successfully Updated', ['html' => $html, 'html_section_id' => 'user-task-log-section']);
        // $html = view('pages.user._partial._checkin_task_log_html', ['user_task_logs' => $user_task_logs])->render();
        // return $this->successResponse('User Task Log has Successfully Updated', ['user_report_html' => $html]);
    }

    //Delete User Task Log Modal
    public function deleteUserTaskLogModal(Request $request)
    {
        $user_task_log_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.user._partial._delete_user_task_log_modal', ['id' => $containerId, 'user_task_log_id' => $user_task_log_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    //Delete User Task Log
    public function deleteUserTaskLog(Request $request)
    {
        $user_task_log_id = $request->user_task_log_id;
        $user_task_logs = UserTaskLog::find($user_task_log_id);
        $user_task_logs->delete();
        $user_task_logs = UserTaskLog::where('user_id', $this->getAuthUserId())->whereDate('created_at', Carbon::today())->get();

        $html = view('pages.user._partial._user_task_log_list_table_html', compact('user_task_logs', $user_task_logs))->render();
        return $this->successResponse('Report has Successfully Deleted', ['html' => $html, 'html_section_id' => 'user-task-log-section']);
        // $user_task_logs = UserTaskLog::all();
        // $html = view('pages.user._partial._checkin_task_log_html', ['user_task_logs' => $user_task_logs])->render();
        // return $this->successResponse('User Task Log has Successfully Deleted', ['user_report_html' => $html]);
    }
}
