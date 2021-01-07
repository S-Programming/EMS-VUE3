<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

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

    public function getAuthUser()
    {
        return $this->authUserData['auth_user'] = isset($this->authUserData['auth_user']) ? $this->authUserData['auth_user'] : (Auth::check() ? Auth::user() : null);
    }

    public function getAuthUserId()
    {
        $user = $this->getAuthUser();
        return $user->id ?? 0;
    }
    public function isUserCheckin()
    {
        $user = $this->getAuthUser();
        $userLastCheckinRecord=$user->lastCheckin();
        return !is_null($userLastCheckinRecord) && is_null($userLastCheckinRecord->checkout);
    }
}
