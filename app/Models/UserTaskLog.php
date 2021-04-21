<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTaskLog extends Model
{
    use HasFactory;

    protected $table = 'user_task_logs';
    public $fillable = ['user_id', 'checkin_id', 'project_id', 'description', 'time', 'created_at', 'updated_at'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Project()
    {
        return $this->belongsTo(Project::class);
    }
}
