<?php

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

$users = "SELECT * FROM users";

$u_result = mysqli_query($conn,$users);
$u_row = mysqli_fetch_array($u_result);


$products = "SELECT * FROM products";

$p_result = mysqli_query($conn,$products);
$p_row = mysqli_fetch_array($p_result);

$conn->close();

?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/logoBakiRZ.png">
    <title>BakiRZ | Admin Panel</title>
</head>

<body>

    <main class="admin-main" dir="rtl">
        <div class="container admin-layout">
            <aside class="admin-sidebar">
                <div class="admin-profile">
                    <h2>پنل مدیریت</h2>
                    <p>مدیر کل فروشگاه BakiRZ</p>
                </div>

                <ul class="admin-menu">
                    <li><a href="#dashboard" class="active">داشبورد</a></li>
                    <li><a href="#orders">مدیریت سفارش‌ها</a></li>
                    <li><a href="#products">محصولات</a></li>
                    <li><a href="#users">کاربران</a></li>
                </ul>
            </aside>

            <section class="admin-content">
                <div class="admin-header" id="dashboard">
                    <h1>داشبورد ادمین</h1>
                    <p>نمای کلی وضعیت فروش، سفارش‌ها و فعالیت کاربران</p>
                </div>

                <section class="admin-stats">
                    <article class="admin-stat-card">
                        <span class="admin-stat-title">کل سفارش‌ها</span>
                        <strong class="admin-stat-value">1,284</strong>
                    </article>
                    <article class="admin-stat-card">
                        <span class="admin-stat-title">درآمد امروز</span>
                        <strong class="admin-stat-value">14.8M</strong>
                    </article>
                    <article class="admin-stat-card">
                        <span class="admin-stat-title">کاربران جدید</span>
                        <strong class="admin-stat-value">43</strong>
                    </article>
                    <article class="admin-stat-card">
                        <span class="admin-stat-title">موجودی کم</span>
                        <strong class="admin-stat-value">7</strong>
                    </article>
                </section>

                <div class="admin-grid-2" id="orders">
                    <section class="admin-section">
                        <h3>آخرین سفارش‌ها</h3>
                        <ul class="admin-list">
                            <li><span>#2401 - علی محمدی</span><span class="admin-badge badge-done">تحویل شده</span></li>
                            <li><span>#2402 - سارا نوری</span><span class="admin-badge badge-progress">در حال ارسال</span></li>
                            <li><span>#2403 - حامد صادقی</span><span class="admin-badge badge-canceled">لغو شده</span></li>
                            <li><span>#2404 - نگار قاسمی</span><span class="admin-badge badge-progress">آماده سازی</span></li>
                        </ul>
                    </section>

                    <section class="admin-section" id="messages">
                        <h3>پیام‌های جدید کاربران</h3>
                        <ul class="admin-list">
                            <li><span>پیگیری سفارش #2398</span><span>2 دقیقه پیش</span></li>
                            <li><span>سوال درباره هزینه ارسال</span><span>18 دقیقه پیش</span></li>
                            <li><span>درخواست مرجوعی کالا</span><span>46 دقیقه پیش</span></li>
                            <li><span>مشکل در پرداخت آنلاین</span><span>1 ساعت پیش</span></li>
                        </ul>
                    </section>
                </div>

                <section class="admin-table-wrap" id="products">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>نام محصول</th>
                                <th>دسته بندی</th>
                                <th>قیمت (تومان)</th>
                                <th>موجودی</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody id="admin-product-body">
                            <?php foreach ($p_result as $prod): ?>
                                <?php if ($prod['stock'] >= 10) {
                                        $status = "<td style='color: #00b315;'>موجود</td>";
                                    }if ($prod['stock'] <= 5) {
                                        $status = "<td style='color: #ff9900;'>رو به اتمام</td>";
                                    }if ($prod['stock'] == 0) {
                                        $status = "<td style='color: #ff0000;'>ناموجود</td>";
                                    }
                                ?>
                                <tr>
                                    <td><?= $prod['name'] ?></td>
                                    <td><?= $prod['category'] ?></td>
                                    <td><?= number_format($prod['price']) ?></td>
                                    <td><?= $prod['stock'] ?></td>
                                    <?= $status ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </section>

                <section class="admin-table-wrap" id="users">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>نام کاربر</th>
                                <th>نام کاربری</th>
                                <th>ایمیل</th>
                                <th>نقش فعلی</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody id="admin-users-body">
                            <?php foreach($u_result as $user): ?>
                                <?php if($user['role'] == 0){
                                    $role = "کاربر";
                                }elseif ($user['role'] == 1) {
                                    $role = "مدیر";
                                }elseif ($user['role'] == 2) {
                                    $role = "فروشنده";  
                                }
                                if ($user['role'] == 0) {
                                    $rank = "promote-btn";
                                }if ($user['role'] == 1) {
                                    $rank = "demote-btn";
                                }if ($user['role'] == 2) {
                                    $rank = "demote-btn";
                                }
                            ?>
                                <tr>
                                    <td><?= $user['r_name'] ?></td>
                                    <td><?= $user['u_name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $role ?></td>
                                    <td><span id="test" class="admin-user-btn <?= $rank ?>"><?php if($role == "مدیر"):?>
                                        <?= "عزل به فروشنده" ?>
                                    <?php elseif($role == "فروشنده"):?>
                                        <?= "عزل به کاربر" ?>
                                    <?php elseif($role == "کاربر"):?>
                                        <?= "ارتقا به فروشنده" ?>
                                    <?php endif ?>
                                    </span></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </section>
        </div>
    </main>


    <script src="assets/js/jquery.main.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
