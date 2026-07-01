<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

$currentAdmin = requireApiRole([1]);
requireCsrfToken();

$userId = (int) ($_POST['user_id'] ?? 0);
$role = (int) ($_POST['role'] ?? -1);

if ($userId <= 0 || !in_array($role, [0, 1, 2], true)) {
    jsonResponse(['code' => 422, 'message' => 'درخواست نامعتبر است.'], 422);
}

if ($userId === $currentAdmin['user_id']) {
    jsonResponse(['code' => 409, 'message' => 'نمی‌توانید نقش خودتان را تغییر دهید.'], 409);
}

$changeTo = match ($role) {
    0, 1 => 2,
    2 => 0,
};

$stmt = db()->prepare('UPDATE users SET role = ? WHERE user_id = ?');
$stmt->bind_param('ii', $changeTo, $userId);
$stmt->execute();
$stmt->close();

jsonResponse(['code' => 406, 'message' => 'نقش کاربر به‌روزرسانی شد.']);
