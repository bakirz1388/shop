<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/store.php';

$hotProducts = fetchFlaggedProducts('hot');
$newProducts = fetchFlaggedProducts('new');
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/logoBakiRZ.png">
    <title>BakiRZ | Home</title>

</head>
<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/category.php") ?>

    <main class="home-page">

    <section class="hero">
        <div class="hero-content">
            <h1>به فروشگاه <span>BakiRZ</span> خوش آمدید</h1>
            <p>بهترین محصولات با کیفیت، ارسال سریع و پشتیبانی پاسخگو</p>
            <a href="products.php" class="btn-hero">مشاهده محصولات</a>
        </div>
        <div class="hero-image">
            <img src="../assets/images/logoBakiRZ.png" alt="خرید آنلاین از BakiRZ">
        </div>
    </section>

    <div class="section-header">
        <h2>🔥 پرفروش‌ترین محصولات</h2>
        <p>محبوب‌ترین گزینه‌ها در میان مشتریان</p>
    </div>
    <section class="featured-products product-list">
        <?php foreach ($hotProducts as $prod): ?>
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
    </section>

    <section class="features">
        <div class="feature-item">
            <div class="feature-icon">🚚</div>
            <h3>ارسال سریع</h3>
            <p>تحویل سریع برای سفارش‌های داخل شهر</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">🔒</div>
            <h3>پرداخت امن</h3>
            <p>فرآیند خرید مطمئن و قابل پیگیری</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">📞</div>
            <h3>پشتیبانی</h3>
            <p>پاسخگویی برای سوال‌ها و مشکلات خرید</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">✅</div>
            <h3>اصالت کالا</h3>
            <p>ثبت محصول فقط با اطلاعات معتبر</p>
        </div>
    </section>

    <section class="banner">
        <div class="banner-text">
            <h2>تخفیف ویژه هفته</h2>
            <p>محصولات منتخب را بررسی کنید و سریع‌تر انتخاب کنید.</p>
            <a href="products.php" class="btn-banner">همین حالا خرید کن</a>
        </div>
    </section>

    <div class="section-header">
        <h2>🆕 جدیدترین محصولات</h2>
    </div>
    <section class="latest-products product-list">
        <?php foreach ($newProducts as $prod): ?>
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
    </section>

    </main>

    <?php include("../includes/footer.php") ?>


    <script src="../assets/js/jquery.main.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
