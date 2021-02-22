<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuries extends Model
{
    use HasFactory;
    public $fillable = ['query_status_id','topic','description','comment','is_view','created_at','updated_at'];
    protected $table = 'user_quries';
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function query_statuses(){
        return $this->belongsTo(QueryStatus::class,'query_status_id','id');
    }
}
