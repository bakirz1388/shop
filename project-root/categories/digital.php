<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/store.php';

$products = fetchProducts('Digital');
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/logoBakiRZ.png">
    <title>BakiRZ | Digital</title>

</head>
<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/category.php") ?>
    <main>
        <div class="margin-for-prod" style="margin-bottom: 15px;"></div>
        <div id="toast"></div>
        <ul class="product-list">
            <?php foreach ($products as $prod): ?>
                <li class="item" data-product-id="<?= $prod['id'] ?>">
                    <div class="picture">
                        <img class="product-img" src="<?= h(productImagePath($prod['img'])) ?>" alt="<?= h($prod['name']) ?>">
                    </div>
                    <div class="product">
                        <div class="product-name"><?= h($prod['name']) ?></div>
                        <div class="product-price">
                            <b style="color: red;"><?= number_format((int) $prod['price']); ?></b> تومان
                        </div>
                        <button class="auth-btn add-shop-cart" data-id="<?= $prod['id'] ?>">افزودن به سبد خرید</button>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </main>

    <?php include("../includes/footer.php") ?>


    <script src="../assets/js/jquery.main.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
