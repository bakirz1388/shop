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
                    <img id="seller-image-preview" class="seller-image-preview" alt="preview">
                    <textarea id="product-description" placeholder="توضیحات کوتاه محصول"></textarea>
                    <span class="error-msg"></span><br>
                    <button id="submit-product">افزودن محصول</button><br>
                </div>
            </section>
        </div>
    </main>

    <script src="assets/js/jquery.main.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // (function () {
        //     var storageKey = "bakirz_seller_products";
        //     var form = document.getElementById("seller-product-form");
        //     var nameInput = document.getElementById("product-name");
        //     var categoryInput = document.getElementById("product-category");
        //     var priceInput = document.getElementById("product-price");
        //     var stockInput = document.getElementById("product-stock");
        //     var imageInput = document.getElementById("product-image");
        //     var imagePreview = document.getElementById("seller-image-preview");
        //     var showPreviewBtn = document.getElementById("seller-show-preview");
        //     var cancelPageBtn = document.getElementById("seller-cancel-page");
        //     var descInput = document.getElementById("product-description");
        //     var feedback = document.getElementById("seller-feedback");
        //     var productsBox = document.getElementById("seller-products");
        //     var emptyState = document.getElementById("seller-empty");
        //     var count = document.getElementById("seller-count");
        //     var pendingImageData = "";

        //     function getProducts() {
        //         try {
        //             var data = JSON.parse(localStorage.getItem(storageKey) || "[]");
        //             return Array.isArray(data) ? data : [];
        //         } catch (e) {
        //             return [];
        //         }
        //     }

        //     function saveProducts(products) {
        //         localStorage.setItem(storageKey, JSON.stringify(products));
        //     }

        //     function setFeedback(message, type) {
        //         feedback.textContent = message;
        //         feedback.className = "seller-feedback " + (type || "");
        //     }

        //     function formatPrice(value) {
        //         return Number(value || 0).toLocaleString("fa-IR");
        //     }

        //     function escapeHtml(value) {
        //         return String(value)
        //             .replace(/&/g, "&amp;")
        //             .replace(/</g, "&lt;")
        //             .replace(/>/g, "&gt;")
        //             .replace(/"/g, "&quot;")
        //             .replace(/'/g, "&#039;");
        //     }

        //     function readImage(file) {
        //         return new Promise(function (resolve, reject) {
        //             var reader = new FileReader();
        //             reader.onload = function (event) { resolve(event.target.result); };
        //             reader.onerror = reject;
        //             reader.readAsDataURL(file);
        //         });
        //     }

        //     function renderProducts() {
        //         var products = getProducts();
        //         productsBox.innerHTML = "";
        //         count.textContent = products.length + " محصول";

        //         if (!products.length) {
        //             emptyState.style.display = "block";
        //             return;
        //         }

        //         emptyState.style.display = "none";
        //         products.forEach(function (item) {
        //             var wrapper = document.createElement("article");
        //             wrapper.className = "seller-item";
        //             wrapper.innerHTML =
        //                 '<img class="seller-item-image" src="' + escapeHtml(item.image || '') + '" alt="product">' +
        //                 '<div class="seller-item-top">' +
        //                 '<h3>' + escapeHtml(item.name) + '</h3>' +
        //                 '<span class="seller-pill">' + escapeHtml(item.category) + '</span>' +
        //                 '</div>' +
        //                 '<div class="seller-meta">' +
        //                 '<span>قیمت: ' + formatPrice(item.price) + ' تومان</span>' +
        //                 '<span>موجودی: ' + escapeHtml(item.stock) + '</span>' +
        //                 '</div>' +
        //                 '<p class="seller-desc">' + escapeHtml(item.description) + '</p>' +
        //                 '<div class="seller-actions">' +
        //                 '<button class="seller-delete" data-id="' + item.id + '">حذف محصول</button>' +
        //                 '</div>';
        //             productsBox.appendChild(wrapper);
        //         });
        //     }

        //     imageInput.addEventListener("change", function () {
        //         var file = imageInput.files && imageInput.files[0];
        //         if (!file) {
        //             pendingImageData = "";
        //             imagePreview.style.display = "none";
        //             imagePreview.removeAttribute("src");
        //             showPreviewBtn.disabled = true;
        //             return;
        //         }

        //         if (!file.type.startsWith("image/")) {
        //             setFeedback("فقط فایل تصویری مجاز است.", "error");
        //             imageInput.value = "";
        //             pendingImageData = "";
        //             imagePreview.style.display = "none";
        //             showPreviewBtn.disabled = true;
        //             return;
        //         }

        //         readImage(file).then(function (base64) {
        //             pendingImageData = base64;
        //             imagePreview.style.display = "none";
        //             imagePreview.removeAttribute("src");
        //             showPreviewBtn.disabled = false;
        //         });
        //     });

        //     showPreviewBtn.addEventListener("click", function () {
        //         if (!pendingImageData) {
        //             return;
        //         }
        //         imagePreview.src = pendingImageData;
        //         imagePreview.style.display = "block";
        //     });

        //     cancelPageBtn.addEventListener("click", function () {
        //         if (document.referrer) {
        //             window.history.back();
        //             return;
        //         }
        //         window.location.href = "../index.php";
        //     });

        //     form.addEventListener("submit", function (event) {
        //         event.preventDefault();
        //         setFeedback("", "");

        //         var name = nameInput.value.trim();
        //         var category = categoryInput.value.trim();
        //         var price = priceInput.value.trim();
        //         var stock = stockInput.value.trim();
        //         var description = descInput.value.trim();
        //         var imageFile = imageInput.files && imageInput.files[0];

        //         if (!name || !category || !price || !stock || !description || !imageFile) {
        //             setFeedback("همه فیلدها از جمله تصویر اجباری هستند.", "error");
        //             return;
        //         }

        //         if (!imageFile.type.startsWith("image/")) {
        //             setFeedback("فقط فایل تصویری مجاز است.", "error");
        //             return;
        //         }

        //         if (Number(price) <= 0 || Number(stock) < 0) {
        //             setFeedback("قیمت و موجودی معتبر وارد کنید.", "error");
        //             return;
        //         }

        //         readImage(imageFile).then(function (imageData) {
        //             var products = getProducts();
        //             products.unshift({
        //                 id: Date.now(),
        //                 name: name,
        //                 category: category,
        //                 price: Number(price),
        //                 stock: Number(stock),
        //                 description: description,
        //                 image: imageData
        //             });

        //             saveProducts(products);
        //             form.reset();
        //             pendingImageData = "";
        //             showPreviewBtn.disabled = true;
        //             imagePreview.style.display = "none";
        //             imagePreview.removeAttribute("src");
        //             setFeedback("محصول با موفقیت ثبت شد.", "success");
        //             renderProducts();
        //         });
        //     });

        //     productsBox.addEventListener("click", function (event) {
        //         if (!event.target.classList.contains("seller-delete")) {
        //             return;
        //         }

        //         var id = Number(event.target.getAttribute("data-id"));
        //         var products = getProducts().filter(function (item) {
        //             return item.id !== id;
        //         });

        //         saveProducts(products);
        //         renderProducts();
        //         setFeedback("محصول حذف شد.", "success");
        //     });

        //     renderProducts();
        // })();
    </script>
</body>

</html>
