<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $fillable = ['name','description','start_date','user_id','created_at','updated_at'];
    protected $table = 'projects';
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
