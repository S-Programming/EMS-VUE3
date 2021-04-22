<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckinHistoryTag extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'created_at', 'updated_at'];
    protected $table = 'checkin_history_tags';
}
