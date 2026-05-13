<?php 

$userId = $_POST['user_id'];
$role = $_POST['role'];

$changeTo = '';
if($role == 0){
    $changeTo = '2';
} elseif($role == 1) {
    $changeTo = '2';
} elseif($role == 2) {
    $changeTo = '0';
}

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$products = "UPDATE users SET `role` = $changeTo WHERE user_id = $userId";

$result = mysqli_query($conn,$products);
echo json_encode(["code" => "406"]);


?>