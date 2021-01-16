<?php


namespace App\Http\Services;

use App\Http\Enums\RoleUser;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckinHistory;
use Illuminate\Http\Request;
use App\Http\Services\BaseService\BaseService;
use App\Models\Menu;
use App\Models\User;
use Carbon\Carbon;

class DashboardService extends BaseService
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getDashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user) {
                $userRoles = $this->userRoles();
                if (in_array(RoleUser::SuperAdmin, $userRoles)) {

                }


                /*switch ($roleId) {
                    case RoleUser::SuperAdmin:
                        return view('admin.index');
                    case RoleUser::Admin:
                        return view('admin.index');
                }*/
            }
        }
    }

    public function index(Request $request)
    {
        // Current Month Checkins count
        $userId = $this->getAuthUserId();
        $monthlyCheckins = CheckinHistory::where('checkin', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
            ->where('user_id', $userId)
            ->get()->count();
        // Current Month Checkins count
        $previousMonthCheckins = CheckinHistory::whereMonth(
            'checkin',
            '=',
            Carbon::now()->subMonth()->month
        )->get()->count();
        // Current Week Checkins count
        $NowDate = Carbon::now()->format('Y-m-d');
        $currentStartWeekDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1); // gives 2016-01-3
        $currentWeekCheckins = CheckinHistory::whereBetween('checkin', array($currentStartWeekDate, $NowDate))
            ->where('user_id', $userId)
            ->get()->count();
        // Past Week Checkins count
        $previousWeekStartDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->subWeek()->format('Y-m-d'); // gives 2016-01-31
        $previousWeekEndDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->format('Y-m-d');
        $pastWeekCheckins = CheckinHistory::whereBetween('checkin', array($previousWeekStartDate, $previousWeekEndDate))
            ->where('user_id', $userId)
            ->get()->count();

        // Total Users Count from users table of logged in user
        $totalUsers = User::all()->count();

        $menu_data = Menu::with('menusRole')->get();
        // dd($menu_data[0]->menusRole[0]->pivot->role_id);
        $user = $this->getAuthUser();
        $checkinHistory = $user ? $user->checkinHistory : null;
        $isCheckin = $this->isUserCheckin();
        $responseData = ['is_checkin' => $isCheckin, 'checkin_history' => $checkinHistory, 'user' => $user, 'menu_data' => $menu_data];
        if ($isCheckin) {
            $responseData['user_last_checkin_time'] = $this->userLastCheckinTime();
        }
        //Checkin History Record show at Bottom
        $checkin_history = CheckinHistory::where('user_id', $userId)->get();
        $checkin_history_html = view('pages.report._partial._checkinhistory_table', ['records' => $checkin_history]);
        $dashboardView = view('pages.user.dashboard', $responseData)->with(['checkin_history_html' => $checkin_history_html, 'count' => $totalUsers, 'monthlyCheckins' => $monthlyCheckins, 'previousMonthCheckins' => $previousMonthCheckins, 'currentWeekCheckins' => $currentWeekCheckins, 'pastWeekCheckins' => $pastWeekCheckins]);
        return $dashboardView;

    }
}
