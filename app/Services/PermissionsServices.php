<?php

namespace App\Services;

use App\Interfaces\PermissionsRepositoryInterface;
use App\Interfaces\PermissionsServicesInterface;

class PermissionsServices implements PermissionsServicesInterface
{

    protected $permissionsRepository;

    public function __construct(PermissionsRepositoryInterface $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function createPermission($details)
    {
        return $this->permissionsRepository->create($details);
    }
    public function getPermissionById($id)
    {
        return $this->permissionsRepository->getById($id);
    }
    public function updatePermissionById($id, $new_details)
    {
        return $this->permissionsRepository->update($id, $new_details);
    }
    public function deletePermissionById($id)
    {
        $this->permissionsRepository->delete($id);
    }

    public function getAllPermissions()
    {
        return $this->permissionsRepository->getAll();
    }

}