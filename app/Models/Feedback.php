<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    public $fillable = ['first_name','last_name','email','topic','description','rate_status','created_at','updated_at'];

}
