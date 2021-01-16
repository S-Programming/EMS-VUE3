<?php


namespace App\Http\Services;

use App\Http\Enums\RoleUser;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckinHistory;
use Illuminate\Http\Request;
use App\Http\Services\BaseService\BaseService;


class DashboardService extends BaseService
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getDashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user) {
                $userRoles =$this->userRoles();
                if(in_array(RoleUser::SuperAdmin,$userRoles)){

                }




                switch ($roleId) {
                    case RoleUser::SuperAdmin:
                        return view('admin.index');
                    case RoleUser::Admin:
                        return view('admin.index');
                }
            }
        }
    }
}
