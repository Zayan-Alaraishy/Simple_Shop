<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreUserWithRoleRequest;
use App\Http\Requests\UpdateAssignedUserRequest;
use App\Models\Role;
use App\Services\RolesServices;
use App\Services\UserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;


class UsersRolesController extends Controller
{
    protected $userServices;
    protected $rolesServices;


    public function __construct(UserServices $userServices, RolesServices $rolesServices)
    {
        $this->userServices = $userServices;
        $this->rolesServices = $rolesServices;
    }


    public function index()
    {
        $users = $this->userServices->getUsersAssignedToRoles();
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->rolesServices->getAllRoles();

        return view('dashboard.users.create', compact('roles'));
    }
    public function store(StoreUserWithRoleRequest $request)
    {
        try {
            $this->userServices->createUserWithRole($request->validated());
            return redirect()->back()->with('status', 'New user successfully assigned to a role!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to assign new user to a role!');
        }
    }

    public function edit(User $user)
    {
        $roles = $this->rolesServices->getAllRoles();
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateAssignedUserRequest $request, User $user)
    {

        try {
            $user = $this->userServices->updateAssignedUser($user, $request->validated());
            return redirect()->back()->with(['status' => 'User data updated successfully!', 'selected_role' => $user['role']]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update this user data!');
        }


    }
    public function destroy(string $id)
    {
        try {
            $this->userServices->deleteUser($id);
            return back()->with('status', 'User deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete this user!');
        }
    }

}