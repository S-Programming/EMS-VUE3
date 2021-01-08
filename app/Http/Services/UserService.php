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
                $users = User::updateOrCreate([
                    'id' => $request->id,
                ],[
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => bcrypt('12345678')
                ]);
                $user_id = $users->id;
                $role = new Role;
                $role->name = "User";
                $role->route = "/user";
                $role->save();
                $role_id = $role->id;
                $roleuser = new RoleUser;
                $roleuser->user_id = $user_id;
                $roleuser->role_id = $role_id;
                $roleuser->save();
                $users = User::all();
            }
            $html = view('pages.user._partial._datatable_html',compact('users',$users))->render();
            return $this->successResponse('User has Successfully Added', ['html' => $html, 'html_section_id' => 'userlist-section']);
    }
}
