<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Favorite Properties</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #212529;
            color: white;
        }
        .card {
            background-color: #343a40;
        }
        .card-header {
            background-color: #495057;
        }
        .btn {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>User Favorite Properties</h2>
                <a href="?action=favoris" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
                <div class="row">
                    <?php foreach ($favoriteProperties as $property): ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="<?php echo $property->getImage(); ?>" class="card-img-top" alt="Property Image">
                                <div class="card-header">
                                    <h5><?php echo $property->getAddress(); ?></h5>
                                </div>
                                <div class="card-body">
                                    <p>Price: <?php echo $property->getPrice(); ?></p>
                                    <p><?php echo $property->getDescription(); ?></p>
                                    <a href="?action=remove_favoris&id=<?php echo $property->getId(); ?>" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Remove from Favorites
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
