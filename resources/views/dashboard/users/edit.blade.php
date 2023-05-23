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
                            <div class="card-header">Edit User</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('users.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <label for="username"
                                            class="col-md-4 col-form-label text-md-right">Username</label>
                                        <div class="col-md-6">
                                            <input id="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                name="username" value="{{ $user->username }}" required autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-right">Email</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ $user->email }}" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                                        <div class="col-md-6">
                                            <select id="role" class="form-control" name="role">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $role->id == request()->query('selected_role') ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-layout>
