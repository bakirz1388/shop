<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/logoBakiRZ.png">
    <title>BakiRZ | Login</title>
</head>
<body>
<?php include("includes/header.php") ?>

<main class="auth-page">

    <div class="auth-container">
        <div class="auth-form active" id="login" method="POST" name="login">
            <h2>ایجاد حساب</h2>
            <div id="register-form">
                <input type="text" placeholder="نام کامل" id="realname">
                <input type="text" placeholder="نام کاربری" id="r-username">
                <input type="email" placeholder="ایمیل" id="email">
                <input type="password" placeholder="رمز عبور" id="r-password">
                <input type="password" placeholder="تکرار رمز عبور" id="repassword">
                <a href="login.php"><b>ورود به حساب</b></a><br>
                <span class="error-msg"></span><br>
                <button class="auth-btn" id="register-btn">ایجاد</button>
            </div>
        </div>
    </div>

</main>

<script src="assets/js/jquery.main.js"></script>
<script src="assets/js/main.js"></script>

<?php include("includes/footer.php") ?>

</body>
</html>
