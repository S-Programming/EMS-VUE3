<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInteraction extends Model
{
    use HasFactory;
    protected $table = 'user_interactions';
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
