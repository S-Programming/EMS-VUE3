<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait AuthUser
{
    protected $data = null;

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
        $user = Auth::check() ? Auth::user() : null;
        return $this->data['auth_user'] = $user ?? null;
    }

    public function getAuthUserId()
    {
        $user = $this->getAuthUser();
        return $this->data['user_id'] = $user->id ?? 0;
    }
}
