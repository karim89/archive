<?php namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
	public function role()
    {
        return $this->hasMany('App\Models\PermissionRole');
    }
}