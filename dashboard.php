<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard- PG Life</title>

    <?php
   include("includes/head-link.php")
   ?>
   
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
   
<?php
include("includes/header.php")
?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb py-2">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Dashboard
        </li>
    </ol>
</nav>

<div class="my-profile page-container">
    <h1>My profile</h1>
    <div class="row">
        <div class="col-md-3 profile-img-container">
            <i class="fas fa-user profile-img"></i>
        </div>
        <div class="col-md-9">
            <div class="row no-gutters justify-content-betweem align-items-end">
                <div class="profile">
                    <div class="name">Aditya sood</div>
                    <div class="email">adity@gmail.com</div>
                    <div class="phone">9876543210</div>
                    <div class="college">Intrshala</div>
                </div>
                <div class="edit">
                    <div class="edit-profile"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-intrested-properties">
    <div class="page-container">
        <h1>My Intrested Properties</h1>

        <div class="property-card property-id-1 row">
            <div class="image-container col-md-4">
                <img src="img/properties/1/eace7b9114fd6046.jpg">
            </div>
            <div class="content-container col-md-8">
                <div class="row no-gutters justify-content-between">
                    <div class="star-container" title="4.8">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="interested-container">
                        <i class="is-interested-image fas fa-heart" property_id="1"></i>
                    </div>
                </div> 
                <div class="detail-container">
                    <div class="property-name">Ganpati Paying Guest</div>
                    <div class="property-address">Police Beat, Sainath Complex, Besides, SV Rd, Daulat Nagar, Borivali East, Mumbai - 400066 </div>
                    <div class="property-gender">
                        <img src="img/unisex.png">
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="rent-container col-6">
                        <div class="rent">Rs 8,500/-</div>
                        <div class="rent-unit">per Month</div>
                    </div>
                    <div class="button-container col-6">
                        <a href="property_detail.php" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>    
        </div>
        <div class="property-card property-id-2 row">
            <div class="image-container col-md-4">
                <img src="img/properties/1/1d4f0757fdb86d5f.jpg" />
            </div>
            <div class="content-container col-md-8">
                <div class="row no-gutters justify-content-between">
                    <div class="star-container" title="4.5">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="interested-container">
                        <i class="is-interested-image fas fa-heart" property_id="2"></i>
                    </div>
                </div>
                <div class="detail-container">
                    <div class="property-name">Navkar Paying Guest</div>
                    <div class="property-address">44, Juhu Scheme, Juhu, Mumbai, Maharashtra 400058</div>
                    <div class="property-gender">
                        <img src="img/male.png">
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="rent-container col-6">
                        <div class="rent">Rs 9,500/-</div>
                        <div class="rent-unit">per month</div>
                    </div>
                    <div class="button-container col-6">
                        <a href="property_detail.php" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>

<?php
    include("includes/footer.php")
    ?>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
    
</body>
</html>