<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Interfaces\PermissionsServicesInterface;
use App\Interfaces\RolesServicesInterface;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;



class RoleController extends Controller
{
    protected PermissionsServicesInterface $permissionsServices;
    protected RolesServicesInterface $rolesServices;


    public function __construct(PermissionsServicesInterface $permissionsServices, RolesServicesInterface $rolesServices)
    {
        $this->permissionsServices = $permissionsServices;
        $this->rolesServices = $rolesServices;
    }

    public function index()
    {
        $roles = $this->rolesServices->getAllRoles();

        return view('dashboard.roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionsServices->getAllPermissions();
        return view('dashboard.roles.create')->with('permissions', $permissions);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $data = $request->validated();
            $role = $this->rolesServices->createRole($data);
            $this->rolesServices->assignPermissionsToRole($role, $data['permissions']);

            return redirect()->back()
                ->with('status', 'A new role has been added!');
        } catch (\Exception $e) {
            Log::channel('error')->error('Error when creating new role ' . $data->name . ' by user: ' . auth()->user()->username . '\n' . $e);
            return redirect()->back()
                ->with('error', 'Failed to add the role!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->rolesServices->getRoleById($id);
        $permissions = $this->permissionsServices->getAllPermissions();
        $selectedPermissions = $role->permissions->pluck('id')->toArray();

        return view('dashboard.roles.edit', compact('role', 'permissions', 'selectedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $data = $request->validated();

            $role = $this->rolesServices->updateRoleById($role->id, $data);

            $this->rolesServices->assignPermissionsToRole($role, $data['permissions']);

            return redirect()->back()
                ->with('status', 'The role has been updated!');
        } catch (\Exception $e) {
            Log::channel('error')->error('Error when updating role ' . $role->name . ' by user: ' . auth()->user()->username . '\n' . $e);

            return redirect()->back()
                ->with('error', 'Failed to update the role!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $this->rolesServices->deleteRoleById($role->id);

            return redirect()->back()
                ->with('status', 'The role has been deleted!');

        } catch (\Exception $e) {
            Log::channel('error')->error('Error when deleting role ' . $role->name . ' by user: ' . auth()->user()->username . '\n' . $e);

            return redirect()->back()
                ->with('error', 'Failed to delete this role!');
        }
    }
}