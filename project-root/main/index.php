<?php
session_start();

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$hotProducts = "SELECT * FROM products WHERE `status`  > 0 AND `hot` = 1";
$newProducts = "SELECT * FROM products WHERE `status`  > 0 AND `new` = 1";

$hotResult = mysqli_query($conn,$hotProducts);
$newResult = mysqli_query($conn,$newProducts);

$conn->close();
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
            <p>بهترین محصولات با کیفیت، ارسال سریع و پشتیبانی ۲۴ ساعته</p>
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
        <?php foreach($hotResult as $prod): ?>
                <li class="item" data-product-id="<?= $prod['id'] ?>">
                    <div class="picture">
                        <img class="product-img" src="../assets/images/products/<?= $prod['img'] ?>.jpg">
                    </div>
                    <div class="product">
                        <div class="product-name"><?= $prod['name'] ?></div>
                        <div class="product-price">
                            <b style="color: red;"><?= number_format($prod['price']); ?></b> تومان
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
            <p>تحویل ۲۴ ساعته در تهران</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">🔒</div>
            <h3>پرداخت امن</h3>
            <p>گارانتی بازگشت وجه</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">📞</div>
            <h3>پشتیبانی ۲۴/۷</h3>
            <p>پاسخگویی هر روز هفته</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">✅</div>
            <h3>ضمانت اصل بودن</h3>
            <p>کالاهای اورجینال</p>
        </div>
    </section>

    <section class="banner">
        <div class="banner-text">
            <h2>تخفیف ویژه هفته</h2>
            <p>تا ۴۰٪ تخفیف برای محصولات منتخب + ارسال رایگان</p>
            <a href="#" class="btn-banner">همین حالا خرید کن</a>
        </div>
    </section>

    <div class="section-header">
        <h2>🆕 جدیدترین محصولات</h2>
    </div>
    <section class="latest-products product-list">
        <?php foreach($newResult as $prod): ?>
                <li class="item" data-product-id="<?= $prod['id'] ?>">
                    <div class="picture">
                        <img class="product-img" src="../assets/images/products/<?= $prod['img'] ?>.jpg">
                    </div>
                    <div class="product">
                        <div class="product-name"><?= $prod['name'] ?></div>
                        <div class="product-price">
                            <b style="color: red;"><?= number_format($prod['price']); ?></b> تومان
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