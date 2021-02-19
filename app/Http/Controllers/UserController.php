<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\CheckinHistory;
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
       // dd($request->all());
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

    public function viewUserProfilePlusInteractions(Request $request,$user_id)
    {
        //dd($user_id);
        $user_data = User::find($user_id);
        $user_id = $user_data->id;
        $userInteractions = UserInteraction::where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin._partial._users_interactions_list_table_html',['html_section_id' => 'userlist-section'])->render();
        return view('pages.admin.user_profile', ['html' => $html, 'user_data' => $user_data,'userInteractions' => $userInteractions,'user_id'=>$user_id]);
    }
    public function addUserInteractionModal(Request $request)
    {
        //dd($request->id);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin._partial._add_userInteraction_point_modal',['user_id'=>$request->id])->render();
//        ,['user_email'=>$user_email]
        return $this->successResponse('success', ['html' => $html]);
//        dd($request->all());
    }
    public function confirmAddUserInteractionModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->confirmAddUserInteractionModal($request));
    }
    public function discussionsView(Request $request)
    {

        $current_user = $this->getAuthUserId();
//        $userInteractions $userInteractions= UserInteraction::where('staff_id',$current_user)->orderBy('created_at', 'DESC')->get();
        $userInteractions = UserInteraction::with('users')->where('staff_id',$current_user)->orderBy('created_at', 'DESC')->get();
        //$abc = $userInteractions->toArray();
        //dd($abc['users']);
//        dd($userInteractions[0]);
//        dd($userInteractions[2]->users->first_name);
        $html = view('pages.admin.discussions._partial._discussions_list',['html_section_id' => 'userlist-section'])->render();
        return view('pages.admin.discussions.discussion', ['html' => $html, 'userInteractions' => $userInteractions]);
    }
}
