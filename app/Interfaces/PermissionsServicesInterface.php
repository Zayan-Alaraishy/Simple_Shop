<?php

namespace App\Interfaces;

interface PermissionsServicesInterface
{

    public function getAllPermissions();
    public function createPermission($details);
    public function getPermissionById($id);
    public function updatePermissionById($id, $new_details);
    public function deletePermissionById($id);
    public function getSelectedPermissions($role);
}