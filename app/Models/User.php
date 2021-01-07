<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user can have many vendor profile answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkinHistory() {

        return $this->hasMany(CheckinHistory::class);
    }
    /**
     * Return true if user can impersonate another user. Currently, only user
     * with the role 'app_admin' can impersonate another user.
     *
     * @return bool
     */
    public function lastCheckin() {

        return $this->checkinHistory()->latest()->first();
    }

}
