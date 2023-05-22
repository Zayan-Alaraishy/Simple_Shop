<?php

namespace App\Http\Controllers\Dashboard;

use App\Services\PermissionsServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;

class PermissionController extends Controller
{

    protected $permissionsServices;


    /**
     * PermissionsController Constructor
     *
     * @param PermissionsServices $permissionsServices
     *
     */
    public function __construct(PermissionsServices $permissionsServices)
    {
        $this->permissionsServices = $permissionsServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->permissionsServices->getAllPermissions();

        return view('dashboard.permissions.index', compact('permissions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        try {
            $this->permissionsServices->createPermission($request->validated());

            return redirect()->back()
                ->with('status', 'A new permission has been added!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add the permission!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = $this->permissionsServices->getPermissionById($id);

        return view('dashboard.permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        try {
            $this->permissionsServices->updatePermissionById($permission->id, $request->validated());

            return redirect()->back()
                ->with('status', 'The permission has been updated!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update the permission!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            $this->permissionsServices->deletePermissionById($permission->id);

            return redirect()->back()
                ->with('status', 'The permission has been deleted!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete this permission!');
        }
    }
}