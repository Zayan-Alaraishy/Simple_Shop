<?php

namespace App\Interfaces;

interface PermissionsRepositoryInterface
{
    public function getAll();

    public function getById($permissionId);
    public function create(array $details);
    public function update($id, array $newDetails);
    public function delete($id);
    public function getSelectedPermissions($role);

}