<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/logoBakiRZ.png">
    <title>BakiRZ | Login</title>
</head>
<body>
    
    <?php include 'includes/header.php'; ?>

<main class="auth-page">

    <div class="auth-container">

        <div class="auth-tabs">
            <button class="tab-btn active" data-tab="login">ورود</button>
            <button class="tab-btn" data-tab="register">ثبت نام</button>
        </div>

        <!-- LOGIN -->
        <div class="auth-form active" id="login" method="POST" name="login">
            <h2>ورود به حساب</h2>
            <form>
                <input type="text" placeholder="نام کاربری" id="1">
                <input type="password" placeholder="رمز عبور" id="2">
                <button type="submit" class="auth-btn">ورود</button>
            </form>
        </div>
        <div id="toast" class="toast"></div>
        <!-- REGISTER -->
        <div class="auth-form" id="register">
            <h2>ایجاد حساب کاربری</h2>
            <form action="api/login_action.php" method="POST" name="register">
                <input type="text" placeholder="نام کامل">
                <input type="text" placeholder="نام کاربری">
                <input type="email" placeholder="ایمیل">
                <input type="password" placeholder="رمز عبور">
                <input type="password" placeholder="تکرار رمز عبور">
                <button type="submit" class="auth-btn">ثبت نام</button>
            </form>
        </div>
        <div id="toast" class="toast"></div>
    </div>

</main>

<script src="assets/js/jquery.main.js"></script>
<script src="assets/js/main.js"></script>

<?php include 'includes/footer.php'; ?>

</body>
</html>