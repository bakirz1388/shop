<?php

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$products = "SELECT * FROM products";

$result = mysqli_query($conn,$products);
$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/logoBakiRZ.png">
    <title>BakiRZ | Products</title>

</head>
<body>
    <?php include("includes/header.php") ?>
    <main>
        <ul class="product-list">
            <?php foreach($result as $prod): ?>
            <li class="item">
                <div class="picture">
                    <img src="assets/images/products/<?= $prod['img'] ?>.jpg">
                </div>
                <div class="product">
                    <div class="product-name"><?= $prod['name'] ?></div>
                    <div class="product-price"><b style="color: red;"><?= number_format($prod['price']); ?></b> تومان</div>
                    <button class="auth-btn">افزودن به سبد خرید</button>
                </div>
            </li>
            <?php endforeach ?>
        </ul>
    </main>

    <?php include("includes/footer.php") ?>


    <script src="assets/js/jquery.main.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>