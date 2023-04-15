<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent List</title>
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
        <div class="col-md-12">
            <h1>Agent List</h1>
            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="?action=add_agent" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Add New Agent</a>
                </div>
                <div class="col-md-6">
                    <div class="search-container">
                        <input type="text" class="form-control search-input" placeholder="Search" id="searchInput">
                        <a class="btn search-btn" href="?action=agent_list&keyword=" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th data-type="text">First Name<i class="fas fa-sort sort-icon"></i></th>
                        <th data-type="text">Last Name<i class="fas fa-sort sort-icon"></i></th>
                        <th data-type="text">Email<i class="fas fa-sort sort-icon"></i></th>
                        <th data-type="text">Phone Number<i class="fas fa-sort sort-icon"></i></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agents as $agent) { ?>
                    <tr>
                        <td><?php echo $agent->                    getFirstName(); ?></td>
                    <td><?php echo $agent->getLastName(); ?></td>
                    <td><?php echo $agent->getEmail(); ?></td>
                    <td><?php echo $agent->getPhone(); ?></td>
                    <td>
                        <a href="?action=edit_agent&id=<?php echo $agent->getId(); ?>" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit-modal-<?php echo $agent->getId(); ?>">Edit</a>
                        <a href="?action=delete_agent&id=<?php echo $agent->getId(); ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-<?php echo $agent->getId(); ?>" onclick="return confirm('Are you sure you want to delete this property?')">Remove</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <script src="js/app.js"></script>
        <script>// Get references to the search input and button elements
const searchInput = document.getElementById("searchInput");
const searchBtn = document.getElementById("searchBtn");

// Add a click event listener to the search button
if(searchBtn&&searchInput){
    searchBtn.addEventListener("click", () => {
        // Get the search input value
        const keyword = searchInput.value;
      
        searchBtn.href = `?action=agent_list&keyword=${keyword}`;
      });
      
            const sideMenu = document.querySelector('.side-menu');
            const mainContent = document.querySelector('.main-content');
            const menuToggle = document.querySelector('.menu-toggle');
            
      
            menuToggle.addEventListener('click', () => {
                sideMenu.classList.toggle('active');
      
                mainContent.classList.toggle('collapsed');
            });
}</script>
    </div>
</div>
</div>
        </div>
    </div>
</div>
</body>
</html>
