<?php
namespace App\Models;

use App\Models\BaseModel;

class Permission extends BaseModel
{
    public $table = 'permissions';
    protected $guarded = [];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
