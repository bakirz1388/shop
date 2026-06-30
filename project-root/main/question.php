<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/logoBakiRZ.png">
    <title>BakiRZ | FAQ</title>

    <style>
    body {
        font-family: sans-serif;
        margin: auto;
        font-weight: bold;
    }

    center {
        text-align: right;
        position: relative;
        left: 25%;
        width: 55%;
        margin-top: 50px;
    }

    .question {
        user-select: none;
        cursor: pointer;
        background: #f2f2f2;
        padding: 10px;
        padding-left: 32px;
        margin-top: 5px;
        border-radius: 10px;
        position: relative;
    }

    .question::before {
        content: ">";
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%) rotate(0deg);
        transition: transform 0.3s ease;
    }

    .question.open::before {
        transform: translateY(-50%) rotate(90deg);
    }

    .answer {
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        padding: 0 10px;
        background: #fafafa;
        transition: max-height 0.35s ease, opacity 0.35s ease, padding 0.35s ease;
    }

    .answer.open {
        max-height: 250px;
        opacity: 1;
        padding: 10px;
    }

    span {
        color: red;
    }
</style>
</head>
<body>
    <?php include("../includes/header.php") ?>
<main>

<center>
<h2>سوالات متداول</h2>

<div class="question">چگونه ثبت نام کنیم؟</div>
<div class="answer">
    <p>از صفحه ورود، روی لینک ثبت نام بزنید و اطلاعات حساب را وارد کنید.</p>
</div>

<div class="question">چگونه سفارش ثبت کنیم؟</div>
<div class="answer">
    <p>محصول را به سبد خرید اضافه کنید و بعد از بررسی فاکتور، روی خرید نهایی بزنید.</p>
</div>

<div class="question">اگر موجودی تمام شود چه می‌شود؟</div>
<div class="answer">
    <p>سیستم هنگام خرید نهایی موجودی را دوباره بررسی می‌کند و اگر کالا تمام شده باشد ثبت سفارش انجام نمی‌شود.</p>
</div>

<div class="question">چگونه با پشتیبانی تماس بگیریم؟</div>
<div class="answer">
    <p>از صفحه تماس با ما می‌توانید با تلفن، ایمیل یا لینک واتساپ ارتباط بگیرید.</p>
</div>

<div class="question">آیا امکان توسعه بیشتر سایت وجود دارد؟</div>
<div class="answer">
    <p>بله. ساختار فعلی برای اضافه شدن جستجو، فیلتر، گزارش سفارش و پنل‌های کامل‌تر آماده‌تر شده است.</p>
</div>
</center>

<script>
    var q = document.querySelectorAll(".question");
    q.forEach(item => {
        item.addEventListener("click", () => {
            var a = item.nextElementSibling;
            a.classList.toggle("open");
            item.classList.toggle("open");
        });
    });
</script>
</main>

<?php include("../includes/footer.php") ?>

    <script src="../assets/js/jquery.main.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
