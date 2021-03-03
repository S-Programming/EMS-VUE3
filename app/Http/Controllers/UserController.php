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

    public function viewUserProfilePlusInteractions(Request $request,$user_id)
    {
        $user_data = User::find($user_id);
        $user_id = $user_data->id;
        $user = User::find($this->getAuthUserId());
        $user_name = $user->first_name;
        $user_interactions = UserInteraction::with('users')->where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
        //dd($user_interactions->users->first_name);
        $html = view('pages.admin._partial._users_interactions_list_table_html',['html_section_id' => 'userlist-section'])->render();
        return view('pages.admin.user_profile', ['html' => $html, 'user_data' => $user_data,'user_interactions' => $user_interactions,'user_id'=>$user_id,'user_name'=>$user_name]);
    }
    public function addUserInteractionModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin._partial._add_userInteraction_point_modal',['user_id'=>$request->id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    public function confirmAddUserInteractionModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'discussion_point' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userService->confirmAddUserInteractionModal($request));
    }
    public function deleteUserInteraction(Request $request)
    {
        $ui = UserInteraction::where('id',$request->id)->first();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.discussions._partial._delete_user_interaction_modal',['id' => $containerId, 'user_interaction_id'=>$ui->id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    public function deleteConfirmUserInteraction(Request $request)
    {
        $user_interactions = UserInteraction::find($request->user_interaction_id);
        $user_interactions->delete();
        $user_id = $user_interactions->user_id;
        $user_interactions = UserInteraction::with('users')->where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
        $user = User::find($this->getAuthUserId());
        $user_name = $user->first_name;
        $html = view('pages.admin._partial._users_interactions_list_table_html',['user_interactions' => $user_interactions,'user_id'=>$user_id,'user_name'=>$user_name])->render();
        return $this->successResponse('success', ['html' => $html,'html_section_id' => 'userlist-section']);

    }
    public function discussionsView(Request $request)
    {
        $current_user = $this->getAuthUserId();
        $user_interactions = UserInteraction::with('users')->where('staff_id',$current_user)->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin.discussions._partial._discussions_list',['html_section_id' => 'userlist-section'])->render();
        return view('pages.admin.discussions.discussion', ['html' => $html, 'user_interactions' => $user_interactions]);
    }
    /**
     * Display all projects list with project Managers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projectList(Request $request)
    {
        $projects = Project::with('users')->where('project_status',"!=",2)->with('technologystack')->get();
        return view('pages.admin.projects.projects',['projects'=>$projects]);
    }
    /**
     * Display popup to add project By Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addProjectModal(Request $request)
    {
      return $this->sendJsonResponse($this->userService->addProjectModal($request));
    }
    /**
     * Click Add to add project in the project list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmAddProject(Request $request)
    {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|min:3|string',
            'project_description' => 'required|min:3',
            'project_manager_id' => 'required|numeric',
            'technology_stack_id.*' => 'required|distinct|numeric|min:1',
//            'project_document' => 'required|csv,txt,xlx,xls,pdf|max:2048',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userService->confirmAddProject($request));
    }
    /**
     * Display popup to edit Project Attributes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->editProjectModal($request));
    }
    /**
     * Click Update Button to edit Project Attributes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmEditProjectModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|min:3|max:30',
            'project_description' => 'required|min:3|max:500',
            'project_manager_id' => 'required|numeric',
//            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userService->confirmEditProjectModal($request));
    }
    /**
     * Display popup to view the Project with detail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->viewProjectModal($request));
    }
    /**
     * Display Popup to delete Project form DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->deleteProjectModal($request));
    }
    /**
     * Click Delete button to delete project from DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->confirmDeleteProjectModal($request));
    }

}
