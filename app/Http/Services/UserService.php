<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class UserService extends BaseService
{
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
                'phone_number' => $request->phone_number,
                'password' => bcrypt('12345678')
            ]);

            $user_id = $user->id;
            $user->roles()->sync($request->roles);
            $user->save();
            /*            $roleuser = new RoleUser;
                        $roleuser->user_id = $user_id;
                        $roleuser->role_id = $request->roles;
                        $roleuser->save();*/
            $users = User::all();
        }
        $html = view('pages.user._partial._datatable_html', compact('users', $users))->render();
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
        $html = view('pages.user._partial._adduser_modal', ['id' => $containerId, 'data' => null, 'roles_dropdown' => $rolesDropDown, 'user_data' => $user_data])->render();

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
        $user_id = $request->id;
        if ($user_id == $login_id) {
            return $this->errorResponse('You dont have Authorization to Delete this Account');
        }

        $user_data = User::find($user_id);
        $user_data->delete();
        $users = User::all();
        $html = view('pages.user._partial._datatable_html', compact('users', $users))->render();
        return $this->successResponse('User is Successfully Deleted', ['html' => $html]);
    }
}
