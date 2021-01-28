<?php

namespace App\Http\Traits;

use App\Models\User;

trait UserTrait
{
    public function getAllUsers()
    {
        return User::all();
    }
}
