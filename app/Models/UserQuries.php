<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuries extends Model
{
    use HasFactory;
    public $fillable = ['query_status_id','topic','description','status','created_at','updated_at'];
    protected $table = 'feedback';
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
