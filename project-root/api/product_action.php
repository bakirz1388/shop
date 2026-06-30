<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

requireApiRole([1, 2]);

$name = trim((string) ($_POST['name'] ?? ''));
$category = trim((string) ($_POST['category'] ?? ''));
$price = (int) ($_POST['price'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);
$description = trim((string) ($_POST['description'] ?? ''));
$allowedCategories = ['Digital', 'Gaming', 'Clothing', 'Accessory', 'Appliances'];

if ($name === '' || $description === '' || !in_array($category, $allowedCategories, true) || $price <= 0 || $stock < 0) {
    jsonResponse(['code' => 422, 'message' => 'اطلاعات محصول معتبر نیست.'], 422);
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    jsonResponse(['code' => 422, 'message' => 'تصویر محصول الزامی است.'], 422);
}

$file = $_FILES['file'];
$mimeType = mime_content_type($file['tmp_name']) ?: '';
$allowedMimeTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
];

if (!isset($allowedMimeTypes[$mimeType])) {
    jsonResponse(['code' => 422, 'message' => 'فرمت تصویر باید jpg، png یا webp باشد.'], 422);
}

$extension = $allowedMimeTypes[$mimeType];
$fileName = 'product' . time() . random_int(100, 999) . '.' . $extension;
$targetDir = __DIR__ . '/../assets/images/products/';
$targetFile = $targetDir . $fileName;

if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
    jsonResponse(['code' => 500, 'message' => 'آپلود تصویر انجام نشد.'], 500);
}

$status = 1;
$hot = 0;
$new = 1;

$stmt = db()->prepare('INSERT INTO products (name, category, price, stock, img, description, status, hot, new) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->bind_param('ssiissiii', $name, $category, $price, $stock, $fileName, $description, $status, $hot, $new);
$stmt->execute();
$stmt->close();

jsonResponse(['code' => 400, 'message' => 'محصول با موفقیت ثبت شد.']);
