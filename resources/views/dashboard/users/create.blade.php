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
                <a class="nav-link active " href="/dashboard/users">Users</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="/dashboard/roles">Roles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/dashboard/permissions">Permissions</a>
            </li>
        </ul>

        <div class="tab-content">

            <div id="users" class="tab-pane fade show active">
                <div class="justify-content-left">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Assign New user</div>

                            <div class="card-body">

                                <form method="POST" action="/dashboard/users">
                                    @csrf

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" id="role" class="form-control" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
