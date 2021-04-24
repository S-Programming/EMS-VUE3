<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    public $fillable = ['name'];

    public function CheckinHistory()
    {
        return $this->belongsToMany(CheckinHistory::class);
    }
}
