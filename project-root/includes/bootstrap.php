<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

const SHOP_DB_HOST = 'localhost';
const SHOP_DB_USER = 'root';
const SHOP_DB_PASS = '';
const SHOP_DB_NAME = 'shop_db';

function db(): mysqli
{
    static $conn = null;

    if ($conn instanceof mysqli) {
        return $conn;
    }

    $conn = new mysqli(SHOP_DB_HOST, SHOP_DB_USER, SHOP_DB_PASS, SHOP_DB_NAME);
    $conn->set_charset('utf8mb4');

    return $conn;
}

function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function jsonResponse(array $payload, int $statusCode = 200): never
{
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

function redirect(string $path): never
{
    header("Location: {$path}");
    exit;
}

function currentUser(): ?array
{
    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    return [
        'user_id' => (int) $_SESSION['user_id'],
        'r_name' => $_SESSION['r_name'] ?? '',
        'u_name' => $_SESSION['u_name'] ?? '',
        'email' => $_SESSION['email'] ?? '',
        'role' => (int) ($_SESSION['role'] ?? 0),
    ];
}

function isLoggedIn(): bool
{
    return currentUser() !== null;
}

function requireLogin(): array
{
    $user = currentUser();
    if ($user === null) {
        redirect('../main/login.php');
    }

    return $user;
}

function requireApiLogin(): array
{
    $user = currentUser();
    if ($user === null) {
        jsonResponse(['code' => 401, 'message' => 'ابتدا وارد حساب شوید.'], 401);
    }

    return $user;
}

function requireRole(array $allowedRoles): array
{
    $user = requireLogin();
    if (!in_array($user['role'], $allowedRoles, true)) {
        redirect('../main/index.php');
    }

    return $user;
}

function requireApiRole(array $allowedRoles): array
{
    $user = requireApiLogin();
    if (!in_array($user['role'], $allowedRoles, true)) {
        jsonResponse(['code' => 403, 'message' => 'دسترسی مجاز نیست.'], 403);
    }

    return $user;
}

function setAuthenticatedUser(array $user): void
{
    $_SESSION['user_id'] = (int) $user['user_id'];
    $_SESSION['r_name'] = $user['r_name'];
    $_SESSION['u_name'] = $user['u_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = (int) $user['role'];
}

function syncCurrentUserSession(int $userId): void
{
    $stmt = db()->prepare('SELECT user_id, r_name, u_name, email, role FROM users WHERE user_id = ? LIMIT 1');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        setAuthenticatedUser($user);
    }
}

function getCart(): array
{
    $cart = $_SESSION['cart'] ?? [];
    if (!is_array($cart)) {
        return [];
    }

    return array_values(array_filter(array_map('intval', $cart), static fn ($id) => $id > 0));
}

function addToCart(int $productId): void
{
    $cart = getCart();
    $cart[] = $productId;
    $_SESSION['cart'] = $cart;
}

function clearCart(): void
{
    unset($_SESSION['cart']);
}

function removeFromCart(int $productId): void
{
    $cart = array_values(array_filter(getCart(), static fn ($id) => $id !== $productId));
    $_SESSION['cart'] = $cart;
}

