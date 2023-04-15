<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Shopping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
        }
        .card {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 1.25rem 1.5rem;
        }
        .search-form {
            margin-bottom: 1.5rem;
        }
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
        .modal-content {
    background-color: #343a40;
    color: white;
}

.modal-header {
    border-bottom-color: #495057;
}

.modal-footer {
    border-top-color: #495057;
}
.phone-cover {
    background-color: green;
    display: inline-block;
    cursor: pointer;
    padding: 5px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
}

.show-phone {
    display: none;
}

.phone-cover.clicked {
    background-color: transparent;
    cursor: auto;
    padding: 0;
}

.phone-cover:not(.clicked)::after {
    content: "Click here to show";
    color: white;
    font-size: 14px;
}




    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Property Listings</h2>
                <form class="search-form" action="?action=propertyshop" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search for properties...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <div class="row">
                    <?php foreach ($properties as $property): ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="<?php echo $property->getImage(); ?>" class="card-img-top" alt="Property Image">
                                <div class="card-body">
                                    <h5><?php echo $property->getAddress(); ?></h5>
                                    <p>Price: <?php echo $property->getPrice(); ?> DHS</p>
                                    <p><?php echo $property->getDescription(); ?></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="?action=add_to_favorites&property_id=<?php echo $property->getId(); ?>" class="btn btn-primary">
                                            <i class="fas fa-star"></i> Add to Favorites
                                        </a>
                                        <button type="button" class="btn btn-info contact-agent-btn" data-bs-toggle="modal" data-bs-target="#agentInfoModal-<?php echo $property->getAgentId(); ?>" data-agent-id="<?php echo $property->getAgentId(); ?>">
                                            <i class="fas fa-user"></i> Contact Agent
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
<div class="modal fade" id="agentInfoModal-<?php echo $property->getAgentId(); ?>" tabindex="-1" aria-labelledby="agentInfoModalLabel-<?php echo $property->getAgentId(); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agentInfoModalLabel-<?php echo $property->getAgentId(); ?>">Agent Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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

<script>
    
    $(document).ready(function() {
        $('.contact-agent-btn').on('click', function() {
           
            const agentId = $(this).data('agent-id');
            const targetModalId = $(this).data('bs-target');
            
            $.ajax({
                url: '?action=get_agent_infos&agent_id=' + agentId,
                type: 'GET',
                dataType: 'json',
                success: function (agent) {
                    $(targetModalId + ' .modal-body').html(`
                        <p><strong>Name:</strong> ${agent.prenom} ${agent.nom}</p>
                        <p><strong>Email:</strong> ${agent.email}</p>
                        <p><strong>Phone:</strong> <span class="phone-cover"><span class="show-phone">${agent.phone}</span></span></p>

                    `);
            },
            error: function (xhr, status, error) {
                console.error("Error fetching agent info:", error);
            },
            });
        });
    });
    // Get references to the search input and button elements
const searchInput = document.getElementById("searchInput");
const searchBtn = document.getElementById("searchBtn");

// Add a click event listener to the search button
if(searchBtn&&searchInput){
    searchBtn.addEventListener("click", () => {
        // Get the search input value
        const keyword = searchInput.value;
      
        searchBtn.href = `?action=propertyshop&keyword=${keyword}`;
      });
      
            const sideMenu = document.querySelector('.side-menu');
            const mainContent = document.querySelector('.main-content');
            const menuToggle = document.querySelector('.menu-toggle');
            
      
            menuToggle.addEventListener('click', () => {
                sideMenu.classList.toggle('active');
      
                mainContent.classList.toggle('collapsed');
            });
}
$(document).on('click', '.phone-cover', function() {
    $(this).children('.show-phone').toggle();
    $(this).toggleClass('clicked');
});





</script>


</body>
</html>
