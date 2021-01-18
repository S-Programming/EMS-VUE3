<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HistoryLeaveType extends Model
{

    protected $table = 'history_leave_type';
    public $fillable = ['leave_history_id', 'leave_type_id', 'created_at', 'updated_at'];

    public function history()
    {
        return $this->belongsToMany(LeaveHistory::class);
    }
    public function types()
    {
        return $this->belongsToMany(LeaveType::class);
    }
}
