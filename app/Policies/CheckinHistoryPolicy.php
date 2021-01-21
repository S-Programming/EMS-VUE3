<?php

namespace App\Policies;

use App\Models\CheckinHistory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use App\Http\Traits\AuthUser;
use App\Http\Enums\RoleUser;

class CheckinHistoryPolicy
{
    use HandlesAuthorization;
    use AuthUser;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CheckinHistory  $checkinHistory
     * @return mixed
     */
    public function view(User $user, CheckinHistory $checkinHistory)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CheckinHistory  $checkinHistory
     * @return mixed
     */
    public function update(User $user, CheckinHistory $checkinHistory)
    {

        $user = $this->getAuthUser();
        if ($user) {
            $userRoles = $this->userRoles();
            if (in_array(RoleUser::SuperAdmin, $userRoles) && in_array(RoleUser::Admin, $userRoles)) {
                return true;
            }
            return false;
        }

        //$admin=$user->roles()->where('role_id','2')->get()->isEmpty();

        /*if(!$user->roles()->where('role_id','2')->get()->isEmpty())
        {
            return true ;
        }

            return false;*/
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CheckinHistory  $checkinHistory
     * @return mixed
     */
    public function delete(User $user, CheckinHistory $checkinHistory)
    {
        //
        $user = $this->getAuthUser();
        if ($user) {
            $userRoles = $this->userRoles();
            if (!in_array(RoleUser::SuperAdmin, $userRoles) && !in_array(RoleUser::Admin, $userRoles)) {
                return false;
            }
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CheckinHistory  $checkinHistory
     * @return mixed
     */
    public function restore(User $user, CheckinHistory $checkinHistory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CheckinHistory  $checkinHistory
     * @return mixed
     */
    public function forceDelete(User $user, CheckinHistory $checkinHistory)
    {
        //
    }
}
