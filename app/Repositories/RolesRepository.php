<?php
namespace App\Repositories;

use App\Models\Role;
use App\Interfaces\RolesRepositoryInterface;

class RolesRepository implements RolesRepositoryInterface
{
    /**
     * @var Role
     */
    protected $role;

    /**
     * RolesRepository constructor.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getById($id)
    {
        return Role::findOrFail($id);
    }

    public function create($details)
    {
        return Role::create($details);
    }

    public function update($id, $new_details)
    {
        $role = Role::find($id);

        if (!$role) {
            return null;
        }

        $role->update($new_details);

        return $role;
    }

    public function delete($id)
    {
        $role = $this->role->find($id);
        $role->delete();
    }

    public function getAll()
    {
        return Role::all();
    }

    public function assignPermissionsToRole($role, $permissions)
    {
        return $role->permissions()->sync($permissions);
    }

}