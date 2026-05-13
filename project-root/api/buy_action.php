<?php 

$ID = $_POST['id'];

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$products = "SELECT * FROM products WHERE id = $ID";

$result = mysqli_query($conn,$products);
$row = mysqli_fetch_array($result);
$row = $row[0];

print_r($row);




$conn->close();


?>