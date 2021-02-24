<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $fillable = ['name','description','start_date','user_id','created_at','updated_at'];
    protected $table = 'projects';
    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }

    // public function technology()
    // {
    //     return $this->belongsToMany(TechnologyStack::class);
    // }

    public function technology()
    {
        return $this->belongsToMany(TechnologyStack::class);
    }
}
