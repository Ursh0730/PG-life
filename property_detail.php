<?php
require"includes/database_connect.php";

$user_id =isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$property_id = $_GET['id'];


$sql2 = "SELECT * FROM properties WHERE id = '$property_id'";
$result = mysqli_query($conn, $sql2);
if(!$result) {
    echo "something went wrong";
    return;
}
$properties = mysqli_fetch_all($result, MYSQLI_ASSOC);
$property = $properties[0];
$city_id = $property['cities_id'];

$sql3 = "SELECT * FROM cities WHERE id = '$city_id'";
$result1 = mysqli_query($conn, $sql3);
if(!$result1) {
    echo "something went wrong!";
    return;
}
$city_name = mysqli_fetch_all($result1, MYSQLI_ASSOC);
$city_name1 = $city_name[0];

$property_id = $property['id'];
$sql4 = "SELECT * FROM `properties_amenities` WHERE property_id = '$property_id'";
$result2 = mysqli_query($conn, $sql4);
if(!$result2) {
    echo "something went wrong!";
    return;
}
$amenities = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// foreach($amenities as $amenity) {
//     echo $amenity['amenity_id'];
// }
// SELECT type FROM `amenities` WHERE id = 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>Ganpati Paying Guest | PG Life</title> -->
    <title> <?php echo $property['name']?> | PG Life</title>


   <?php
   include("includes/head-link.php")
   ?>
    <link href="css/property_detail.css" rel="stylesheet" />
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
            <li class="breadcrumb-item">
                <a href="property_list.php?city=<?php echo $city_name1['cities_name'];?>"><?php echo $city_name1['cities_name']; ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php
                echo $property['name'];
                ?>
            </li>
        </ol>
    </nav>

    <div id="property-images" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#property-images" data-slide-to="0" class="active"></li>
            <li data-target="#property-images" data-slide-to="1" class=""></li>
            <li data-target="#property-images" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/properties/1/1d4f0757fdb86d5f.jpg" alt="slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/properties/1/46ebbb537aa9fb0a.jpg" alt="slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/properties/1/eace7b9114fd6046.jpg" alt="slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#property-images" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#property-images" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="property-summary page-container">
        <div class="row no-gutters justify-content-between">
        <?php
                    $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety'])/3;
                    $total_rating = round($total_rating, 1);
                    ?>
            <div class="star-container" title=<?php echo $total_rating?>>
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
                <i class="is-interested-image far fa-heart"></i>
                <div class="interested-text">
                    <span class="interested-user-count">6</span> interested
                </div>
            </div>
        </div>
        <div class="detail-container">
            <div class="property-name"><?php echo $property['name']; ?></div>
            <div class="property-address"><?php echo $property['address']; ?></div>
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
                <div class="rent">Rs <?php echo $property['rent'];?>/-</div>
                <div class="rent-unit">per month</div>
            </div>
            <div class="button-container col-6">
                <a href="#" class="btn btn-primary">Book Now</a>
            </div>
        </div>
    </div>

    <div class="property-amenities">
        <div class="page-container">
            <h1>Amenities</h1>
            <div class="row justify-content-between">
                <div class="col-md-auto">
                    <h5>Building</h5>
                    <div class="amenity-container">
                        <img src="img/amenities/powerbackup.svg">
                        <span>Power backup</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/lift.svg">
                        <span>Lift</span>
                    </div>
                </div>

                <div class="col-md-auto">
                    <h5>Common Area</h5>
                    <div class="amenity-container">
                        <img src="img/amenities/wifi.svg">
                        <span>Wifi</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/tv.svg">
                        <span>TV</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/rowater.svg">
                        <span>Water Purifier</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/dining.svg">
                        <span>Dining</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/washingmachine.svg">
                        <span>Washing Machine</span>
                    </div>
                </div>

                <div class="col-md-auto">
                    <h5>Bedroom</h5>
                    <div class="amenity-container">
                        <img src="img/amenities/bed.svg">
                        <span>Bed with Matress</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/ac.svg">
                        <span>Air Conditioner</span>
                    </div>
                </div>

                <div class="col-md-auto">
                    <h5>Washroom</h5>
                    <div class="amenity-container">
                        <img src="img/amenities/geyser.svg">
                        <span>Geyser</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="property-about page-container">
        <h1>About the Property</h1>
        <p><?php echo $property['description']; ?></p>
    </div>

    <div class="property-rating">
        <div class="page-container">
            <h1>Property Rating</h1>
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6">
                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fas fa-broom"></i>
                            <span class="rating-criteria-text">Cleanliness</span>
                        </div>
                        <?php $ratingc = $property['rating_clean'];?>
                        <div class="rating-criteria-star-container col-6" title=<?php echo $ratingc;?>>
                            <?php 
                            for($i = 0; $i < 5; $i++) {
                                if($ratingc >= $i + 0.8) {
                            ?>
                                     <i class="fas fa-star"></i>
                                <?php
                                }elseif($ratingc >= $i + 0.3) {
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
                            
                            
                            <!-- <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i> -->
                        </div>
                    </div>

                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fas fa-utensils"></i>
                            <span class="rating-criteria-text">Food Quality</span>
                        </div>
                        <?php $ratingf = $property['rating_food'];?>
                        <div class="rating-criteria-star-container col-6" title=<?php echo $ratingf;?>>
                        <?php 
                            for($i = 0; $i < 5; $i++) {
                                if($ratingf >= $i + 0.8) {
                            ?>
                                     <i class="fas fa-star"></i>
                                <?php
                                }elseif($ratingf >= $i + 0.3) {
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
                            
                            <!-- <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i> -->
                        </div>
                    </div>

                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fa fa-lock"></i>
                            <span class="rating-criteria-text">Safety</span>
                        </div>
                        <?php $ratings = $property['rating_safety'];?>
                        <div class="rating-criteria-star-container col-6" title=<?php echo $ratings;?>>
                        <?php 
                            for($i = 0; $i < 5; $i++) {
                                if($ratings >= $i + 0.8) {
                            ?>
                                     <i class="fas fa-star"></i>
                                <?php
                                }elseif($ratings >= $i + 0.3) {
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
                            
                            <!-- <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i> -->
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="rating-circle">
                        <div class="total-rating"><?php echo $total_rating;?></div>
                        <div class="rating-circle-star-container">
                        <?php 
                            for($i = 0; $i < 5; $i++) {
                                if($total_rating >= $i + 0.8) {
                            ?>
                                     <i class="fas fa-star"></i>
                                <?php
                                }elseif($total_rating >= $i + 0.3) {
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
                            
                            <!-- <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="property-testimonials page-container">
        <h1>What people say</h1>
        <div class="testimonial-block">
            <div class="testimonial-image-container">
                <img class="testimonial-img" src="img/man.png">
            </div>
            <div class="testimonial-text">
                <i class="fa fa-quote-left" aria-hidden="true"></i>
                <p>You just have to arrive at the place, it's fully furnished and stocked with all basic amenities and services and even your friends are welcome.</p>
            </div>
            <div class="testimonial-name">- Ashutosh Gowariker</div>
        </div>
        <div class="testimonial-block">
            <div class="testimonial-image-container">
                <img class="testimonial-img" src="img/man.png">
            </div>
            <div class="testimonial-text">
                <i class="fa fa-quote-left" aria-hidden="true"></i>
                <p>You just have to arrive at the place, it's fully furnished and stocked with all basic amenities and services and even your friends are welcome.</p>
            </div>
            <div class="testimonial-name">- Karan Johar</div>
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
