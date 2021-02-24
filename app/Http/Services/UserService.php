<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\Menu;
use App\Models\MenuRole;
use App\Models\CheckinHistory;
use App\Models\Project;
use App\Models\QueryStatus;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Attendence;
use App\Models\ProjectDocument;
use App\Models\UserInteraction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function storeCSV($request = null)
    {
        if (isset($_FILES['csv_file']['name']) && !empty($_FILES['csv_file']['name'])) {
            $date = date('d-m-Y');
            $csv = $date . "_" . $_FILES['csv_file']['name'];
            // $csv = mt_rand(100000, 999999) . $_FILES['csv_file']['name'];
            $file = $request->file('csv_file');
            $destinationPath = 'uploads';
            $file->move($destinationPath, $csv);
            $file_data = fopen(public_path('uploads/' . $csv), 'r');
            $no_of_rows = 0;
            if (($fp = fopen(public_path('uploads/' . $csv), 'r')) !== FALSE) {
                while (($record = fgetcsv($fp)) !== FALSE) {
                    $no_of_rows++;
                }
            }
            while ($row = fgetcsv($file_data)) {
                if ($row[0] != 'first_name') {
                    $user_count = User::where('email', $row[2])->count();
                    if ($user_count == 0) {
                        //$user_uuid = uniqid('csv', true);
                        //$user_id_array[]['user_id'] = $user_uuid;
                        $user[] = array(
                            // 'id' => $user_uuid,
                            'first_name' => $row[0],
                            'last_name' => $row[1],
                            'email' => $row[2],
                            'phone_number' => $row[3],
                            'password' => bcrypt(generate_random_string(16))
                        );
                    } else {
                        $no_of_rows--;
                    }
                }
            }
            if (!isset($user)) return false;
            User::insert($user);
            return $this->success('CSV file save successfully', ['data' => $user]);
        }
    }
    public function userReportHistory(Request $request)
    {
        $userId = $this->getAuthUserId();

        $filters = ($userId > 0) ? [['user_id', '=', $userId]] : [];
        // dd($filters);
        $date_filters = historyDateFilter($request->history_report);
        // dd($date_filters);
        $filters = array_merge($date_filters, $filters);
        //dd($filters);
        $checkinHistoryData = CheckinHistory::where($filters)->get();
        $count = $checkinHistoryData->count();
        $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $checkinHistoryData, 'totalCheckins' => $count])->render();
        if ($count > 0) {
            return $this->successResponse('Record Found successfully', ['html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
        } else {
            return $this->errorResponse('Record Not Found', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
        }
    }

    public function confirmAdduser(Request $request)
    {
        ## DB operations
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('User Submittion Failed');
        }
        if (isset($request) && !empty($request)) {

            $user = User::updateOrCreate([
                'id' => $request->id,
            ], [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt('12345678'),
                'phone_number' => $request->phone_number,

            ]);

            //$user_id = $user->id; // last insert id of user
            $user->save();
            $user->roles()->sync($request->roles); // for pivot data
        }
        $html = view('pages.user._partial._users_list_table_html', ['users' => $this->getAllUsers()])->render();
        return $this->successResponse('User has Successfully Added', ['html' => $html, 'html_section_id' => 'userlist-section']);
    }

    public function userModal(Request $request)
    {
        $user_id = $request->id;
        $user_data = User::with('roles')->find($user_id);
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
        $rolesDropDown = view('utils.roles', ['roles' => ($roles ?? null), 'user_roles' => $userRoles])->render();
        $html = view('pages.user._partial._add_user_modal', ['id' => $containerId, 'data' => null, 'roles_dropdown' => $rolesDropDown, 'user_data' => $user_data])->render();

        return $this->successResponse('success', ['html' => $html]);
    }

    public function userDeleteModal(Request $request)
    {
        $user_id = $request->id;
        //        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        // $role_data=Role::find($user_id);
        $html = view('pages.user._partial._delete_user_modal', ['id' => $containerId, 'user_id' => $user_id])->render();

        return $this->successResponse('success', ['html' => $html]);
    }


    public function confirmDeleteUser(Request $request)
    {
        $login_id = $this->getAuthUserId();
        $user_id = $request->user_id;
        if ($user_id == $login_id) {
            return $this->errorResponse('Authorization Required', ['errors' => ['You dont have Authorization to Delete this Account']]);
        }

        $user_data = User::find($user_id);
        $user_data->delete();

        $html = view('pages.user._partial._users_list_table_html', ['users' => $this->getAllUsers()])->render();
        return $this->successResponse('User is Successfully Deleted', ['html' => $html, 'html_section_id' => 'userlist-section']);
    }

    public function userUpdateProfile(Request $request)
    {

        if (isset($request) && !empty($request)) {

           // dd($request->all());
            $user_id = $this->getAuthUserId();
            $user_data = User::find($user_id);
            $user_data->first_name = $request->first_name;
            $user_data->last_name = $request->last_name;
            $user_data->email = $request->email;
            $user_data->phone_number = $request->phone_number;

            $user_data->image_path = $request->image_file;
            //$user_data->password = bcrypt($request->password);

            // $image = new Image;
            /*if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $file_name = $file->getClientOriginalName();
                $destinationPath = 'uploads';
                $file_path = $destinationPath . "/" . $file_name;
                $file->move($destinationPath, $file->getClientOriginalName());
                //dd($file_path);
                //$image->title = $request->product_image_title;
                //$image->description = $request->image_description;
                $user_data->image_path = $file_path;
                // $image_result = $image->save();
            }*/

            $user_data->save();
            return $this->successResponse('Profile is Successfully Updated');
        } else {

            return $this->errorResponse('Profile Updation Failed');
        }
    }

    public function userUpdatePassword(Request $request)
    {

        if (isset($request) && !empty($request)) {
            $user_id = $this->getAuthUserId();
            $user_data = User::find($user_id);
            $db_password = $user_data->password;
            $current_password = $request->current_password;
            if (Hash::check($current_password, $db_password)) {
                $new_password = $request->new_password;
                $confirm_password = $request->confirm_password;
                if ($current_password != $new_password) {
                    if ($new_password == $confirm_password) {
                        $user_data->password = bcrypt($new_password);
                        $user_data->save();
                        return $this->successResponse('Password is Successfully Updated');
                    } else {
                        return $this->errorResponse('New Password and Confirm Password Not Match', ['errors' => ['New Password and Confirm Password Not Match']]);
                    }
                } else {
                    return $this->errorResponse('New Password and Current Password Does not Same', ['errors' => ['New Password and Current Password Does not Same']]);
                }
            } else {
                return $this->errorResponse('Current Password is not correct', ['errors' => ['Current Password is not correct']]);
            }
        }
    }

    public function confirmAddUserInteractionModal(Request $request)
    {
        $user = User::find($this->getAuthUserId());
        $user_name = $user->first_name;
        $user_data = User::find($request->user_id);
        $userInteraction = new UserInteraction;
        $userInteraction->staff_id = $this->getAuthUserId();
        $userInteraction->user_id = $request->user_id;
        $userInteraction->description = $request->discussion_point;
        $userInteraction->date = Carbon::parse($request->date)??'';
        //dd($userInteraction->date);
        $userInteraction->save();
        $userInteractions = UserInteraction::where('user_id',$request->user_id)->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin._partial._users_interactions_list_table_html',['userInteractions' => $userInteractions,'user_name'=>$user_name,'user_id'=>$userInteraction->user_id])->render();
//        return $this->successResponse('success',['html' => $html,'user_data' => $user_data,'userInteractions' => $userInteractions,'user_id'=>$userInteraction->user_id]);
        return $this->successResponse('success',['html' => $html,'html_section_id' => 'userlist-section' ]);
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
        $html = view('pages.engagementManager._partial._add_project_manager_modal', ['id' => $containerId, 'data' => null, 'roles_dropdown' => $rolesDropDown])->render();
        return $this->successResponse('success', ['html' => $html]);
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
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt('12345678');

        $user->save();
        $user->roles()->attach(['role_id'=>$request->roles]);
//        $user_id = $user->id;
//        $user->roles()->attach(['user_id' => $user_id, 'role_id' => $request->roles]);
//        $role_user = new RoleUser;
//        $role_user->user_id = $user_id;
//        $role_user->role_id = $request->roles;
//        $role_user->save();

        $project_managers = RoleUser::with('user')->where('role_id',4)->get();
        $html = view('pages.engagementManager._partial._project_manager_list_table_html',['project_managers'=>$project_managers])->render();
        return $this->successResponse('success', ['html' => $html,'html_section_id'=> 'project-manager-list-section']);
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
        $user_id = $request->id;
        $user_data = User::with('roles')->find($user_id);
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
        $rolesDropDown = view('utils.roles', ['roles' => ($roles ?? null), 'user_roles' => $userRoles])->render();
        $html = view('pages.engagementManager._partial._edit_project_manager_modal', ['id' => $containerId, 'data' => null, 'roles_dropdown' => $rolesDropDown, 'user_data' => $user_data])->render();

        return $this->successResponse('success', ['html' => $html]);
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
        $user = User::find($request->id);
        $user->first_name =$request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();
        $project_managers = RoleUser::with('user')->where('role_id',4)->get();
        $html = view('pages.engagementManager._partial._project_manager_list_table_html',['project_managers'=>$project_managers])->render();
        return $this->successResponse('success', ['html' => $html,'html_section_id'=> 'project-manager-list-section']);
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
        $project_manager_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.engagementManager._partial._delete_project_manager_modal', ['id' => $containerId, 'project_manager_id' => $project_manager_id])->render();
        return $this->successResponse('success', ['html' => $html]);
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
        $user_id = $request->project_manager_id;
        $user = User::find($user_id);
        $user->delete();
        $project_managers = RoleUser::with('user')->where('role_id',4)->get();
        $html = view('pages.engagementManager._partial._project_manager_list_table_html', ['project_managers'=>$project_managers])->render();
        return $this->successResponse('Project Manager Deleted Successfully', ['html'=>$html,'html_section_id'=> 'project-manager-list-section']);
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
        $project_managers = RoleUser::with('user')->where('role_id',4)->get();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $projectManagersDropDown = view('utils.project_managers_dropdown', ['project_managers' => $project_managers])->render();
        $html = view('pages.admin.projects._partial._add_project_modal', ['id' => $containerId, 'data' => null, 'project_managers_dropdown' => $projectManagersDropDown])->render();
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
        $project->user_id =$request->project_manager_id;
        $project->start_date =Carbon::parse($request->date);
        $project->save();
        $project_id = $project->id;
        $file = $request->file('project_document');
        $file_name = $file->getClientOriginalName();
        $destinationPath = 'uploads/files';
        $file_path = $destinationPath . "/" . $file_name;
        $file->move($destinationPath, $file->getClientOriginalName());
        $project_document = new ProjectDocument();
        $project_document->path = $file_name;
        $project_document->project_id = $project_id;
        $project_document->save();
        $projects = Project::with('users')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Project Added Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);
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
        $project_id = $request->id;
        $project = Project::find($project_id);
        $project_manager_id = $project->user_id;
        $project_managers = RoleUser::with('user')->where('role_id',4)->get();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $projectManagersDropDown = view('utils.project_managers_dropdown', ['project_managers' => $project_managers,'project_manager_id'=>$project_manager_id])->render();
        $html = view('pages.admin.projects._partial._edit_project_modal', ['id' => $containerId, 'data' => null, 'project_managers_dropdown' => $projectManagersDropDown,'project'=>$project])->render();
        return $this->successResponse('success', ['html' => $html]);
//        $project_id = $request->id;
//        $project = Project::find($project_id);
//        $containerId = $request->input('containerId', 'common_popup_modal');
//        $html = view('pages.admin.projects._partial._edit_project_modal', ['id' => $containerId, 'project' => $project])->render();
//        return $this->successResponse('success', ['html' => $html]);
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
        $project_id = $request->id;
        $project = Project::find($project_id);
        $project->name = $request->project_name;
        $project->description =$request->project_description;
        $project->user_id =$request->project_manager_id;
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
