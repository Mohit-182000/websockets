<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $table = 'permissions';

	public $timestamps = false;
	
	protected $fillable = [
		'name',
		'slug'
	];

	public function roles() {
		return $this->belongsToMany(Role::class,'roles_permissions');
	}

	public function users() {
	   return $this->belongsToMany(User::class,'users_permissions');
	}
}
