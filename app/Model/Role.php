<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';
	
	public $timestamps = false;

	public function permissions() {
		return $this->belongsToMany(Permission::class,'roles_permissions');
	}

	public function users() {
	   return $this->belongsToMany(User::class,'users_roles');
	}
}
