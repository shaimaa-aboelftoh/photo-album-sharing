<?php

namespace App\Entrust;

use Zizaco\Entrust\EntrustRole;

class RolePermissions extends EntrustRole
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'permission_role';
    protected $fillable = ['role_id', 'permission_id'];
}