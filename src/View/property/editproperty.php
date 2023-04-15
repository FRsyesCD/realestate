<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>

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
                                <h4>Edit Property</h4>
                            </div>
                            <div class="card-body">
                                <form action="?action=edit_property" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $property->getId(); ?>">
                                    <div class="form-group">
                                      <label for="address">Address:</label>
                                      <input type="text" name="address" class="form-control" value="<?php echo $property->getAddress(); ?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="price">Price:</label>
                                      <input type="number" name="price" class="form-control" value="<?php echo $property->getPrice(); ?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="description">Description:</label>
                                      <textarea name="description" class="form-control" required><?php echo $property->getDescription(); ?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="image-upload" class="form-label">
    <i class="fas fa-upload"></i> Upload Image
</label>
                                      <input type="file" name="image" class="form-control-file" id="image-upload" hidden>
                                      <?php if (!empty($property->getImage())): ?>
                                      <img src="<?php echo $property->getImage(); ?>" alt="Property Image" style="max-width: 200px; margin-top: 10px;">
                                      <?php endif; ?>
                                </div>
                                <div class="form-group">
                                  <label for="agentId">Agent:</label>
                                  <select name="agentId" class="form-control" required>
                                    <?php foreach ($agents as $agent): ?>
                                      <option value="<?php echo $agent->getId(); ?>" <?php if ($agent->getId() == $property->getAgentId()) echo "selected"; ?>><?php echo $agent->getfirstName().' '.$agent->getlastName(); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <br><br>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="?action=property_list" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/app.js"></script>
    </div>
</div>
</div>
</body>
</html>