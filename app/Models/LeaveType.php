<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class LeaveType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'leave_type';
    public $fillable = [
        'type',
    ];

    /**
     * A user can have many vendor profile answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    /**
     * User Roles Relation it will retuen the all user assigned roles
     *
     * @return bool
     */
    public function history()
    {
        return $this->hasMany(LeaveHistory::class);
    }
    // public function history()
    // {
    //     return $this->hasMany(HistoryLeave::class,'leave_type_id','id');
    // }

}
