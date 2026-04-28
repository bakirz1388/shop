<?php

$targetDir = __DIR__.'/../assets/images/products/';
$fileName = "product".time();
$targetFile = $targetDir . $fileName.'.jpg';

move_uploaded_file($_FILES['file']['tmp_name'], $targetFile);


$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}


$p_file = $fileName;
$p_name = $_POST['name'];
$p_category = $_POST['category'];
$p_price = $_POST['price'];
$p_stock = $_POST['stock'];
$p_description = $_POST['description'];

$query = "INSERT INTO products (name, category, price, stock, img, description) 
VALUE ('$p_name', '$p_category', '$p_price', '$p_stock', '$p_file', '$p_description')";

if($conn->query($query) === TRUE) {
    echo json_encode(['code' => 400]);
} else {
    echo json_encode(['code' => 501]);
}

$conn->close();



?>