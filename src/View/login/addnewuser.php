<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login CRUD</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/app.css"></link>
</head>
<body>
<div class="container-fluid">
    <i class="fas fa-bars menu-toggle"></i>
    <div class="row">
        <div class="col-md-3 side-menu active">
            <br><br>
            <h3>Menu</h3>
            <br>
            <ul class="nav flex-column">
                <li class="nav-item username">
                    <?php echo $username; ?>
                </li>
                <br>
                <li class="nav-item">
                    <a class="nav-link" href="?action=login_list"><i class="fas fa-user-circle"></i> Login List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=agent_list"><i class="fas fa-users"></i> Agent List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=property_list"><i class="fas fa-home"></i> Property List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 main-content collapsed">
            <div class="container mt-5">
                <div class="row">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h1>Add New Login</h1>
                        </div>
                        <div class="card-body">
                            <form action="?action=add_login" method="POST">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role:</label>
                                    <select class="form-control" id="role" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <br><br>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="?action=login_list" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
</body>
</html>
