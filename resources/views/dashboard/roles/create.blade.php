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
                <a class="nav-link active" href="/dashboard/roles">Roles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/dashboard/permissions">Permissions</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="roles" class="tab-pane fade show active">
                <div class="justify-content-left">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Create New Role</div>

                            <div class="card-body">
                                <form method="POST" action="/dashboard/roles">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Role
                                            Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">Role
                                            Description</label>

                                        <div class="col-md-6">
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"></textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permissions"
                                            class="col-md-4 col-form-label text-md-right">Permissions</label>

                                        <div class="col-md-6">
                                            <select id="permissions"
                                                class="form-control @error('permissions') is-invalid @enderror"
                                                name="permissions[]" multiple required>
                                                @foreach ($permissions as $permission)
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('permissions')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Create Role
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
