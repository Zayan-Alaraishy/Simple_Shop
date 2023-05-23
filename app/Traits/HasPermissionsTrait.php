<?php
namespace App\Traits;

use App\Models\Permission;


trait HasPermissionsTrait
{
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;

    }

    public function hasRole(...$roles)
    {

        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;

    }

}