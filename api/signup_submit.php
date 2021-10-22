<?php
$db_hostname ="127.0.0.1";
$db_username ="root";
$db_password ="";
$db_name ="pg_life";

$conn = mysqli_connect ($db_hostname, $db_username, $db_password, $db_name);
if(!$conn) {
    echo "connection failed " . mysqli_connect_error();
    exit;
}
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$password = sha1($password);
$college_name =$_POST['college_name'];
$gender = $_POST['gender'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if(!$result) {
    echo " something went wrong!" ;
    exit;
}
$row_count = mysqli_num_rows($result);
if($row_count != 0) {
    echo "This email id is already registered with us";
    exit;
}
$sql1 = "INSERT INTO users (email, PASSWORD, name, phone_number, gender, college_name) VALUES ('$email','$password','$full_name', '$phone', '$gender' ,'$college_name')"; 
$result1 = mysqli_query($conn, $sql1);
if(!$result1) {
    echo " something went wrong!" ;
    exit;
}
echo "Your account has been created sucessfully";
?>
 Click <a href="../index.php">here</a>to continue.
 <?php
    mysqli_close($conn);
?>
