<?php

namespace App\Interfaces;

interface RolesRepositoryInterface
{
    public function getAll();

    public function getById($roleId);
    public function create(array $details);
    public function update($roleId, array $newDetails);
    public function delete($roleId);
    public function assignPermissionsToRole($role, $permissions);
}