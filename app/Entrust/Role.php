<?php

namespace App\Entrust;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $fillable = ['name', 'display_name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany('App\Entrust\Permission');
    }

    public function RolePermissions()
    {
        return $this->hasMany('App\Entrust\RolePermissions', 'role_id');
    }
}
