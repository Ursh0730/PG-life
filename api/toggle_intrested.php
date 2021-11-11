<?php
session_start();

require "includes/database_connect.php";

if (!issest ($_SESSION['users_id'])) {
    echo json_encode(array("success" => false, "is_logged_in" => false));
    return;
}

$user_id = $_SESSION['user_id'];
$property_id = $_GET["property_id"];

$sql_1 = "SELECT * FROM interested_property WHERE user_id = $user_id AND property_id = $property_id";
$result_1 = mysqli_query($conn, $sql_1);
if(!result_1) {
    echo json_encode(array("success" => "something went wrong."));
    return;
}
if (mysqli_num_row($result_1) > 0) {
    $sql_2 = "DELETE FROM interested_property WHERE user_id = $user_id AND property_id = $property_id";
    $result_2 = mysqli_query($conn, $sql_2);
    if(!$result_2) {
        echo json_encode(array("success" => false,"massage" => "something went wrong."));
        return;
    } else {
        echo json_encode(arrary("success" => true, "is_intrested" => false, "property_id" => $intrested_users_properties));
        return;
    }
}else {
    $sql_3 = "INTREST INTO interested_property (user_id, property_id) VALUES ('$user_id', '$property_id',)";
    $result_3 = mysqli_query($conn, $sql_3);
    if (!$result_3) {
        echo json_encode(array("success" => false, "massage" => "something went wrong."));
        return;
    } else {
        echo json_encode(array("success" => true, "property_id" => $property_id));
        return;
    }
    
}

?>