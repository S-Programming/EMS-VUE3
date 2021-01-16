<?php

namespace App\Http\Controllers;

use App\Facades\CommonUtilsFacade;
use App\Http\Services\DashboardService;
use http\Message\Body;
use Illuminate\Http\Request;
use App\Models\CheckinHistory;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Callback;

//use App\Http\Services\CheckinHistoryService;

class DashboardController extends Controller
{
    protected $dashboardService;

    /**
     * Create a new controller instance.
     *
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth');
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Current Month Checkins
        $userId = $this->getAuthUserId();
        $monthlyCheckins = CheckinHistory::where('checkin', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
            ->where('user_id', $userId)
            ->get()->count();
        $previousMonthCheckins = CheckinHistory::whereMonth(
            'checkin',
            '=',
            Carbon::now()->subMonth()->month
        )->get()->count();
        $NowDate = Carbon::now()->format('Y-m-d');
        $currentStartWeekDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1); // gives 2016-01-3
        $currentWeekCheckins = CheckinHistory::whereBetween('checkin', array($currentStartWeekDate, $NowDate))
            ->where('user_id', $userId)
            ->get()->count();
        $previousWeekStartDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->subWeek()->format('Y-m-d'); // gives 2016-01-31
        $previousWeekEndDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->format('Y-m-d');
        $pastWeekCheckins = CheckinHistory::whereBetween('checkin', array($previousWeekStartDate, $previousWeekEndDate))
            ->where('user_id', $userId)
            ->get()->count();
        // Total Users
        $count = DB::table('users')->count();
        $user = $this->getAuthUser();
        $responseData = ['is_checkin' => $this->isUserCheckin(),'user' => $user,'count' => $count, 'monthlyCheckins' => $monthlyCheckins, 'previousMonthCheckins' => $previousMonthCheckins, 'currentWeekCheckins' => $currentWeekCheckins, 'pastWeekCheckins' => $pastWeekCheckins];
        $responseData['checkin_history'] = $user ? $user->checkinHistory : null;
        $responseData['is_checkin'] = $this->isUserCheckin();
        if ($responseData['is_checkin']) {
            $responseData['user_last_checkin_time'] = $this->userLastCheckinTime();
        }
        return view('pages.user.dashboard', $responseData);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return $this->dashboardService->getDashboard();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
