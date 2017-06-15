<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	public function permission()
    {
        return $this->hasMany('App\Models\PermissionRole');
    }
    
    public function user()
    {
        return $this->hasMany('App\Models\RoleUser');
    }
}