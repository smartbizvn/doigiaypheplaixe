<?php
namespace App\Models;

use App\Models\BaseModel;

class Menu extends BaseModel
{
    public $table = 'menus';
    protected $guarded = [];

    public function children_menus()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('children_menus')->orderBy('order', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class,'parent_id');
    }

    public function getBreadcrumbAttribute(): string
    {
        $names = [];
        $menu = $this;
        while ($menu) {
            array_unshift($names, $menu->name);
            $menu = $menu->parent;
        }
        return implode(' > ', $names);
    }
}
