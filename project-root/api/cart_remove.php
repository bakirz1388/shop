<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

requireApiLogin();

$productId = (int) ($_POST['id'] ?? 0);
if ($productId <= 0) {
    jsonResponse(['code' => 422, 'message' => 'محصول نامعتبر است.'], 422);
}

removeFromCart($productId);

jsonResponse(['code' => 207, 'message' => 'محصول از سبد خرید حذف شد.', 'cartCount' => count(getCart())]);
