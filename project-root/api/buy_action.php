<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/store.php';

$user = requireApiLogin();
$summary = cartSummary();
$items = $summary['items'];

if ($items === []) {
    jsonResponse(['code' => 422, 'message' => 'سبد خرید شما خالی است.'], 422);
}

$conn = db();
$conn->begin_transaction();

try {
    $insertOrderStmt = $conn->prepare('INSERT INTO orders (user_id, product_id, status) VALUES (?, ?, 0)');
    $updateStockStmt = $conn->prepare('UPDATE products SET stock = stock - 1 WHERE id = ? AND stock > 0');

    foreach ($items as $item) {
        $productId = (int) $item['id'];

        $updateStockStmt->bind_param('i', $productId);
        $updateStockStmt->execute();

        if ($updateStockStmt->affected_rows !== 1) {
            throw new RuntimeException('out_of_stock');
        }

        $insertOrderStmt->bind_param('ii', $user['user_id'], $productId);
        $insertOrderStmt->execute();
    }

    $insertOrderStmt->close();
    $updateStockStmt->close();
    $conn->commit();
    clearCart();

    jsonResponse([
        'code' => 200,
        'message' => 'خرید با موفقیت ثبت شد.',
        'total' => $summary['total'],
        'count' => count($items),
    ]);
} catch (Throwable $exception) {
    $conn->rollback();
    jsonResponse([
        'code' => $exception->getMessage() === 'out_of_stock' ? 409 : 500,
        'message' => $exception->getMessage() === 'out_of_stock'
            ? 'یکی از کالاها دیگر موجود نیست. سبد خرید را بررسی کنید.'
            : 'ثبت سفارش با خطا مواجه شد.',
    ], $exception->getMessage() === 'out_of_stock' ? 409 : 500);
}
