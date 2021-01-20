<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveHistory extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'leave_history';
    public $fillable = [
        'user_id',
        'leave_type_id',
        'date',
        'status',
        'description',
    ];

    /**
     * A user can have many vendor profile answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    /**
     * Leave Type Relation it will retuen the all leave assigned type
     *
     * @return bool
     */


    public function type(){
        return $this->belongsTo(LeaveType::class,'leave_type_id','id');
    }

/**
     * Leave Type Relation it will retuen the all leave assigned user
     *
     * @return bool
     */


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
