<?php

namespace App\Http\Controllers;

use App\Facades\CommonUtilsFacade;
use App\Http\Services\CheckinHistoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckinHistory;
use App\Models\User;
use http\Message\Body;
use Carbon\Carbon;
use Session;

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

    /**
     * Checking Method for the users to checkout
     *
     * @return
     */
    public function confirmCheckout(Request $request)
    {
        return $this->sendJsonResponse($this->checkinHistoryService->confirmCheckout($request));
    }

    /**
     * It will display all the users checkin history to Super Admin and Admin
     *
     * @return Body
     */
    public function allCheckinList(Request $request)
    {
        $user_history = CheckinHistory::all();
        $users = User::all();
        $html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history])->render();
        return view('pages.user.all_checkin_list', ['user_history' => ($user_history ?? null),'user_history_html' => $html, 'users' => $users]);
    }

    public function getUserCheckinRecord(Request $request)
    {
        return $this->sendJsonResponse($this->checkinHistoryService->getUserCheckinRecord($request));
        // dd($user_history);
        /*if (isset($user_history['errors']) && !empty($user_history['errors'])) {
            return redirect()->route('dashboard');
        }
        return view('pages.user.all_checkin_list')->with('user_history', $user_history);*/
    }
}
