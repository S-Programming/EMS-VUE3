<?php

namespace App\Http\Controllers;

use App\Facades\CommonUtilsFacade;
use App\Http\Services\DashboardService;
use http\Message\Body;
use Illuminate\Http\Request;
use App\Models\CheckinHistory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        // $weekMap = [
        //     0 => 'SUNDAY',
        //     1 => 'MONDAY',
        //     2 => 'TUESDAY',
        //     3 => 'WEDNESDAY',
        //     4 => 'THURSDAY',
        //     5 => 'FRIDAY',
        //     6 => 'SATURDAY',
        // ];
        // $dayOfTheWeek = Carbon::now()->dayOfWeek;
        // $weekday = $weekMap[$dayOfTheWeek];
        // $user_id = Auth::user()->id;
        // $loggedin_user = CheckinHistory::where('user_id', $user_id)->get();
        // return view('pages.user.dashboard', ['is_checkin' => $this->isUserCheckin(), 'data' => $loggedin_user]);

        return $this->dashboardService->showCheckinHistory($request);
        // return $this->sendJsonResponse($this->dashboardService->showCheckinHistory($request));
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
