<?php 

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$role = "SELECT * FROM users";

$r_result = mysqli_query($conn,$role);
$r_row = mysqli_fetch_array($r_result);



session_start();
if (isset($_SESSION['u_name'])) {
    $username = $_SESSION['u_name'];
}
$isLoggedIn = false;
    if (isset($username))
        $isLoggedIn = true;

    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 1) {
            $panel = "<li>|</li><li><a href='../main/admin.php' target='_blank'>پنل ادمین</a></li><li>|</li><li><a href='../main/seller.php' target='_blank'>پنل فروشنده</a></li>";
        }elseif ($_SESSION['role'] == 2) {
            $panel = "<li>|</li><li><a href='../main/seller.php' target='_blank'>پنل فروشنده</a></li>";
        }else {
            $panel = "";
        }
    }

$conn->close();



?>

<header class="main-header">
    <div class="top-bar">
        <div class="container">
            <div class="logo">
                <a href="../main/index.php"><img src="../assets/images/logoBakiRZ.png" alt="logoBakiRZ" class="logo-img"> BakiRZ</a>
            </div>

            <div class="search-box">
                <input type="text" placeholder="جستجو محصولات... (کار نمیکند)" dir="rtl">
                <button>🔍</button>
            </div>

            <div class="header-actions">
                <?php if ($isLoggedIn): ?>
                    <div class="username-header"><a href="../api/logout.php" id="singout-btn">↪</a>  ! خوش آمدید <a href="./user-panel.php" target="_blank"><?= $username ?></a></div>
                <?php else: ?>
                    <a href="../main/login.php" class="login-btn" target="_self">ورود | ثبت نام</a>
                <?php endif ?>
                <a href="../main/cart.php" target="_blank" class="cart-btn">
                    🛒 <span class="cart-count">+10</span>
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
                <li><a href="#">محصولات تخفیفی %</a></li>
                <li>|</li>
                <li><a href="../main/question.php">سوالی دارید؟</a></li>
                <?php if(isset($panel))
                    echo($panel); ?>
            </ul>
        </div>
    </nav>
</header>