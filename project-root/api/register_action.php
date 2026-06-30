<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];

$realname = trim((string) ($data['realname'] ?? ''));
$username = trim((string) ($data['username'] ?? ''));
$password = (string) ($data['password'] ?? '');
$email = trim((string) ($data['email'] ?? ''));

if ($realname === '' || $username === '' || $password === '' || $email === '') {
    jsonResponse(['code' => 422, 'message' => 'تمام فیلدها الزامی هستند.'], 422);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(['code' => 422, 'message' => 'ایمیل معتبر نیست.'], 422);
}

$checkStmt = db()->prepare('SELECT user_id FROM users WHERE u_name = ? LIMIT 1');
$checkStmt->bind_param('s', $username);
$checkStmt->execute();
$exists = $checkStmt->get_result()->fetch_assoc();
$checkStmt->close();

if ($exists) {
    jsonResponse(['code' => 500, 'message' => 'این نام کاربری قبلا استفاده شده است.'], 409);
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$role = 0;

$stmt = db()->prepare('INSERT INTO users (r_name, u_name, pass, email, role) VALUES (?, ?, ?, ?, ?)');
$stmt->bind_param('ssssi', $realname, $username, $hashedPassword, $email, $role);
$stmt->execute();
$stmt->close();

jsonResponse(['code' => 400, 'message' => 'حساب کاربری با موفقیت ساخته شد.']);
