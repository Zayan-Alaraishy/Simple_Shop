<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .tab-content {
            margin-top: 20px;
        }
    </style>
</head>

<body>
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
        <div id="users" class="tab-pane fade show ">
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
            <h3>Add new permission</h3>

            <form action="/dashboard/permissions" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

    <!-- Include your JS files here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>
