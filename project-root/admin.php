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
                    <li><a href="#products">مدیریت محصولات</a></li>
                    <li><a href="#messages">پیام‌های کاربران</a></li>
                    <li><a href="#add-product">افزودن محصول جدید</a></li>
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
                        <tbody>
                            <tr><td>هدفون بی سیم X200</td><td>دیجیتال</td><td>2,850,000</td><td>24</td><td><span class="admin-badge badge-done">فعال</span></td></tr>
                            <tr><td>تی شرت مردانه Simple</td><td>پوشاک</td><td>420,000</td><td>8</td><td><span class="admin-badge badge-progress">کم موجود</span></td></tr>
                            <tr><td>کیف دوشی Urban</td><td>اکسسوری</td><td>1,190,000</td><td>0</td><td><span class="admin-badge badge-canceled">ناموجود</span></td></tr>
                            <tr><td>اسپیکر قابل حمل Mini</td><td>دیجیتال</td><td>980,000</td><td>13</td><td><span class="admin-badge badge-done">فعال</span></td></tr>
                        </tbody>
                    </table>
                </section>

                <section class="admin-table-wrap" id="users">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>نام کاربر</th>
                                <th>نام کاربری</th>
                                <th>نقش فعلی</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody id="admin-users-body"></tbody>
                    </table>
                </section>

                <div class="admin-grid-2">
                    <section class="admin-activity">
                        <h3>فعالیت‌های اخیر</h3>
                        <ul class="admin-timeline">
                            <li>محصول جدید ثبت شد: ساعت هوشمند Z9 <span>امروز، 09:12</span></li>
                            <li>سفارش #2402 تایید و به انبار ارسال شد <span>امروز، 10:25</span></li>
                            <li>کاربر جدید ثبت نام کرد: مریم عزیزی <span>امروز، 11:03</span></li>
                            <li>تیکت پشتیبانی #891 پاسخ داده شد <span>امروز، 11:40</span></li>
                        </ul>
                    </section>

                    <section class="admin-form-wrap" id="add-product">
                        <h3>افزودن محصول جدید</h3>
                        <form class="admin-form">
                            <input type="text" placeholder="نام محصول">
                            <select>
                                <option>انتخاب دسته بندی</option>
                                <option>دیجیتال</option>
                                <option>پوشاک</option>
                                <option>اکسسوری</option>
                            </select>
                            <input type="number" placeholder="قیمت">
                            <input type="number" placeholder="موجودی">
                            <input type="file" id="admin-product-image" accept="image/*">
                            <div class="admin-preview-actions">
                                <button type="button" id="admin-show-preview" class="preview-btn" disabled>نمایش پیش‌نمایش</button>
                                <button type="button" id="admin-cancel-page" class="cancel-btn">انصراف</button>
                            </div>
                            <img id="admin-image-preview" class="admin-image-preview" alt="preview">
                            <textarea placeholder="توضیحات محصول"></textarea>
                            <button type="button">ثبت محصول</button>
                        </form>
                    </section>
                </div>
            </section>
        </div>
    </main>

    <script>
        (function () {
            var input = document.getElementById("admin-product-image");
            var preview = document.getElementById("admin-image-preview");
            var showBtn = document.getElementById("admin-show-preview");
            var cancelBtn = document.getElementById("admin-cancel-page");
            var previewData = "";

            if (input && preview && showBtn && cancelBtn) {
                input.addEventListener("change", function () {
                    var file = input.files && input.files[0];
                    if (!file) {
                        previewData = "";
                        preview.style.display = "none";
                        preview.removeAttribute("src");
                        showBtn.disabled = true;
                        return;
                    }

                    if (!file.type.startsWith("image/")) {
                        input.value = "";
                        previewData = "";
                        preview.style.display = "none";
                        showBtn.disabled = true;
                        return;
                    }

                    var reader = new FileReader();
                    reader.onload = function (event) {
                        previewData = event.target.result;
                        preview.style.display = "none";
                        preview.removeAttribute("src");
                        showBtn.disabled = false;
                    };
                    reader.readAsDataURL(file);
                });

                showBtn.addEventListener("click", function () {
                    if (!previewData) return;
                    preview.src = previewData;
                    preview.style.display = "block";
                });

                cancelBtn.addEventListener("click", function () {
                    if (document.referrer) {
                        window.history.back();
                        return;
                    }
                    window.location.href = "../index.php";
                });
            }

            var usersKey = "bakirz_admin_users";
            var usersBody = document.getElementById("admin-users-body");

            function getUsers() {
                try {
                    var saved = JSON.parse(localStorage.getItem(usersKey) || "[]");
                    if (Array.isArray(saved) && saved.length) return saved;
                } catch (e) { }

                return [
                    { id: 1, name: "علی محمدی", username: "ali.m", role: "customer" },
                    { id: 2, name: "سارا نوری", username: "sara.n", role: "seller" },
                    { id: 3, name: "نگار قاسمی", username: "negar.q", role: "customer" },
                    { id: 4, name: "حامد صادقی", username: "hamed.s", role: "customer" }
                ];
            }

            function saveUsers(users) {
                localStorage.setItem(usersKey, JSON.stringify(users));
            }

            function roleLabel(role) {
                return role === "seller" ? "فروشنده" : "کاربر عادی";
            }

            function renderUsers() {
                if (!usersBody) return;
                var users = getUsers();
                usersBody.innerHTML = "";

                users.forEach(function (user) {
                    var tr = document.createElement("tr");
                    var roleClass = user.role === "seller" ? "role-seller" : "role-customer";
                    var actionHtml = user.role === "seller"
                        ? '<button class="admin-user-btn demote-btn" data-id="' + user.id + '" data-action="demote">عزل از فروشنده</button>'
                        : '<button class="admin-user-btn promote-btn" data-id="' + user.id + '" data-action="promote">ارتقا به فروشنده</button>';

                    tr.innerHTML =
                        "<td>" + user.name + "</td>" +
                        "<td>" + user.username + "</td>" +
                        '<td><span class="admin-user-role ' + roleClass + '">' + roleLabel(user.role) + "</span></td>" +
                        '<td><div class="admin-user-actions">' + actionHtml + "</div></td>";
                    usersBody.appendChild(tr);
                });
            }

            if (usersBody) {
                usersBody.addEventListener("click", function (event) {
                    var btn = event.target.closest(".admin-user-btn");
                    if (!btn) return;

                    var id = Number(btn.getAttribute("data-id"));
                    var action = btn.getAttribute("data-action");
                    var users = getUsers();

                    users = users.map(function (user) {
                        if (user.id !== id) return user;
                        if (action === "promote") user.role = "seller";
                        if (action === "demote") user.role = "customer";
                        return user;
                    });

                    saveUsers(users);
                    renderUsers();
                });
            }

            renderUsers();
        })();
    </script>
</body>

</html>
