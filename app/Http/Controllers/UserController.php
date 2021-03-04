<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\CheckinHistory;
use App\Models\RoleUser;
use App\Models\UserInteraction;
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
        return view('pages.user.users')->with(['users' => $this->getAllUsers()]);
    }
    /**
     * Import Csv of users
     *
     * @return \Illuminate\Http\Response
     */
    public function importUsersCsv(Request $request)
    {
        dd($request->all());
        // $file =
        //dd($request->all());
        // $file = $request->file('csv_file');
        // $file->getClientOriginalName());
        // return 1;
        //   dd("lkjhrewertyuli");
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        $response = $this->userService->storeCSV($request);
        //        if (!$response) return $this->error('Following emails already exists in the system');
        //        $redirection_route = '/exhibition_visitor';
        //
        //        return $this->success('Success', ['data' => $response, 'redirect_to' => $redirection_route]);
        if (!$response) {
            $redirection_route = '/user';
            return $this->error('Following emails already exists in the system', ['errors' => ['Duplicate Emails'], 'redirect_to' => $redirection_route]);
        }
        $redirection_route = '/user';
        return $this->success('Success', ['data' => $response, 'redirect_to' => $redirection_route]);
        //dd($request->all(), 'saaddd');
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
            'email' => 'required|email|unique:users',   // |unique:users,email
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
        //dd($request->all());
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
}
