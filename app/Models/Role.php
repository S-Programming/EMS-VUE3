<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    public $fillable = ['name'];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function roleMenu()
    {
        return $this->belongsToMany(Menu::class);
    }

}
