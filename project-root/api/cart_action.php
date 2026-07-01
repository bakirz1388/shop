<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/store.php';

requireApiLogin();
requireCsrfToken();

$productId = (int) ($_POST['id'] ?? 0);
if ($productId <= 0) {
    jsonResponse(['code' => 422, 'message' => 'محصول نامعتبر است.'], 422);
}

$product = fetchProductById($productId);
if (!$product || (int) $product['status'] <= 0) {
    jsonResponse(['code' => 404, 'message' => 'محصول پیدا نشد.'], 404);
}

if ((int) $product['stock'] <= 0) {
    jsonResponse(['code' => 409, 'message' => 'این محصول موجود نیست.'], 409);
}

addToCart($productId);

jsonResponse(['code' => 405, 'message' => 'محصول به سبد خرید اضافه شد.', 'cartCount' => count(getCart())]);
