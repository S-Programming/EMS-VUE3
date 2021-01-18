<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class LeaveService extends BaseService
{
    public function confirmAddRole(Request $request)
    {
        ## DB operations
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('User Submittion Failed');
        }
        if (isset($request) && !empty($request)) {

            $role = Role::updateOrCreate([
                'id' => $request->id,
            ], [
                'name' => $request->role
            ]);
            $role->route = '/dashboard';
            // $role_id = $role->id;
            // $role->$request->roles;
            $role->save();
            /*            $roleuser = new RoleUser;
                        $roleuser->user_id = $user_id;
                        $roleuser->role_id = $request->roles;
                        $roleuser->save();*/
            $roles = Role::all();
        }
        $html = view('pages.role._partial._datatable_html', compact('roles', $roles))->render();
        return $this->successResponse('Role has Successfully Added', ['html' => $html, 'html_section_id' => 'userlist-section']);
    }

    public function roleModal(Request $request)
    {
        $role_id = $request->id;
        $role_data = Role::find($role_id);
//        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        // $roles = Role::all();
        // $userRoles = [];
        // if (isset($role_data->roles) && !empty($role_data->roles)) {
        //     foreach ($role_data->roles as $role) {
        //         if ($role->id > 0) {
        //             $userRoles[$role->id] = $role->id;
        //         }
        //     }
        // }
        // $rolesDropDown = view('utils.roles', ['roles' => ($roles ?? null), 'user_roles' => $userRoles])->render();
        $html = view('pages.role._partial._addrole_modal', ['id' => $containerId, 'data' => null, 'role_data' => $role_data])->render();

        return $this->successResponse('success', ['html' => $html]);
    }

    public function roleDeleteModal(Request $request)
    {
        $role_id = $request->id;
//        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        // $role_data=Role::find($user_id);
        $html = view('pages.role._partial._delete_role_modal', ['id' => $containerId, 'role_id' => $role_id])->render();

        return $this->successResponse('success', ['html' => $html]);
    }

    public function confirmDeleteRole(Request $request)
    {
        $login_id = $this->getAuthUserId();
        $role_id = $request->id;
        if ($role_id == $login_id) {
            return $this->errorResponse('You dont have Authorization to Delete this Role');
        }

        $role_data = Role::find($role_id);
        $role_data->delete();
        $roles = Role::all();
        $html = view('pages.role._partial._datatable_html', compact('roles', $roles))->render();
        return $this->successResponse('Role is Successfully Deleted', ['html' => $html]);
    }
}
