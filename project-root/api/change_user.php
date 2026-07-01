<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/store.php';

$user = requireApiLogin();
requireCsrfToken();

$data = json_decode(file_get_contents('php://input'), true) ?? [];

$realname = trim((string) ($data['realname'] ?? ''));
$username = trim((string) ($data['username'] ?? ''));
$email = trim((string) ($data['email'] ?? ''));
$password = (string) ($data['password'] ?? '');

if ($realname === '' || $username === '' || $email === '') {
    jsonResponse(['code' => 422, 'message' => 'فیلدها نباید خالی باشند.'], 422);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(['code' => 422, 'message' => 'ایمیل معتبر نیست.'], 422);
}

if ($password !== '' && mb_strlen($password) < 8) {
    jsonResponse(['code' => 422, 'message' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.'], 422);
}

$currentRecord = fetchUserById($user['user_id']);
if (!$currentRecord) {
    jsonResponse(['code' => 404, 'message' => 'کاربر پیدا نشد.'], 404);
}

if ($user['u_name'] !== $username) {
    $checkStmt = db()->prepare('SELECT user_id FROM users WHERE u_name = ? LIMIT 1');
    $checkStmt->bind_param('s', $username);
    $checkStmt->execute();
    $exists = $checkStmt->get_result()->fetch_assoc();
    $checkStmt->close();

    if ($exists) {
        jsonResponse(['code' => 508, 'message' => 'این نام کاربری تکراری است.'], 409);
    }
}

$finalPassword = $currentRecord['pass'];
if ($password !== '') {
    $finalPassword = password_hash($password, PASSWORD_DEFAULT);
}

$stmt = db()->prepare('UPDATE users SET r_name = ?, u_name = ?, email = ?, pass = ? WHERE user_id = ?');
$stmt->bind_param('ssssi', $realname, $username, $email, $finalPassword, $user['user_id']);
$stmt->execute();
$stmt->close();

syncCurrentUserSession($user['user_id']);

jsonResponse(['code' => 400, 'message' => 'اطلاعات کاربری به‌روزرسانی شد.']);
