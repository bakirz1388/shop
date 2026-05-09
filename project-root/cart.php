<?php
$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

// $data = json_decode(file_get_contents('php://input'), true);

// $productId = $data['productId'];
// $productImg = $data['productImg'];
// $productName = $data['productName'];
// $productPrice = $data['productPrice'];


// if(isset($_SESSION['add_to_cart'])) {
//     $product_id = $_SESSION['add_to_cart'];
    
//     if(!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = [];
//     }
    
//     if(isset($_SESSION['cart'][$product_id])) {
//         $_SESSION['cart'][$product_id]++;
//     } else {
//         $_SESSION['cart'][$product_id] = 1;
//     }
    
//     unset($_SESSION['add_to_cart']);
    
//     echo "محصول با ID: " . $product_id . " به سبد خرید اضافه شد";
// }


?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="./assets/images/logoBakiRZ.png">
    <title>BakiRZ | Cart</title>
</head>
<body>
    <?php include("./includes/header.php") ?>
    <main>
        
    </main>
    <?php include("./includes/footer.php") ?>
</body>
</html>
