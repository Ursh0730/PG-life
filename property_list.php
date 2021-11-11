<?php

require"includes/database_connect.php";

// $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
// echo $_SESSION['user_id'];

$city_name = $_GET["city"];
$sql_1 = "SELECT * FROM cities WHERE cities_name = '$city_name'";
$result = mysqli_query($conn, $sql_1);
if(!$result) {
    echo "something went wrong!";
    return;
}
$city = mysqli_fetch_assoc($result);
if(!$city) {
    echo "sorry! we do not have any PG listed in city.";
    return;
}
$city_id = $city['id'];

$sql2 = "SELECT * FROM properties WHERE cities_id = '$city_id'";
$result2 = mysqli_query($conn, $sql2);
if(!$result2) {
    echo "something went wrong";
    return;
}
$properties = mysqli_fetch_all($result2, MYSQLI_ASSOC);
// echo $properties; HW

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Best PG's in <?php echo $city_name ?> | PG Life</title>

   <?php
    include("includes/head-link.php")
    
   ?>
    <link href="css/property_list.css" rel="stylesheet" />
</head>

<body>
      
<?php
include("includes/header.php");
if(isset($_SESSION['user_id'])) {
    // echo $_SESSION['user_id'];
    $user_id = $_SESSION['user_id'];
}else {
    $user_id = NULL;
    echo "oops";
}

$sql_3 = " SELECT *
FROM interested_property
WHERE user_id = '$user_id'";
$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "something went wrong!";
    echo $city_id;
    return;
}

$interested_users_properties = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $city_name ?>
            </li>
        </ol>
    </nav>

    <div class="page-container">
        <div class="filter-bar row justify-content-around">
            <div class="col-auto" data-toggle="modal" data-target="#filter-modal">
                <img src="img/filter.png" alt="filter" />
                <span>Filter</span>
            </div>
            <div class="col-auto">
                <img src="img/desc.png" alt="sort-desc" />
                <span>Highest rent first</span>
            </div>
            <div class="col-auto">
                <img src="img/asc.png" alt="sort-asc" />
                <span>Lowest rent first</span>
            </div>
        </div>

        <?php
        foreach ($properties as $property) {
            $property_img = glob("img/properties/" . $property['id'] . "/*");
        
        ?>
        
        <div class="property-card row">
            <div class="image-container col-md-4">
                <img src="img/properties/1/1d4f0757fdb86d5f.jpg" />
            </div>
            <div class="content-container col-md-8">
                <div class="row no-gutters justify-content-between">
                    <?php
                    $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety'])/3;
                    $total_rating = round($total_rating, 1);
                    ?>
                    <div class="star-container" title="<?= $total_rating ?>">
                    <?php
                    $rating = $total_rating;
                    for($i = 0; $i < 5; $i++) {
                        if($rating >= $i + 0.8) {
                    ?>
                             <i class="fas fa-star"></i>
                        <?php
                        }elseif($rating >= $i + 0.3) {
                        ?>
                             <i class="fas fa-star-half-alt"></i>
                        <?php
                        } else {
                        ?>
                            <i class="far fa-star"></i>
                        <?php
                        }
                    }
                    ?>
                    </div>
                    <div class="interested-container">
                        <?php
                        $is_interested = false;
                        foreach ($interested_users_properties as $interested_user) {
                            if ($interested_user['property_id'] == $property['id']) {
                                $is_interested = true;
                            }
                        }
                        if ($is_interested) {
                            ?>
                            <i class = "is-interested-img fas fa-heart"></i>
                            <?php
                        } else {
                            ?>
                            <i class = "is-interested-img far fa-heart"></i>
                            <?php
                        }
                        ?>
                
                        <div class="interested-text">3 interested</div>
                    </div>
                </div>
                <div class="detail-container">
                    <div class="property-name"><?php echo $property['name']?></div>
                    <div class="property-address"><?php echo $property['address']?></div>
                    <div class="property-gender">
                       <?php
                       if($property['gender'] == "male") {
                        ?>
                    <img src="img/male.png" />
                    <?php
                       }elseif($property['gender'] == "female") {
                           ?>
                        <img src="img/female.png" />
                        <?php
                       }else{
                           ?>
                           <img src="img/unisex.png"/>
                           <?php
                       }
                       ?>
                        
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="rent-container col-6">
                        <div class="rent">Rs <?php echo $property['rent']?>/-</div>
                        <div class="rent-unit">per month</div>
                    </div>
                    <div class="button-container col-6">
                        <a href="property_detail.php?id=<?php echo $property['id']?>" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        </div>

    <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="filter-heading" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="filter-heading">Filters</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h5>Gender</h5>
                    <hr />
                    <div>
                        <button class="btn btn-outline-dark btn-active">
                            No Filter
                        </button>
                        <button class="btn btn-outline-dark">
                            <i class="fas fa-venus-mars"></i>Unisex
                        </button>
                        <button class="btn btn-outline-dark">
                            <i class="fas fa-mars"></i>Male
                        </button>
                        <button class="btn btn-outline-dark">
                            <i class="fas fa-venus"></i>Female
                        </button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-success">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <?php
  include("includes/signup_modal.php");
  include("includes/login_modal.php");
    include("includes/footer.php");
    ?>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>
