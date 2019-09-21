<?php

namespace App\Entrust;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = ['user_id', 'role_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function role()
    {
        return $this->BelongsTo('App\Entrust\Role');
    }
}
