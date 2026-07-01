<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/store.php';

$currentUser = requireRole([1]);
$users = fetchUsersExcept($currentUser['user_id']);
$products = fetchProducts(null, false);
$stats = getDashboardStats();
$orders = fetchOrdersForAdmin();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/logoBakiRZ.png">
    <title>BakiRZ | Admin Panel</title>
</head>

<body>
    <script>window.CSRF_TOKEN = <?= json_encode(csrfToken(), JSON_UNESCAPED_UNICODE) ?>;</script>

    <main class="admin-main" dir="rtl">
        <div class="container admin-layout">
            <aside class="admin-sidebar">
                <div class="admin-profile">
                    <h2>پنل مدیریت</h2>
                    <p>مدیریت فروشگاه BakiRZ</p>
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
                    <p>نمای کلی وضعیت فروش، محصول‌ها و کاربران</p>
                </div>

                <section class="admin-stats">
                    <article class="admin-stat-card">
                        <span class="admin-stat-title">کل سفارش‌ها</span>
                        <strong class="admin-stat-value"><?= number_format($stats['orders']) ?></strong>
                    </article>
                    <article class="admin-stat-card">
                        <span class="admin-stat-title">مجموع فروش</span>
                        <strong class="admin-stat-value"><?= number_format($stats['revenue']) ?></strong>
                    </article>
                    <article class="admin-stat-card">
                        <span class="admin-stat-title">تعداد کاربران</span>
                        <strong class="admin-stat-value"><?= number_format($stats['users']) ?></strong>
                    </article>
                    <article class="admin-stat-card">
                        <span class="admin-stat-title">موجودی کم</span>
                        <strong class="admin-stat-value"><?= number_format($stats['low_stock']) ?></strong>
                    </article>
                </section>

                <div class="admin-grid-2" id="orders">
                    <section class="admin-section">
                        <h3>آخرین سفارش‌ها</h3>
                        <ul class="admin-list">
                            <?php if ($orders === []): ?>
                                <li><span>هنوز سفارشی ثبت نشده است</span><span class="admin-badge badge-progress">خالی</span></li>
                            <?php else: ?>
                                <?php foreach ($orders as $order): ?>
                                    <li><span>#<?= $order['id'] ?> - <?= h($order['r_name']) ?> / <?= h($order['product_name']) ?></span><span class="admin-badge badge-progress"><?= ORDER_STATUS_LABELS[(int) $order['status']] ?? 'نامشخص' ?></span></li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ul>
                    </section>

                    <section class="admin-section" id="messages">
                        <h3>یادداشت‌های پنل</h3>
                        <ul class="admin-list">
                            <li><span>ثبت سفارش‌ها به‌صورت عملیاتی فعال شد.</span><span>جدید</span></li>
                            <li><span>نقش‌ها فقط توسط ادمین تغییر می‌کنند.</span><span>امنیت</span></li>
                            <li><span>برای فرم تماس و تیکت هنوز توسعه لازم است.</span><span>بعدی</span></li>
                            <li><span>در صورت نیاز می‌شود وضعیت سفارش هم اضافه کرد.</span><span>قابل توسعه</span></li>
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
                            <?php foreach ($products as $prod): ?>
                                <?php
                                if ((int) $prod['stock'] >= 10) {
                                    $status = "<td style='color: #00b315;'>موجود</td>";
                                } elseif ((int) $prod['stock'] >= 1) {
                                    $status = "<td style='color: #ff9900;'>رو به اتمام</td>";
                                } else {
                                    $status = "<td style='color: #ff0000;'>ناموجود</td>";
                                }
                                ?>
                                <tr>
                                    <td><?= h($prod['name']) ?></td>
                                    <td><?= h($prod['category']) ?></td>
                                    <td><?= number_format((int) $prod['price']) ?></td>
                                    <td><?= (int) $prod['stock'] ?></td>
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
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= h($user['r_name']) ?></td>
                                    <td><?= h($user['u_name']) ?></td>
                                    <td><?= h($user['email']) ?></td>
                                    <td><?= ROLE_LABELS[(int) $user['role']] ?? 'نامشخص' ?></td>
                                    <?php if ((int) $user['role'] === 1): ?>
                                        <td><button class="admin-user-btn demote-btn" data-id="<?= $user['user_id'] ?>" data-role="<?= $user['role'] ?>">عزل به فروشنده</button></td>
                                    <?php elseif ((int) $user['role'] === 2): ?>
                                        <td><button class="admin-user-btn demote-btn" data-id="<?= $user['user_id'] ?>" data-role="<?= $user['role'] ?>">عزل به کاربر</button></td>
                                    <?php else: ?>
                                        <td><button class="admin-user-btn promote-btn" data-id="<?= $user['user_id'] ?>" data-role="<?= $user['role'] ?>">ارتقا به فروشنده</button></td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </section>
        </div>
    </main>


    <script src="../assets/js/jquery.main.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>
