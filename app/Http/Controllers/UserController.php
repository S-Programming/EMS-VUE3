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
        //        $redirectionRoute = '/exhibition_visitor';
        //
        //        return $this->success('Success', ['data' => $response, 'redirect_to' => $redirectionRoute]);
        if (!$response) {
            $redirectionRoute = '/user';
            return $this->error('Following emails already exists in the system', ['errors' => ['Duplicate Emails'], 'redirect_to' => $redirectionRoute]);
        }
        $redirectionRoute = '/user';
        return $this->success('Success', ['data' => $response, 'redirect_to' => $redirectionRoute]);
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
        $user = User::find($this->getAuthUserId());
        $user_name = $user->first_name;
        //dd($user_name->first_name);
        //dd($user_name);
        $userInteractions = UserInteraction::with('users')->where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
        //dd($userInteractions->users->first_name);
        $html = view('pages.admin._partial._users_interactions_list_table_html',['html_section_id' => 'userlist-section'])->render();
        return view('pages.admin.user_profile', ['html' => $html, 'user_data' => $user_data,'userInteractions' => $userInteractions,'user_id'=>$user_id,'user_name'=>$user_name]);
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
        //dd($ui->id);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.discussions._partial._delete_user_interaction_modal',['id' => $containerId, 'user_interaction_id'=>$ui->id])->render();
//        ,['user_interaction_id'=>$ui->id]
        return $this->successResponse('success', ['html' => $html]);
    }
    public function deleteConfirmUserInteraction(Request $request)
    {
        $userInteractions = UserInteraction::find($request->user_interaction_id);
        $userInteractions->delete();
        $user_id = $userInteractions->user_id;
        $userInteractions = UserInteraction::with('users')->where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
        $user = User::find($this->getAuthUserId());
        $user_name = $user->first_name;
        $html = view('pages.admin._partial._users_interactions_list_table_html',['userInteractions' => $userInteractions,'user_id'=>$user_id,'user_name'=>$user_name])->render();
        return $this->successResponse('success', ['html' => $html,'html_section_id' => 'userlist-section']);

    }
    public function discussionsView(Request $request)
    {
        $current_user = $this->getAuthUserId();
        $userInteractions = UserInteraction::with('users')->where('staff_id',$current_user)->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin.discussions._partial._discussions_list',['html_section_id' => 'userlist-section'])->render();
        return view('pages.admin.discussions.discussion', ['html' => $html, 'userInteractions' => $userInteractions]);
    }
    /**
     * Display Project Manager List.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projectManagersList(Request $request)
    {
        $project_managers = RoleUser::with('user')->where('role_id',4)->get();
        $html = view('pages.engagementManager._partial._project_manager_list_table_html',['html_section_id'=> 'project-manager-list-section'])->render();
        return view('pages.engagementManager.project_manager_list',['html'=>$html,'project_managers'=>$project_managers]);
    }
    /**
     * Display Project Manager Popup To Add Project Manager.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addProjectManagerModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->addProjectManagerModal($request));
    }
    /**
     * Click Add button to add Project Manager
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddProjectManager(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'email' => 'required|email',   // |unique:users,email
            'phone_number' => 'required|min:11|numeric',
            'roles' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userService->confirmAddProjectManager($request));
    }
    /**
     * Display Edit Project Manager Popup To Edit Project Manager.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProjectManagerModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->editProjectManagerModal($request));
    }
    /**
     * Click Edit button to Edit Project Manager information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmEditProjectManager(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'email' => 'required|email',   // |unique:users,email
            'phone_number' => 'required|min:11|numeric',
            'roles' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userService->confirmEditProjectManager($request));
    }
    /**
     * Display delete popup modal to delete Project Manager.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProjectManagerModal(Request $request)
    {
        return $this->sendJsonResponse($this->userService->deleteProjectManagerModal($request));
    }
    /**
     * click delete button to delete Project Manager.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteProjectManager(Request $request)
    {
        return $this->sendJsonResponse($this->userService->confirmDeleteProjectManager($request));
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
        $projects = Project::with('users')->get();
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
        $user_id = $request->id;
        $user_data = User::with('roles')->find($user_id);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $roles = Role::all();
        $userRoles = [];
        if (isset($user_data->roles) && !empty($user_data->roles)) {
            foreach ($user_data->roles as $role) {
                if ($role->id > 0) {
                    $userRoles[$role->id] = $role->id;
                }
            }
        }
        $rolesDropDown = view('utils.roles', ['roles' => ($roles ?? null), 'user_roles' => $userRoles])->render();
        $html = view('pages.admin.projects._partial._add_project_modal', ['id' => $containerId, 'data' => null, 'roles_dropdown' => $rolesDropDown])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click Add to add project in the project list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmAddProjectModal(Request $request)
    {
        $project = new Project;
        $project->name = $request->project_name;
        $project->description =$request->project_description;
        $project->user_id =$request->roles;
        $project->start_date =Carbon::parse($request->date);
        $project->save();
        $projects = Project::with('users')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Project Added Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);
    }
    public function editProjectModal(Request $request)
    {
//        $user_id = $request->id;
        $project_id = $request->id;
        $project = Project::find($project_id);

        $user_data = User::with('roles')->find($project->user_id);
        //        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        $roles = Role::all();
        $userRoles = [];
        if (isset($user_data->roles) && !empty($user_data->roles)) {
            foreach ($user_data->roles as $role) {
                if ($role->id > 0) {
                    $userRoles[$role->id] = $role->id;
                }
            }
        }
        $projectManagersDropDown = view('utils.', ['roles' => ($roles ?? null), 'user_roles' => $userRoles])->render();
        $html = view('pages.admin.projects._partial._edit_project_modal', ['id' => $containerId, 'data' => null, 'project_managers_dropdown' => $projectManagersDropDown,'project'=>$project])->render();
        return $this->successResponse('success', ['html' => $html]);
//        $project_id = $request->id;
//        $project = Project::find($project_id);
//        $containerId = $request->input('containerId', 'common_popup_modal');
//        $html = view('pages.admin.projects._partial._edit_project_modal', ['id' => $containerId, 'project' => $project])->render();
//        return $this->successResponse('success', ['html' => $html]);
    }
    public function confirmEditProjectModal(Request $request)
    {
        $project_id = $request->id;
        $project = Project::find($project_id);
        $project->name = $request->project_name;
        $project->description =$request->project_description;
        $project->user_id =$request->roles;
        $project->start_date =Carbon::parse($request->date);
        $project->save();
        $projects = Project::with('users')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Project Updated Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);
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
        $project_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.projects._partial._delete_project_modal', ['id' => $containerId, 'project_id' => $project_id])->render();
        return $this->successResponse('success', ['html' => $html]);
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
        $project = Project::find($request->project_id);
        $project->delete();
        $projects = Project::with('users')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Project Added Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);
    }

}
