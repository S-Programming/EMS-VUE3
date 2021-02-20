<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    public $fillable = ['topic','description','status','created_at','updated_at'];
    protected $table = 'feedback';
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
