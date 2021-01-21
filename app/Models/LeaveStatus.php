<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class LeaveStatus extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'leave_status';
    public $fillable = [
        'status',
    ];

    /**
     * A user can have many vendor profile answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
}
