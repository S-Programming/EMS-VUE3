<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\Menu;
use App\Models\MenuRole;
use App\Models\CheckinHistory;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Attendence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function userReportHistory(Request $request)
    {
        $userId = $this->getAuthUserId();
        $filters = ($userId > 0) ? [['user_id', '=', $userId]] : [];
        $date_filters = historyDateFilter($request->history_report);
        $filters = array_merge($date_filters, $filters);
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
            $user->roles()->sync($request->roles); // for pivot data
            $user->save();

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

            $user_id = $this->getAuthUserId();
            $user_data = User::find($user_id);
            $user_data->first_name = $request->first_name;
            $user_data->last_name = $request->last_name;
            $user_data->email = $request->email;
            $user_data->phone_number = $request->phone_number;
            //$user_data->password = bcrypt($request->password);

            // $image = new Image;
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $file_name = $file->getClientOriginalName();
                $destinationPath = 'uploads';
                $file_path = $destinationPath . "/" . $file_name;
                $file->move($destinationPath, $file->getClientOriginalName());
                dd($file_path);
                //$image->title = $request->product_image_title;
                //$image->description = $request->image_description;
                $user_data->image_path = $file_path;
                // $image_result = $image->save();
            }

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

}
