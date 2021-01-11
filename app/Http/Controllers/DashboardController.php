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
        $user = $this->getAuthUser();
        $checkinHistory = $user ? $user->checkinHistory : null;
        $isCheckin = $this->isUserCheckin();
        $responseData = ['is_checkin' => $isCheckin, 'checkin_history' => $checkinHistory, 'user' => $user];
        if ($isCheckin) {
            $responseData['user_last_checkin_time'] = $this->userLastCheckinTime();
        }
        return view('pages.user.dashboard', $responseData);
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
