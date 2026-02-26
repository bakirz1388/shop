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
    
    <?php include 'includes/header.php'; ?>

<main class="auth-page">

    <div class="auth-container">
        <div class="auth-form active" id="login" method="POST" name="login">
            <h2>ورود به حساب</h2>
            <form>
                <input type="text" placeholder="نام کاربری" id="l-username">
                <input type="password" placeholder="رمز عبور" id="l-password">
                <a href="register.php"><strong>ایجاد حساب</strong></a><br>
                <span class="error-msg"></span><br>
                <button type="submit" class="auth-btn">ورود</button>
            </form>
        </div>
    </div>

</main>

<script src="assets/js/jquery.main.js"></script>
<script src="assets/js/main.js"></script>

<?php include 'includes/footer.php'; ?>

</body>
</html>