<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\CheckinHistory;
use Illuminate\Http\Request;
use App\Http\Services\BaseService\BaseService;


class DashboardService extends BaseService
{
    public function showCheckinHistory(Request $request)
    {
        $user_id = Auth::user()->id;
        $loggedin_user = CheckinHistory::where('user_id', $user_id)->get();

        return view('pages.user.dashboard', ['is_checkin' => $this->isUserCheckin(), 'data' => $loggedin_user]);

        // $html =  view('pages.user.dashboard')->render();

        // return $this->successResponse('You are successfully checked-in', ['html' => $html, 'is_checkin' => $this->isUserCheckin(), 'data' => $loggedin_user]);
    }
}
