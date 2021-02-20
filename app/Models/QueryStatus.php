<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryStatus extends Model
{
    use HasFactory;
    public $fillable = ['query_status','created_at','updated_at'];

}
