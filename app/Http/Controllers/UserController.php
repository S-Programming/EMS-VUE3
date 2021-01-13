<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\CheckinHistory;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Models\User;
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
