<?php

// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // دریافت اطلاعات از Ajax
    $id = $_POST['product_id'] ?? '';
    $img = $_POST['product_img'] ?? '';
    $name = $_POST['product_name'] ?? '';
    $price = $_POST['product_price'] ?? '';
    $price_display = $_POST['price_display'] ?? '';
    
    // اعتبارسنجی ساده
    if (empty($id) || empty($name)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'اطلاعات محصول کامل نیست'
        ]);
        exit;
    }
    
    // ایجاد سبد خرید اگر وجود نداشت
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // بررسی کن ببین این محصول قبلاً توی سبد خرید هست یا نه
    $found = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            $_SESSION['cart'][$key]['quantity']++;
            $found = true;
            break;
        }
    }
    
    // اگه پیدا نشد، محصول جدید اضافه کن
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $id,
            'img' => $img,
            'name' => $name,
            'price' => $price,
            'price_display' => $price_display,
            'quantity' => 1
        ];
    }
    
    // محاسبه تعداد کل محصولات در سبد خرید
    $total_items = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_items += $item['quantity'];
    }
    
    // برگردوندن پاسخ موفق به Ajax
    echo json_encode([
        'status' => 'success',
        'message' => 'محصول با موفقیت به سبد خرید اضافه شد',
        'cart_count' => $total_items
    ]);
    exit;
}

$conn = new mysqli("localhost","root","","shop_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

// $data = json_decode(file_get_contents('php://input'), true);

// $productId = $data['productId'];
// $productImg = $data['productImg'];
// $productName = $data['productName'];
// $productPrice = $data['productPrice'];


// if(isset($_SESSION['add_to_cart'])) {
//     $product_id = $_SESSION['add_to_cart'];
    
//     if(!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = [];
//     }
    
//     if(isset($_SESSION['cart'][$product_id])) {
//         $_SESSION['cart'][$product_id]++;
//     } else {
//         $_SESSION['cart'][$product_id] = 1;
//     }
    
//     unset($_SESSION['add_to_cart']);
    
//     echo "محصول با ID: " . $product_id . " به سبد خرید اضافه شد";
// }


?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/logoBakiRZ.png">
    <title>BakiRZ | Cart</title>
</head>
<body>
    <?php include("../includes/header.php") ?>
    <main>
        <h2>🛒 سبد خرید</h2>

<?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <span><?= count($_SESSION['cart']) ?> محصول</span>
            <?php endif; ?>
        </div>
        
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <div class="cart-items">
                <?php 
                $total = 0;
                foreach($_SESSION['cart'] as $index => $item): 
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                ?>
                <div class="cart-item" data-id="<?= $item['id'] ?>" data-index="<?= $index ?>">
                    <img class="cart-item-img" src="../assets/images/products/<?= htmlspecialchars($item['img']) ?>.jpg" alt="<?= htmlspecialchars($item['name']) ?>">
                    
                    <div class="cart-item-details">
                        <div class="cart-item-name"><?= htmlspecialchars($item['name']) ?></div>
                        <div class="cart-item-price"><?= number_format($item['price']) ?> تومان</div>
                    </div>
                    
                    <div class="cart-item-quantity">
                        <button class="quantity-btn" onclick="updateQuantity(<?= $item['id'] ?>, 'decrease')">-</button>
                        <span class="quantity-number" id="qty-<?= $item['id'] ?>"><?= $item['quantity'] ?></span>
                        <button class="quantity-btn" onclick="updateQuantity(<?= $item['id'] ?>, 'increase')">+</button>
                    </div>
                    
                    <button class="cart-item-remove" onclick="removeItem(<?= $item['id'] ?>)">🗑️ حذف</button>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <div class="cart-total">
                    <span>مجموع سبد خرید:</span>
                    <span class="cart-total-price" id="cart-total"><?= number_format($total) ?></span>
                    <span>تومان</span>
                </div>
                <button class="checkout-btn" onclick="alert('در حال هدایت به درگاه پرداخت...')">✅ ثبت سفارش و پرداخت</button>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <div class="empty-cart-icon">🛍️</div>
                <div class="empty-cart-text">سبد خرید شما خالی است</div>
                <a href="../product.php" class="continue-shopping">← شروع خرید</a>
            </div>
        <?php endif; ?>
    </main>
    <?php include("../includes/footer.php") ?>
</body>
</html>
