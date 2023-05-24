<x-layout>
    <style>
        .content {
            padding: 20px;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .tab-content {
            margin-top: 20px;
        }
    </style>
    <div class="content">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard/users">Users</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="/dashboard/roles">Roles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/dashboard/permissions">Permissions</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="users" class="tab-pane fade ">
                <h3>Users</h3>
                <!-- User List -->
                <!-- Display the list of existing users -->
            </div>

            <div id="roles" class="tab-pane fade show active">
                <div>
                    <a href="/dashboard/users/create" class="btn btn-primary">+ Assign
                        User</a>
                </div>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role(s)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge badge-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="/dashboard/users/{{ $user->id }}/edit"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="/dashboard/users/{{ $user->id }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="permissions" class="tab-pane fade">
                <div>
                    <a href="/dashboard/permissions/create" class="btn btn-primary">Create
                        Permission</a>
                </div>

                <!-- Permission List -->
                <!-- Display the list of existing permissions -->
            </div>
        </div>
    </div>
</x-layout>
