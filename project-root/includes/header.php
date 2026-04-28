<?php 
session_start();
if (isset($_SESSION['u_name'])) {
    $username = $_SESSION['u_name'];
}
$isLoggedIn = false;
    if (isset($username))
        $isLoggedIn = true;

?>

<header class="main-header">
    <div class="top-bar">
        <div class="container">
            <div class="logo">
                <a href="./index.php"><img src="./assets/images/logoBakiRZ.png" alt="logoBakiRZ" class="logo-img"> BakiRZ</a>
            </div>

            <div class="search-box">
                <input type="text" placeholder="جستجو محصولات..." dir="rtl">
                <button>🔍</button>
            </div>

            <div class="header-actions">
                <?php if ($isLoggedIn): ?>
                    <div class="username-header">! خوش آمدید <a href=""><?= $username ?></a></div>
                <?php else: ?>
                    <a href="register.php" class="login-btn" target="_self">ورود | ثبت نام</a>
                <?php endif ?>
                <a href="cart.php" target="_blank" class="cart-btn">
                    🛒 <span class="cart-count">+10</span>
                </a>
            </div>
        </div>
    </div>

    <nav class="main-nav" dir="rtl">
        <div class="container">
            <ul>
                <li><a href="./index.php">خانه</a></li>
                <li>|</li>
                <li><a href="./products.php">محصولات</a></li>
                <li>|</li>
                <li><a href="#">پرفروش ترین محصولات</a></li>
                <li>|</li>
                <li><a href="question.php">سوالی دارید؟</a></li>
                <li>|</li>
                <li><a href="panel/index.php" target="_blank">پنل ادمین</a></li>
                <li>|</li>
                <li><a href="./seller.php" target="_blank">پنل فروشنده</a></li>
            </ul>
        </div>
    </nav>
</header>