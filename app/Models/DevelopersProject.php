<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopersProject extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'user_id'];
    protected $table = 'developers_projects';
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function Project()
    {
        return $this->belongsTo(Project::class);
    }


}
