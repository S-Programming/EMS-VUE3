<?php

namespace App\Http\Controllers;

use App\Http\Services\CheckinHistoryService;
use Illuminate\Http\Request;
use App\Models\CheckinHistory;
use http\Message\Body;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CheckinHistoryController extends Controller
{
    protected $checkinHistoryService;

    public function __construct(CheckinHistoryService $checkinHistoryService)
    {
        $this->middleware('auth');
        $this->checkinHistoryService = $checkinHistoryService;
    }

    public function index()
    {
    }

    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function checkinModal(Request $request)
    {
        $user_id =  $this->getAuthUserId();
        $checkin_history_data = CheckinHistory::where('user_id', $user_id)->pluck('checkin')->toArray();
        $checkin_date_count = count($checkin_history_data);
        $todate = Carbon::now()->format('Y-m-d');
        if ($checkin_date_count > 0) {
            foreach ($checkin_history_data as $checkin_data) {
                $checkin_date_explode = explode(' ', $checkin_data);
                $checkin_date = $checkin_date_explode[0];
                if ($checkin_date == $todate) {
                    return $this->sendJsonResponse('You are already Checkin Today');
                }
            }
        }
        if (Carbon::now()->format('l') == 'Sunday') {
            return $this->sendJsonResponse('Today is Sunday not checkin');
        }
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.user._partial._checkin_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->success('success', ['html' => $html]);
    }

    /**
     * Checking Method for the users to checkin
     *
     * @return Body
     */
    public function confirmCheckin(Request $request)
    {
        return $this->sendJsonResponse($this->checkinHistoryService->confirmCheckin($request));
    }

    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function checkoutModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.user._partial._checkout_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->success('success', ['html' => $html]);
    }

    // /**
    //  * Checking Method for the users to checkout
    //  *
    //  * @return
    //  */
    // public function confirmCheckout(Request $request, $force = null)
    // {
    //     $validator = Validator::make($request->all(), [
    //         // 'done_today' => 'required|max:500',   //min:3 not working
    //         'do_tomorrow' => 'required|max:500',   //min:3 not working
    //         'questions' => 'required|max:500',   //min:3 not working
    //     ]);
    //     if ($validator->fails()) {
    //         return $this->error('Validation Failed', ['errors' => $validator->errors()]);
    //     }
    //     return $this->sendJsonResponse($this->checkinHistoryService->confirmCheckout($request, $force));
    // }

    /**
     * It will display all the users checkin history to Super Admin and Admin
     *
     * @return Body
     */
    public function allUsersCheckinList(Request $request)
    {
        $user_history = CheckinHistory::all();
        $user_days = view('utils.durationfilter')->render();
        $html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history])->render();
        return view('pages.user.users_checkin_report', ['user_history_html' => $html, 'users' => $this->getAllUsers(), 'user_days' => $user_days]);
    }

    public function checkinList(Request $request)
    {
        $user_history = CheckinHistory::where('user_id', $this->getAuthUserId())->with('tags')->orderBy('id', 'desc')->get();
        //dd($user_history->checkin);
        // dd($user_history);
        // foreach($user_history as $data) {
        //     foreach($data->tags as $tag){
        //         print_r($tag->name);
        //     }
            
        // }
        // dd(1);
        $html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history])->render();
        return view('pages.user.users_own_checkin_report')->with(['user_history_html' => $html]);
    }


    public function getUserCheckinRecord(Request $request)
    {
        return $this->sendJsonResponse($this->checkinHistoryService->getUserCheckinRecord($request));
    }
    /**
     * It will display users checkin history Between Two Dates
     * It will also Validate start and end date
     * @return Body
     */
    public function checkinHistoryBtDates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date_format:m/d/Y|before:today|before:end_date',
            'end_date'  => 'required|date_format:m/d/Y|before_or_equal:tomorrow'
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->checkinHistoryService->checkinHistoryBtDates($request));
    }

    public function deleteCheckinUserModal(Request $request, CheckinHistory $checkinHistory)
    {
        if ($this->authorize('delete', $checkinHistory)) {
            return $this->sendJsonResponse($this->checkinHistoryService->deleteCheckinUserModal($request));
        }
    }

    public function deleteConfirmCheckinUser(Request $request)
    {
        return $this->sendJsonResponse($this->checkinHistoryService->deleteConfirmCheckinUser($request));
    }

    /**
     * It will return a HTML for the Modal container to update checkin hitory of user
     *
     * @return Body
     */

    //user checkin history edit modal by Admin
    public function editCheckinUserModal(Request $request, CheckinHistory $checkinHistory)
    {
        //condition true when user is admin or super admin
        if ($this->authorize('update', $checkinHistory)) //condition false when user is simple user
        {
            return $this->sendJsonResponse($this->checkinHistoryService->editCheckinUserModal($request));
        }
    }

    //Update user checkin history by Admin
    public function updateCheckinUser(Request $request)
    {
        //required_if:callback_type, 4|date_format:H:i
        $validator = Validator::make($request->all(), [
            'checkin-time' => 'required',
            'checkout-time' => 'required',
            'description' => 'required|min:3|max:100',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->checkinHistoryService->updateCheckinUser($request));
    }
}
