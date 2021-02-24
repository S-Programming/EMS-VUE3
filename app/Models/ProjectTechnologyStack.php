<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTechnologyStack extends Model
{
    use HasFactory;

    protected $table = 'project_technology_stack';
    public $fillable = ['project_id', 'technology_stack_id', 'created_at', 'updated_at'];

    public function Project()
    {
        return $this->belongsTo(Project::class);
    }

    public function TechnologyStack()
    {
        return $this->belongsTo(TechnologyStack::class);
    }
}
