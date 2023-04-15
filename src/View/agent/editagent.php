<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Agent</title>

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
                    <div class="col-md-8 offset-md-2">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4>Edit Agent</h4>
                            </div>
                            <div class="card-body">
                                <form action="?action=edit_agent" method="post">
                                    <input type="hidden" name="id" value="<?php echo $agent->getId(); ?>">
                                    <div class="form-group">
                                      <label for="firstname">First Name:</label>
                                      <input type="text" name="firstname" class="form-control" value="<?php echo $agent->getfirstName(); ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="lastname">Last Name:</label>
                                      <input type="text" name="lastname" class="form-control" value="<?php echo $agent->getlastName(); ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Email:</label>
                                      <input type="email" name="email" class="form-control" value="<?php echo $agent->getEmail(); ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="phone">Phone:</label>
                                      <input type="text" name="phone" class="form-control" value="<?php echo $agent->getPhone(); ?>">
                                    </div>
                                    <br><br>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="?action=agent_list" class="btn btn-secondary">Cancel</a>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>
