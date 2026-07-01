<?php

require_once __DIR__ . '/bootstrap.php';

$cartQty = getCart();
$user = currentUser();
$panel = '';

if ($user !== null) {
    if ($user['role'] === 1) {
        $panel = "<li>|</li><li><a href='../main/admin.php' target='_blank'>پنل ادمین</a></li><li>|</li><li><a href='../main/seller.php' target='_blank'>پنل فروشنده</a></li>";
    } elseif ($user['role'] === 2) {
        $panel = "<li>|</li><li><a href='../main/seller.php' target='_blank'>پنل فروشنده</a></li>";
    }
}
$csrfToken = csrfToken();
?>

<script>window.CSRF_TOKEN = <?= json_encode($csrfToken, JSON_UNESCAPED_UNICODE) ?>;</script>

<header class="main-header">
    <div class="top-bar">
        <div class="container">
            <div class="logo">
                <a href="../main/index.php"><img src="../assets/images/logoBakiRZ.png" alt="logoBakiRZ" class="logo-img"> BakiRZ</a>
            </div>

            <div class="search-box">
                <input type="text" placeholder="جستجو محصولات..." dir="rtl" disabled>
                <button type="button" aria-label="search">🔍</button>
            </div>

            <div class="header-actions">
                <?php if ($user !== null): ?>
                    <div class="username-header"><a href="../api/logout.php?csrf_token=<?= urlencode($csrfToken) ?>" id="singout-btn">↪</a> خوش آمدید <a href="./user-panel.php" target="_blank"><?= h($user['u_name']) ?></a></div>
                <?php else: ?>
                    <a href="../main/login.php" class="login-btn" target="_self">ورود | ثبت نام</a>
                <?php endif ?>
                <a href="../main/cart.php" target="_self" class="cart-btn">
                    🛒 <span class="cart-count"><?= count($cartQty) ?></span>
                </a>
            </div>
        </div>
    </div>

    <nav class="main-nav" dir="rtl">
        <div class="container">
            <ul>
                <li><a href="../main/index.php">خانه</a></li>
                <li>|</li>
                <li><a href="../main/products.php">محصولات</a></li>
                <li>|</li>
                <li><a href="../main/aboutus.php">درباره ما</a></li>
                <li>|</li>
                <li><a href="../main/question.php">سوالی دارید؟</a></li>
                <?= $panel ?>
            </ul>
        </div>
    </nav>
</header>
