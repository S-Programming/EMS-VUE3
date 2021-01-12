<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    public $fillable = [
        'id',
        'name',
        'is_parent_menu',
        'parent_menu_id',
        'link',
        'module',
        'sort_order',
        'class',
        'icon',
        'is_count',
        'is_active'
    ];

    public function menusRole()
    {
        return $this->belongsToMany(Role::class);
    }

}