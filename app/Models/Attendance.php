<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'entry_ip', 'entry_time', 'entry_location'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
