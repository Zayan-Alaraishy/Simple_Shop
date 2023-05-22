<?php
namespace App\Repositories;

use App\Models\Permission;

use App\Interfaces\PermissionsRepositoryInterface;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class PermissionsRepository implements PermissionsRepositoryInterface
{
    /**
     * @var Permission
     */
    protected $permission;

    /**
     * PermissionsRepository constructor.
     *
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getById($id)
    {
        $permission = new $this->permission;
        return $permission->findOrFail($id);
    }

    public function create($details)
    {
        return Permission::create($details);
    }

    public function update($id, $new_details)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return null;
        }

        $permission->update($new_details);

        return $permission;
    }

    public function delete($id)
    {
        $permission = $this->permission->find($id);
        $permission->delete();
    }

    public function getAll()
    {
        return Permission::all();
    }

}