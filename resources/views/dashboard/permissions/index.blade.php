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
        <h1>Dashboard</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="/dashboard/users">Users</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/dashboard/roles">Roles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard/permissions">Permissions</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="users" class="tab-pane fade ">
                <h3>Users</h3>
                <!-- User List -->
                <!-- Display the list of existing users -->
            </div>

            <div id="roles" class="tab-pane fade">
                <h3>Roles</h3>
                <!-- Role List -->
                <!-- Display the list of existing roles -->
            </div>

            <div id="permissions" class="tab-pane fade show active">
                <div>
                    <a href="/dashboard/permissions/create" class="btn btn-primary">+ Create
                        Permission</a>
                </div>
                <br>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>
                                    <a href="/dashboard/permissions/{{ $permission->id }}/edit"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form method="POST" style="display: inline;"
                                        action="/dashboard/permissions/{{ $permission->id }}"
                                        onsubmit="return confirm('Are you sure you want to delete this role?');">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Permission List -->
                <!-- Display the list of existing permissions -->
            </div>
        </div>
    </div>
</x-layout>
