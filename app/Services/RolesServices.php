<?php

namespace App\Services;

use App\Interfaces\RolesRepositoryInterface;
use App\Interfaces\RolesServicesInterface;

class RolesServices implements RolesServicesInterface
{

    protected $rolesRepository;

    public function __construct(RolesRepositoryInterface $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public function createRole($details)
    {
        return $this->rolesRepository->create($details);
    }
    public function getRoleById($id)
    {
        return $this->rolesRepository->getById($id);
    }
    public function updateRoleById($id, $new_details)
    {

        return $this->rolesRepository->update($id, $new_details);
    }
    public function deleteRoleById($id)
    {
        $this->rolesRepository->delete($id);
    }

    public function getAllRoles()
    {
        return $this->rolesRepository->getAll();
    }
    public function assignPermissionsToRole($role, $permissions)
    {
        return $this->rolesRepository->assignPermissionsToRole($role, $permissions);
    }

}