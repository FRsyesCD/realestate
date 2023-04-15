
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
        <i class="fas fa-bars menu-toggle" ></i>
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
            <h1>Login List</h1>
				<div class="row mt-4">
            <div class="col-md-6">
                <a href="?action=add_login" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Add New Login</a>
            </div>
            <div class="col-md-6">
    <div class="search-container">
        <input type="text" class="form-control search-input" placeholder="Search" id="searchInput">
        <a class="btn search-btn" href="?action=login_list&keyword=" id="searchBtn">
            <i class="fas fa-search"></i>
        </a>
    </div>
</div>
        </div>

				
				<table class="table mt-4">
					
    <thead>
                <tr>
                <th data-type="text">Username<i class="fas fa-sort sort-icon"></i></th>
        <th data-type="text">Password<i class="fas fa-sort sort-icon"></i></th>
        <th data-type="text">Role<i class="fas fa-sort sort-icon"></i></th>
        <th>Action</th>
                   
                </tr>
					</thead>
                    <tbody>
                <?php foreach ($logins as $login) { ?>
                <tr>
                    <td><?php echo $login->getUsername(); ?></td>
                    <td><?php echo $login->getPassword(); ?></td>
                    <td><?php echo $login->getRole(); ?></td>
                    <td>
                        <a href="?action=edit_login&id=<?php echo $login->getId(); ?>" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit-modal-<?php echo $login->getId(); ?>">Edit</a>
                        <a href="?action=delete_login&id=<?php echo $login->getId(); ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-<?php echo $login->getId(); ?>" onclick="return confirm('Are you sure you want to delete this property?')">Remove</a>
                    </td>
                </tr>
<?php }?>
				</tbody>
				</table>
			</div>
			<script src="js/app.js"></script>
            <script>// Get references to the search input and button elements
const searchInput = document.getElementById("searchInput");
const searchBtn = document.getElementById("searchBtn");

// Add a click event listener to the search button
if(searchBtn&&searchInput){
    searchBtn.addEventListener("click", () => {
        // Get the search input value
        const keyword = searchInput.value;
      
        searchBtn.href = `?action=login_list&keyword=${keyword}`;
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
</body>
</html>
