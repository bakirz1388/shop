<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/store.php';

$summary = cartSummary();
$cartList = $summary['items'];
$totalPay = $summary['total'];
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
        <?php if ($cartList === []): ?>
            <center><h1>سبد خرید شما خالی است 🛒</h1></center>
        <?php else: ?>
            <ul class="product-list">

                <?php foreach ($cartList as $prod): ?>
                    <li class="item" id="prod-<?= $prod['id'] ?>">
                        <div class="picture">
                            <img class="product-img" src="<?= h(productImagePath($prod['img'])) ?>" alt="<?= h($prod['name']) ?>">
                        </div>
                        <div class="product">
                            <div class="product-name"><?= h($prod['name']) ?></div>
                            <div class="product-price">
                                <b style="color: red;"><?= number_format((int) $prod['price']); ?></b> تومان
                            </div>
                            <button class="auth-btn remove-shop-cart" data-id="<?= $prod['id'] ?>">حذف از سبد خرید</button>
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
                    <?php foreach ($cartList as $prod): ?>
                        <tr class="product">
                            <td class="cart-product-name"><?= h($prod['name']) ?></td>
                            <td class="price-col">
                                <b><?= number_format((int) $prod['price']) ?></b> تومان
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <div class="total-section">
                <small>تومان</small><span class="total-amount"><?= number_format($totalPay) ?></span>
                <span class="total-label">: قیمت نهایی محصولات</span>
            </div>

            <button class="buy-btn" <?= $cartList === [] ? 'disabled' : '' ?>>خرید نهایی</button>
        </div>

    <div class="invoice-footer">
        سفارش شما پس از ثبت، داخل پنل ادمین قابل مشاهده است.
    </div>
</div>
    </main>
    <?php include("../includes/footer.php") ?>

    <script src="../assets/js/jquery.main.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
