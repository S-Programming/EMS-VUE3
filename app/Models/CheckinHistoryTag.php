<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckinHistoryTag extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'checkin_id', 'created_at', 'updated_at'];
    protected $table = 'checkin_history_tag';

    public function CheckinHistory()
    {
        return $this->belongsTo(CheckinHistory::class);
    }

    public function Tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
