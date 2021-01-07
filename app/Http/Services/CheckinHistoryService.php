<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\CheckinHistory;
use Carbon\Carbon;
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
}
