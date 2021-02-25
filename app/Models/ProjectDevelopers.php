<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDevelopers extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'user_id'];
    protected $table = 'project_developers';
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
