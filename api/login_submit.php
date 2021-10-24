<?php
session_start();
require("../includes/database_connect.php");

$email = $_POST['email'];
$password = $_POST['password'];
$password = sha1($password);

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if(!$result) {
    echo " something went wrong!" ;
    exit;
}
$row_count = mysqli_num_rows($result);
if($row_count == 0) {
    echo "login failed, invalid email";
    exit;
}else {
    $sql = "SELECT * FROM users WHERE email = '$email' AND PASSWORD = '$password'";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        echo " something went wrong!" ;
        exit;
    }
    $row_count = mysqli_num_rows($result);
    if($row_count == 0) {
        echo "invalid password";
        exit;
    }
    $row = mysqli_fetch_assoc($result);
$_SESSION['user_id'] = $row['id'];
$_SESSION['full_name'] = $row['name'];
$_SESSION['email'] = $row['email'];
$_SESSION['phone'] = $row['phone_number'];
$_SESSION['college'] = $row['college_name'];
header("location: ../index.php");
// echo "hello".$_SESSION['phone'];
mysqli_close($conn);
}
?>