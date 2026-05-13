<?php
session_start();
$cartList = [];
if (isset($_SESSION['cart'])) {
    $cartId = $_SESSION['cart'];
    

    $conn = new mysqli("localhost","root","","shop_db");

    if($conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }
    foreach ($cartId as $cart) {

        $query = "SELECT * FROM products WHERE id = $cart";
        
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        $cartList[] = $row;
    }
}
$totalPay = 0;

foreach ($cartList as $value) {
    $totalPay += $value['price'];
}


?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/logoBakiRZ.png">
    <title>BakiRZ | Cart</title>
</head>
<body>
    <?php include("../includes/header.php") ?>
    <main>
        <div class="margin-for-prod" style="margin-bottom: 15px;"></div>
        <div id="toast"></div>
        <?php if(empty($cartList)): ?>
            <center><h1>سبد خرید شما خالیست 🛒</h1></center>
        <?php else: ?>
            <ul class="product-list">

                <?php foreach($cartList as $prod): ?>
                    <li class="item" id="prod-<?= $prod['id'] ?>">
                        <div class="picture">
                            <img class="product-img" src="../assets/images/products/<?= $prod['img'] ?>.jpg">
                        </div>
                        <div class="product">
                            <div class="product-name"><?= $prod['name'] ?></div>
                            <div class="product-price">
                                <b style="color: red;"><?= number_format($prod['price']); ?></b> تومان
                            </div>

                        </div>
                    </li>
                <?php endforeach ?>
                    
            </ul>
        <?php endif ?>
        <div class="invoice-card">
        <div class="invoice-header">
            <h2>🧾 فاکتور خرید</h2>
        </div>

        <div class="invoice-body">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>نام محصول</th>
                        <th style="text-align: left;">قیمت (تومان)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cartList as $prod): ?>
                        <tr class="product">
                            <td class="cart-product-name"><?= $prod['name'] ?></td>
                            <td class="price-col">
                                <b><?= number_format($prod['price']) ?></b> تومان
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <div class="total-section">
                <small>تومان</small><span class="total-amount"><?= number_format($totalPay) ?></span>
                <span class="total-label">: قیمت نهایی محصولات</span>
            </div>

            <button class="buy-btn">خرید نهایی</button>
        </div>

    <div class="invoice-footer">
        با تشکر از خرید شما | ضمانت اصالت کالا
    </div>
</div>
    </main>
    <?php include("../includes/footer.php") ?>

    <script src="../assets/js/jquery.main.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
