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

    public function getDashboard(Request $request)
    {
        $user = $this->getAuthUser();
        if ($user) {
            $userRoles = $this->userRoles();
            if (in_array(RoleUser::SuperAdmin, $userRoles) || in_array(RoleUser::Admin, $userRoles)) {
                return $this->adminDashboard($request);
            }
            elseif(in_array(RoleUser::EngagementManager, $userRoles))
            {
                return $this->engagementManagerDashboard($request);
            }
            elseif(in_array(RoleUser::ProjectManager, $userRoles))
            {
                return $this->projectManagerDashboard($request);
            }
            else {
                return $this->userDashboard($request);
            }
        }
    }

    public function userDashboard(Request $request)
    {
        // Current Month Checkins count
        $userId = $this->getAuthUserId();
        $monthly_checkins = CheckinHistory::where('checkin', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
            ->where('user_id', $userId)
            ->get()->count();
        // Current Month Checkins count
        $previous_month_checkins = CheckinHistory::whereMonth(
            'checkin',
            '=',
            Carbon::now()->subMonth()->month
        )->get()->count();
        // Current Week Checkins count
        $NowDate = Carbon::now()->format('Y-m-d');
        $current_start_week_date = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1); // gives 2016-01-3
        $current_week_checkins = CheckinHistory::whereBetween('checkin', array($current_start_week_date, $NowDate))
            ->where('user_id', $userId)
            ->get()->count();
        // Past Week Checkins count
        $previous_week_start_date = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->subWeek()->format('Y-m-d'); // gives 2016-01-31
        $previous_week_end_date = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->format('Y-m-d');
        $past_week_checkins = CheckinHistory::whereBetween('checkin', array($previous_week_start_date, $previous_week_end_date))
            ->where('user_id', $userId)
            ->get()->count();

        // Total Users Count from users table of logged in user
        $total_users = User::all()->count();

        $menu_data = Menu::with('menusRole')->get();
        // dd($menu_data[0]->menusRole[0]->pivot->role_id);
        $user = $this->getAuthUser();
        // dd($user->checkinHistory);
        $isCheckin = $this->isUserCheckin();
        $responseData = ['is_checkin' => $isCheckin, 'user' => $user, 'menu_data' => $menu_data, 'count' => $total_users, 'monthlyCheckins' => $monthly_checkins, 'previousMonthCheckins' => $previous_month_checkins, 'currentWeekCheckins' => $current_week_checkins, 'pastWeekCheckins' => $past_week_checkins];
        $responseData['checkin_history'] = $user ? $user->checkinHistory : null;
        if ($isCheckin) {
            $responseData['user_last_checkin_time'] = $this->userLastCheckinTime();
        }
        //Checkin History Record show at Bottom
        $user_history = CheckinHistory::all();
        $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $user_history]);
        // $html = view('pages.user._partial._checkin_history_html', ['user_history' =>  $responseData['checkin_history']])->render();
        return view('pages.user.dashboard', $responseData)->with(['checkin_history_html' => $checkin_history_html]);
    }

    public function adminDashboard(Request $request)
    {
        $total_users = User::all()->count();
        $user = $this->getAuthUser();
        $responseData = ['user' => $user, 'total_user_count' => $total_users];
        $responseData['checkin_history'] = $user ? $user->checkinHistory : null;
        return view('pages.admin.dashboard', $responseData);
    }
    public function engagementManagerDashboard(Request $request)
    {
        $total_users = User::all()->count();
        $user = $this->getAuthUser();
        $responseData = ['user' => $user, 'total_user_count' => $total_users];
        $responseData['checkin_history'] = $user ? $user->checkinHistory : null;
        return view('pages.engagementManager.dashboard', $responseData);
    }
    public function projectManagerDashboard(Request $request)
    {
        $total_users = User::all()->count();
        $user = $this->getAuthUser();
        $responseData = ['user' => $user, 'total_user_count' => $total_users];
        $responseData['checkin_history'] = $user ? $user->checkinHistory : null;
        return view('pages.projectManager.dashboard', $responseData);
    }
}
