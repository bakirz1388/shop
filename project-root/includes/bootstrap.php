<?php

declare(strict_types=1);

// --- Error handling hardening -------------------------------------------
// Never leak stack traces / SQL errors to visitors. Log them instead.
ini_set('display_errors', '0');
ini_set('log_errors', '1');

// --- Session cookie hardening --------------------------------------------
// Must run BEFORE session_start(). Marks the cookie HttpOnly (no JS access,
// blocks a big chunk of XSS-driven session theft), SameSite=Lax (blocks the
// cookie being sent on most cross-site/CSRF requests), and Secure whenever
// the site is actually served over HTTPS.
if (session_status() !== PHP_SESSION_ACTIVE) {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['SERVER_PORT'] ?? '') === '443')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// --- Baseline security headers -------------------------------------------
// Sent on every request (pages and API responses alike).
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; frame-ancestors 'self'; object-src 'none'; base-uri 'self'; form-action 'self'");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

const SHOP_DB_HOST = 'localhost';
const SHOP_DB_USER = 'root';
const SHOP_DB_PASS = '';
const SHOP_DB_NAME = 'shop_db_v2';

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

/**
 * CSRF protection
 * ----------------
 * A random token is generated once per session and embedded into every page
 * that triggers a state-changing request (via a small inline script, see
 * includes/header.php / main/admin.php / main/seller.php). The front-end
 * (assets/js/main.js) automatically attaches it as an X-CSRF-Token header on
 * every AJAX POST. Every API endpoint that changes data calls
 * requireCsrfToken() before doing anything else.
 */
function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function requireCsrfToken(): void
{
    $submitted = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? ($_GET['csrf_token'] ?? ''));
    $expected = $_SESSION['csrf_token'] ?? '';

    if ($submitted === '' || $expected === '' || !hash_equals($expected, $submitted)) {
        jsonResponse(['code' => 403, 'message' => 'درخواست نامعتبر است. لطفا صفحه را رفرش کنید.'], 403);
    }
}

/**
 * Very small brute-force throttle for login attempts, keyed by IP address
 * and stored in the database so it can't be bypassed by simply clearing
 * cookies. See db/security_migration.sql for the required table.
 */
function tooManyLoginAttempts(string $ip): bool
{
    $stmt = db()->prepare('SELECT COUNT(*) AS aggregate FROM login_attempts WHERE ip_address = ? AND attempted_at > (NOW() - INTERVAL 15 MINUTE)');
    $stmt->bind_param('s', $ip);
    $stmt->execute();
    $count = (int) $stmt->get_result()->fetch_assoc()['aggregate'];
    $stmt->close();

    return $count >= 10;
}

function recordFailedLoginAttempt(string $ip): void
{
    $stmt = db()->prepare('INSERT INTO login_attempts (ip_address, attempted_at) VALUES (?, NOW())');
    $stmt->bind_param('s', $ip);
    $stmt->execute();
    $stmt->close();
}

function clientIp(): string
{
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
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

