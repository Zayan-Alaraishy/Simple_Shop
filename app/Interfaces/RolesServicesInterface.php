<?php

namespace App\Interfaces;

interface RolesServicesInterface
{

    public function getAllRoles();
    public function createRole($details);
    public function getRoleById($id);
    public function updateRoleById($id, $new_details);
    public function deleteRoleById($id);
    public function assignPermissionsToRole($role, $permissions);
}