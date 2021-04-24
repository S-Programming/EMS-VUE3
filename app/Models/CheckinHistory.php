<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckinHistory extends Model
{
    use HasFactory;

    protected $table = 'checkin_history';

    public function Tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
