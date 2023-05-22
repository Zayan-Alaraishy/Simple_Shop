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
            <a class="nav-link " data-toggle="tab" href="/dashboard/users">Users</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" data-toggle="tab" href="/dashboard/roles">Roles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="/dashboard/permissions">Permissions</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="users" class="tab-pane fade ">
            <h3>Users</h3>
            <!-- User List -->
            <!-- Display the list of existing users -->
        </div>

        <div id="roles" class="tab-pane fade show active">
            <h3>Roles</h3>
            <!-- Role List -->
            <!-- Display the list of existing roles -->
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

    <!-- Include your JS files here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>
