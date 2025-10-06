<?php
namespace App\Models;

use App\Models\BaseModel;

class Role extends BaseModel
{
    public $table = 'roles';
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
