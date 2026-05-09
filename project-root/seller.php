<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/logoBakiRZ.png">
    <title>BakiRZ | Seller Panel</title>
</head>

<body>
    <main class="seller-main" dir="rtl">
        <div class="container seller-layout">
            <section class="seller-card seller-form-wrap">
                <h1>پنل فروشنده</h1>
                <p>محصول جدید را ثبت کن تا در لیست محصولات نمایش داده شود.</p>

                <div id="seller-product-form" class="seller-form">
                    <input type="text" id="product-name" placeholder="نام محصول">
                    <select id="product-category">
                        <option value="0">انتخاب دسته بندی</option>
                        <option value="Digital">دیجیتال</option>
                        <option value="Gaming">گیمینگ</option>
                        <option value="Clothing">پوشاک</option>
                        <option value="Accessory">اکسسوری</option>
                        <option value="Appliances">خانه و آشپزخانه</option>
                    </select>
                    <input type="number" id="product-price" placeholder="قیمت (تومان)">
                    <input type="number" id="product-stock" placeholder="موجودی">
                    <input type="file" id="product-image" accept="image/*jpg">
                    <strong style="color:red;">  برای بهتر دیده شدن عکس ها در بخش محصولات، بهتر است که اندازه فایل ( 1x1 ) باشد</strong>
                    <textarea id="product-description" placeholder="توضیحات کوتاه محصول"></textarea>
                    <span class="error-msg"></span><br>
                    <button id="submit-product">افزودن محصول</button><br>
                </div>
            </section>
        </div>
    </main>

    <script src="assets/js/jquery.main.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
