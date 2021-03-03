<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentProject extends Model
{
    use HasFactory;
    protected $table = 'document_projects';
    protected $fillable = ['project_id', 'path'];
}
