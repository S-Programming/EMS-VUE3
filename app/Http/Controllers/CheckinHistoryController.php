<?php

namespace App\Http\Controllers;

use App\Facades\CommonUtilsFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckinHistory;
use http\Message\Body;
use Carbon\Carbon;
use Session;

class CheckinHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

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

//        dd(CommonUtilsFacade::isCheckIn());
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
        $isMarkCheckIn=true;
        ## DB operations
        $userid = $this->getAuthUserId();
        if ($userid > 0) {
            $checkin_history_data = CheckinHistory::where('user_id', $userid)->latest()->first();
            if (!is_null($checkin_history_data)) {
                $today = Carbon::parse($checkin_history_data->checkin);
                /*## Need to improve logic, If user already checkin then will not be able to checkin again*/
                if ($today->isToday() && !$checkin_history_data->checkout) {
                    session(['is_checkin'=>true]);
                    return $this->error('You are already Checked-in');
                } elseif (!$checkin_history_data->checkout) {
                    return $this->error('forgot to logout', ['errors' => ['You forgot to checkout last day, please logout first']]);
                }
            }
            if ($isMarkCheckIn) {
                $cico = new CheckinHistory;
                $cico->checkin = Carbon::now();
                $cico->user_id = $userid;
                $cico->save();
                session(['is_checkin'=>true]);
            }
            $html=view('pages.user._partial._checkout_html')->render();
            return $this->success('You are successfully checked-in',['html'=>$html,'html_section_id'=>'checkin-section']);
        }
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
        $userid = $this->getAuthUserId();
        if ($userid > 0) {
            $html=view('pages.user._partial._checkin_html')->render();
            $checkin_history_data = CheckinHistory::where('user_id', $userid)->latest()->first();
            if ($checkin_history_data != null) {
                session(['is_checkin'=>false]);
                if (!$checkin_history_data->checkout) {
                    $checkin_history_data->checkout = Carbon::now();
                    $checkin_history_data->description = $request->description ?? '';
                    $checkin_history_data->save();
                    return $this->success('CheckOut Successfully!',['html'=>$html,'html_section_id'=>'checkin-section']);
                }
            }
            return $this->error('Something went wrong, please contact support team, thanks', ['errors' => ['Something went wrong, please contact support team, thanks'],'html'=>$html]);
        }
    }
}
