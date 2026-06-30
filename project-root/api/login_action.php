<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

$data = json_decode(file_get_contents('php://input'), true) ?? [];

$username = trim((string) ($data['username'] ?? ''));
$password = (string) ($data['password'] ?? '');

if ($username === '' || $password === '') {
    jsonResponse(['code' => 422, 'message' => 'نام کاربری و رمز عبور الزامی است.'], 422);
}

$stmt = db()->prepare('SELECT user_id, r_name, u_name, email, pass, role FROM users WHERE u_name = ? LIMIT 1');
$stmt->bind_param('s', $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    jsonResponse(['code' => 502, 'message' => 'نام کاربری یا رمز عبور اشتباه است.'], 401);
}

$storedPassword = (string) $user['pass'];
$passwordMatches = password_verify($password, $storedPassword) || hash_equals($storedPassword, $password);

if (!$passwordMatches) {
    jsonResponse(['code' => 502, 'message' => 'نام کاربری یا رمز عبور اشتباه است.'], 401);
}

if (!password_get_info($storedPassword)['algo']) {
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    $updateStmt = db()->prepare('UPDATE users SET pass = ? WHERE user_id = ?');
    $updateStmt->bind_param('si', $newHash, $user['user_id']);
    $updateStmt->execute();
    $updateStmt->close();
    $user['pass'] = $newHash;
}

setAuthenticatedUser($user);

jsonResponse(['code' => 401, 'message' => 'ورود با موفقیت انجام شد.']);
