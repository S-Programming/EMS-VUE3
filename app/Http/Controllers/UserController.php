<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\CheckinHistory;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Models\Attendence;
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
    /**
     * Display a Report of the User-Self Checkin History.
     *
     * @return body
     */
    public function userReportHistory(Request $request)
    {
        return $this->sendJsonResponse($this->userService->userReportHistory($request));
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'email' => 'required|email',   // |unique:users,email
            'phone_number' => 'required|min:11|numeric',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
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
        //dd($request);
        return $this->sendJsonResponse($this->userService->confirmDeleteUser($request));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userEditProfile()
    {
        $user_id = $this->getAuthUserId();
        $user_data = User::find($user_id);
        return view('pages.user.user_edit_profile', ['user_data' => $user_data]);
    }

    /**
     * Show the form for updating the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userUpdateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'email' => 'required|email',   // |unique:users,email
            'phone_number' => 'required|min:11|numeric',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userService->userUpdateProfile($request));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userUpdatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required_with:new_password|same:new_password|min:8',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userService->userUpdatePassword($request));
    }

    // Today Attendance Show at _user_attendance_html partial view
    public function verifyAttendance(Request $request)
    {
        // return $this->sendJsonResponse($this->userService->verifyAttendance($request));
        // $allUsers = User::all();
        // dd($this->getAllUsers());
        //$user_attendance = Attendence::whereDate('created_at', Carbon::today())->get();
        foreach ($this->getAllUsers() as $User) {
            $check = Attendence::where('user_id', $User->id)
                ->whereDate('created_at', Carbon::today())->first();
            if (!$check) {
                $addEntry = new Attendence;
                $addEntry->user_id = $User->id;
                $addEntry->is_present = '0';
                $addEntry->entry_ip = '';
                $addEntry->entry_location = '';
                $addEntry->exit_ip = '';
                $addEntry->exit_location = '';
                $addEntry->created_at = Carbon::now();
                $addEntry->save();
            }
        }
        $todayAttendance = Attendence::whereDate('created_at', Carbon::today())->orderBy("user_id", "asc")->get();
        // dd($todayAttendance);
        // $user_attendance_html = view('pages.user._partial._user_attendance_html', compact('todayAttendance', $todayAttendance))->render();
        return view('pages.user.today_attendence_list')->with(['users' => $this->getAllUsers(), 'todayAttendance' => $todayAttendance]);
        // return view('pages.user.today_attendence_list');
    }
    //Get User Attendance Monthly Wise
    public function getUserAttendanceMonthly(Request $request)
    {
        return $this->sendJsonResponse($this->userService->getUserAttendanceMonthly($request));
    }
}
