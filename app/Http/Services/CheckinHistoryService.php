<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\CheckinHistory;
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
            $html = view('pages.user._partial._checkout_html')->render();
            return $this->successResponse('You are successfully checked-in', ['html' => $html, 'html_section_id' => 'checkin-section', 'module' => 'checkin']);
        }
    }

    public function confirmCheckout(Request $request)
    {
        $user_id = $this->getAuthUserId();
        if ($user_id > 0) {
            $html = view('pages.user._partial._checkin_html')->render();
            $checkin_history_data = CheckinHistory::where('user_id', $user_id)->latest()->first();
            if ($checkin_history_data != null) {
                if (!$checkin_history_data->checkout) {
                    $checkin_history_data->checkout = Carbon::now();
                    $checkin_history_data->description = $request->description ?? '';
                    $checkin_history_data->save();
                    return $this->successResponse('CheckOut Successfully!', ['html' => $html, 'html_section_id' => 'checkin-section']);
                }
            }
            return $this->errorResponse('Something went wrong, please contact support team, thanks', ['errors' => ['Something went wrong, please contact support team, thanks'], 'html' => $html]);
        }
    }

    public function getUserCheckinRecord(Request $request)
    {
        $user_id = $request->user_id;
        $filters = ($user_id > 0) ? [['user_id', '=', $user_id]] : [];
        $date_filters = historyDateFilter($request->user_days);
        $filters = array_merge($date_filters, $filters);
       // dd($filters);
        $checkin_history_data = CheckinHistory::where($filters)->get();
        $count = $checkin_history_data->count();
        $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $checkin_history_data, 'totalCheckins' => $count])->render();
        if ($count > 0)
        {
            return $this->successResponse('Record Found successfully', ['html' => $checkin_history_html, 'html_section_id' => 'checkin-history']);
        }
        else
        {
            return $this->errorResponse('Record Not Found', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'checkin-history']);
        }

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
    public function checkinHistoryBtDates(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

        ## End Date User Record Included
        $result = CheckinHistory::whereDate('checkin', '>=', $start_date)->whereDate('checkin', '<=', $end_date)->get();

        $html = view('pages.user._partial._checkin_history_html', ['user_history' => $result])->render();
        if ($result->count() > 0) {
            return $this->successResponse('Checkin_History Received successfully', ['html' => $html, 'html_section_id' => 'self-checkin-history']);
        } else {
            return $this->errorResponse('Checkin_History Not Found', ['errors' => ['Checkin_History Not Found'], 'html' => $html, 'html_section_id' => 'self-checkin-history']);
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
}
