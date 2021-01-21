<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use App\Http\Enums\RoleUser;

trait AuthUser
{
    protected $authUserData = null;

    public function authUserToken($user)
    {
        return intval($user->id) > 0 ? $user->createToken($this->authTokenKey())->plainTextToken : null;
    }

    public function authTokenKey()
    {
        return "aloexpo-token";
    }
    public function setAuthUserId($user = null)
    {
        $this->authUserData['auth_user'] = $user;
    }
    public function getAuthUser()
    {
        return $this->authUserData['auth_user'] = (isset($this->authUserData['auth_user']) && $this->authUserData['auth_user'] != null) ? $this->authUserData['auth_user'] : (Auth::check() ? Auth::user() : null);
    }

    public function getAuthUserId()
    {
        $user = $this->getAuthUser();
        return $user->id ?? 0;
    }

    public function isUserCheckin()
    {
        $user = $this->getAuthUser();
        $userLastCheckinRecord = $user ? $user->lastCheckin() : null;
        return !is_null($userLastCheckinRecord) && is_null($userLastCheckinRecord->checkout);
    }

    public function userLastCheckinTime()
    {
        $user = $this->getAuthUser();
        $userLastCheckinRecord = $user ? $user->lastCheckin() : null;
        return (!is_null($userLastCheckinRecord) && !is_null($userLastCheckinRecord->checkin)) ? $userLastCheckinRecord->checkin : null;
    }

    public function userRoles()
    {
        $user = $this->getAuthUser();
        $userRoles = $user ? $user->roles : null;
        return $userRoles ? (array_column($userRoles->toArray(), 'id')) : [];
    }
    public function hasRoleAccess($role = '')
    {

        $hasAccess = false;
        if ($role != '') {
            $user = $this->getAuthUser();
            if ($user) {
                $userRoles = $this->userRoles();
                $hasAccess = (in_array($role, $userRoles)) ? true : false;
            }
            return $hasAccess;
        }
    }
    public function isSuperAdminRole()
    {
        return $this->hasRoleAccess(RoleUser::SuperAdmin);
    }
    public function isAdminRole()
    {
        return $this->hasRoleAccess(RoleUser::Admin);
    }
    public function isDeveloperRole()
    {
        return $this->hasRoleAccess(RoleUser::Developer);
    }
}
