<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\CheckinHistory;
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
            return $this->successResponse('You are successfully checked-in', ['html' => $html, 'html_section_id' => 'checkin-section']);
        }
    }

    public function confirmCheckout(Request $request)
    {
        $userid = $this->getAuthUserId();
        if ($userid > 0) {
            $html = view('pages.user._partial._checkin_html')->render();
            $checkin_history_data = CheckinHistory::where('user_id', $userid)->latest()->first();
            if ($checkin_history_data != null) {
                //session(['is_checkin'=>false]);
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
}
