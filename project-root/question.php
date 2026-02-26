<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/logoBakiRZ.png">
    <title>BakiRZ | Home</title>

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
    <?php include 'includes/header.php'; ?>

<main>

<center>
<h2>سوالات متداول</h2>

<div class="question">چگونه ثبت نام کنیم ؟</div>
<div class="answer">
    <p>
        در بالای صفحه گزینه ثبت نام را کلیک کنید و مشخصات خود را وارد کنید.
    </p>
</div>

<div class="question">چگونه سفارش ثبت کنیم ؟</div>
<div class="answer">
    <p>
        ابتدا محصول مورد نظر را به سبد خرید اضافه کرده و پس از پرداخت هزینه سفارش شما ثبت میشود .
    </p>
</div>

<div class="question">چقدر طول می‌کشد سفارش برسد ؟</div>
<div class="answer">
    <p>
        این عمل بسته به ترافیک های سفارش و مسیر دارد و نهایت امکان دارد
        <span>با 2 روز تاخیر</span>
        به دست شما برسد.
    </p>
</div>

<div class="question"> چگونه عمل پرداخت را انجام بدم ؟ </div>
<div class="answer">
    <p>
        پس از افزودن به سبد خرید از طریق درگاه بانکی میتوانید عمل پرداخت را انجام دهید .
    </p>
</div>

<div class="question"> هزینه ارسال در چه حدودی است ؟ </div>
<div class="answer">
    <p>
        هزینه ارسال بستگی به روز انتخابی شما دارد و اگر عجله ای در سفارش دارید حدود
        <span>100.000تومان</span>
        هزینه ارسال در نظر گرفته شده است.
    </p>
</div>

<div class="question"> پس از ثبت سفارش میتوانیم سفارش را لغو کنیم ؟ </div>
<div class="answer">
    <p>
        بله شما میتوانید تا
        <span>24 ساعت</span>
        پس از ثبت سفارش آن را لغو کنید.
    </p>
</div>

<div class="question"> چگونه با پشتیبان تماس بگیرم ؟ </div>
<div class="answer">
    <p>
        شما میتوانید با شماره گیری 09123456789 با پشتیبان این مجموعه در ارتباط باشید.
    </p>
</div>

<div class="question">امکان مرجوعی وجود دارد ؟</div>
<div class="answer">
    <p>
        بله شما میتوانید محصول را تا 2روز پس از رسیدن محصول به دستتان
        <span>در صورت سالم بودن</span>
        به ما برگردانید
    </p>
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

<?php include 'includes/footer.php'; ?>

    <script src="assets/js/jquery.main.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
