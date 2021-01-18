<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\CheckinHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CheckinHistoryService extends BaseService
{

    public function confirmCheckin(Request $request)
    {
        $isMarkCheckIn = true;
        ## DB operations
        $userid = $this->getAuthUserId();
        if ($userid > 0) {
            $checkin_history_data = CheckinHistory::where('user_id', $userid)->latest()->first();
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

                $cico = new CheckinHistory;
                $cico->checkin = Carbon::now();
                $cico->user_id = $userid;
                $cico->save();
            }
            $html = view('pages.user._partial._checkout_html')->render();
            return $this->successResponse('You are successfully checked-in', ['html' => $html, 'html_section_id' => 'checkin-section', 'module' => 'checkin']);
        }
    }

    public function confirmCheckout(Request $request)
    {
        $userid = $this->getAuthUserId();
        if ($userid > 0) {
            $html = view('pages.user._partial._checkin_html')->render();
            $checkin_history_data = CheckinHistory::where('user_id', $userid)->latest()->first();
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
        //dd($request->all());
        $user_id = $request->user_id;

        if ($user_id == 'All') {
            $user_history = CheckinHistory::all();

            $html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history])->render();
            $validate = count($user_history);
            if ($validate) {

                return $this->successResponse('All User History Fetch Successfully', ['html' => $html, 'html_section_id' => 'checkin-history']);
            } else {
                return $this->errorResponse('User History Record Not Found', ['errors' => ['User History Record Not Found'], 'html' => $html, 'html_section_id' => 'checkin-history']);
            }
            /* else
            {
                return $this->errorResponse('User History Record Not Found', ['errors' => ['User History Record Not Found'],'html' => $html]);
            }*/
        }
        /*$user_history = CheckinHistory::where('user_id', $user_id)->get();

        $html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history])->render();
        $validate = count($user_history);
        if($validate)
        {
            return $this->successResponse('User History Fetch Successfully', ['html' => $html, 'html_section_id' => 'checkin-history']);
        }*/
        /*else
        {
            return $this->errorResponse('User History Record Not Found', ['errors' => ['User History Record Not Found'],'html' => $html,'html_section_id' => 'checkin-history']);
        }*/

        if ($request->user_days == 'Current Month') {
            // dd("sadd");
            //  $user_id = $request->user_id;
            $currentmonthlyCheckins = CheckinHistory::where('checkin', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                ->where('user_id', $user_id)
                ->get();
            //  dd($user_id);
            $count = $currentmonthlyCheckins->count();
            $html = view('pages.user._partial._checkin_history_html', ['user_history' => $currentmonthlyCheckins, 'totalCheckins' => $count])->render();
            // dd($currentmonthlyCheckins);
            if ($count > 0) {
                return $this->successResponse('Current Month Checkin_History Received successfully', ['html' => $html, 'html_section_id' => 'checkin-history']);
            } else {
                return $this->errorResponse('Current Month Checkin_History Not Exists', ['errors' => ['Current Month Checkin_History Not Exists'], 'html' => $html, 'html_section_id' => 'checkin-history']);
            }
        } elseif ($request->user_days == 'Previous Month') {
            //Previous Month Checkins
            $previousMonthCheckins = CheckinHistory::whereMonth(
                'checkin',
                '=',
                Carbon::now()->subMonth()->month
            )->get();
            $count = $previousMonthCheckins->count();
            $html = view('pages.user._partial._checkin_history_html', ['user_history' => $previousMonthCheckins, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('Previous Month Checkin_History Received successfully', ['html' => $html, 'html_section_id' => 'checkin-history']);
            } else {
                return $this->errorResponse('Previous Month Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $html, 'html_section_id' => 'checkin-history']);
            }
        } elseif ($request->user_days == 'Current Week') {
            // current week
            $NowDate = Carbon::now()->format('Y-m-d');
            $currentStartWeekDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1); // gives 2016-01-3
            $currentWeekCheckins = CheckinHistory::whereBetween('checkin', array($currentStartWeekDate, $NowDate))
                ->where('user_id', $user_id)
                ->get();
            $count = $currentWeekCheckins->count();
            $html = view('pages.user._partial._checkin_history_html', ['user_history' => $currentWeekCheckins, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('Current Week Checkin_History Received successfully', ['html' => $html, 'html_section_id' => 'checkin-history']);
            } else {
                return $this->errorResponse('Current Week Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $html, 'html_section_id' => 'checkin-history']);
            }
        } elseif ($request->user_days == 'Previous Week') {
            // Past Week Checkins (Today is not included)
            $previousWeekStartDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->subWeek()->format('Y-m-d'); // gives 2016-01-31
            $previousWeekEndDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->format('Y-m-d');
            $pastWeekCheckins = CheckinHistory::whereBetween('checkin', array($previousWeekStartDate, $previousWeekEndDate))
                ->where('user_id', $user_id)
                ->get();
            $count = $pastWeekCheckins->count();
            $html = view('pages.user._partial._checkin_history_html', ['user_history' => $pastWeekCheckins, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('Previous Week Checkin_History Received successfully', ['html' => $html, 'html_section_id' => 'checkin-history']);
            } else {
                return $this->errorResponse('Previous Week Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $html, 'html_section_id' => 'checkin-history']);
            }
        } else {
            $all_checkin_history = CheckinHistory::where('user_id', $user_id)->get();
            $count = $all_checkin_history->count();
            $html = view('pages.user._partial._checkin_history_html', ['user_history' => $all_checkin_history, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('All Checkin_History Received successfully', ['html' => $html, 'html_section_id' => 'checkin-history']);
            } else {
                return $this->errorResponse('Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $html, 'html_section_id' => 'checkin-history']);
            }
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
        //        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        // $role_data=Role::find($user_id);
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
        //$login_id = $this->getAuthUserId();
        $checkin_id = $request->checkin_id;
        /*if ($user_id == $login_id) {
            return $this->errorResponse('Authorization Required', ['errors' => ['You dont have Authorization to Delete this Account']]);
        }
*/
        // dd($checkin_id);
        $user_data = CheckinHistory::find($checkin_id);
        $user_data->delete();
        $users = User::all();
        $user_history = CheckinHistory::all();
        $html = view('pages.user._partial._checkin_history_html', ['users' => $users, 'user_history' => $user_history])->render();
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
