<?php 

$ID = $_POST['id'];

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$products = "SELECT * FROM products WHERE id = $ID LIMIT 1";

$result = mysqli_query($conn,$products);
$row = mysqli_fetch_array($result);
$row = $row[0];

session_start();

if (isset($_SESSION['user_id'])) {
    
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [$ID];
    } else {
        $cart = $_SESSION['cart'];
        $cart[] = $ID;
        $_SESSION['cart'] = $cart;
    }
    echo json_encode(["code" => "405"]);

}else {
    echo json_encode(["code" => "505"]);
    return;
}



    



$conn->close();


?>