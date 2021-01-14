<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\CheckinHistory;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.user.users')->with('users', $users);
    }
    // Display User Weekly Report
    public function userReport(Request $request)
    {
        //dd($request->duration);
        $userId = $this->getAuthUserId();
        if ($request->duration == 'currentWeek') {
            // current week
            $NowDate = Carbon::now()->format('Y-m-d');
            $currentStartWeekDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1); // gives 2016-01-3
            $currentWeekCheckins = CheckinHistory::whereBetween('checkin', array($currentStartWeekDate, $NowDate))
                ->where('user_id', $userId)
                ->get();
            // dd($currentWeekCheckins);
            return view('pages.report.reports')->with('currentWeekCheckins', $currentWeekCheckins);
        } elseif ($request->duration == 'previousWeek') {
            // Past Week Checkins (Today is not included)
            $previousWeekStartDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->subWeek()->format('Y-m-d'); // gives 2016-01-31
            $previousWeekEndDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->format('Y-m-d');
            $pastWeekCheckins = CheckinHistory::whereBetween('checkin', array($previousWeekStartDate, $previousWeekEndDate))
                ->where('user_id', $userId)
                ->get();
            //dd($pastWeekCheckins);
            return view('pages.report.reports')->with('pastWeekCheckins', $pastWeekCheckins);
            // dd($pastWeekCheckins);
        } elseif ($request->duration == 'currentMonth') {
            $currentmonthlyCheckins = CheckinHistory::where('checkin', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                ->where('user_id', $userId)
                ->get();
            return view('pages.report.reports')->with('currentmonthlyCheckins', $currentmonthlyCheckins);
            //dd($currentmonthlyCheckins); previousMonth
        } elseif ($request->duration == 'previousMonth') {
            //Previous Month Checkins
            $previousMonthCheckins = CheckinHistory::whereMonth(
                'checkin',
                '=',
                Carbon::now()->subMonth()->month
            )->get();
            return view('pages.report.reports')->with('previousMonthCheckins', $previousMonthCheckins);
            //dd($previousMonth);
        } else {
            dd('hahahahaha kch to galat ha!!!!');
        }
    }
    public function userReportHistory(Request $request)
    {
        return $this->sendJsonResponse($this->userService->userReportHistory($request));
    }



    public function userRecoed(Request $request)
    {
        //dd($this->getAuthUser());
        $validator = Validator::make($request->all(), [
            'specificUserId' => 'required | numeric',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        $userId = $request->specificUserId;
        $userData = CheckinHistory::where('user_id', $userId)->get();
        return view('pages.user.userrecord')->with('userData', $userData);
    }
    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function userModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->userModal($request));
    }

    /**
     * Method for the Adding Users
     *
     * @return Body
     */
    public function confirmAddUser(Request $request)
    {
        return $this->sendJsonResponse($this->userService->confirmAdduser($request));
    }


    /**
     * It will return a HTML for the Modal container for confirmation of deletion
     *
     * @return Body
     */
    public function userDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->userDeleteModal($request));
    }
    /**
     * Method for the Deleting Users
     *
     * @return Body
     */
    public function confirmDeleteUser(Request $request)
    {
        return $this->sendJsonResponse($this->userService->confirmDeleteUser($request));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selfEditProfile()
    {
        $user_id = $this->getAuthUserId();
        $user_data = User::find($user_id);
        return view('pages.user.self_edit_profile', ['user_data' => $user_data]);
    }

    /**
     * Show the form for updating the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selfUpdateProfile(Request $request)
    {
        return $this->sendJsonResponse($this->userService->selfUpdateProfile($request));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selfUpdatePassword(Request $request)
    {
        return $this->sendJsonResponse($this->userService->selfUpdatePassword($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
