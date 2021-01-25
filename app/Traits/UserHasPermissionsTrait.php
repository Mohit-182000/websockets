<?php
namespace App\Traits;

use App\Model\Permission;
use App\Model\Role;

trait UserHasPermissionsTrait {

	public function hasPermissionTo($permission) {
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
		// return $this->hasPermissionThroughRole($permission) ;
	}

	public function hasPermissionThroughRole($permission) {
		// dd($permission->roles);

		foreach ($permission->roles as $role){
			if($this->roles->contains($role)) {
				return true;
			}
		}
		return false;
	}

	public function hasRole( ... $roles ) {

		foreach ($roles as $role) {
			if ($this->roles->contains('slug', $role)) {
				return true;
			}
		}
		return false;
	}

	public function roles() {
		return $this->belongsToMany(Role::class,'admin_role','admin_id' ,'role_id' );
	}

	public function permissions() {
		return $this->belongsToMany(Permission::class,'admin_permission' ,'admin_id' ,'permission_id');
	}

	protected function hasPermission($permission) {
		return (bool) $this->permissions->where('slug', $permission->slug)->count();
	}

	protected function getAllPermissions(array $permissions) {
		return Permission::whereIn('slug',$permissions)->get();
    }

}
