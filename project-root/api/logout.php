<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

// The logout link carries a csrf_token query param (see includes/header.php)
// so it can't be forced by a third-party site linking/redirecting to this
// URL (login CSRF / forced logout). Since this endpoint is reached via a
// plain navigation link (not AJAX), a failed check just sends the visitor
// back to the login page instead of returning a raw JSON error.
$submittedToken = $_GET['csrf_token'] ?? '';
$expectedToken = $_SESSION['csrf_token'] ?? '';
if ($submittedToken === '' || $expectedToken === '' || !hash_equals($expectedToken, $submittedToken)) {
    redirect('../main/login.php');
}

$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

session_destroy();
redirect('../main/login.php');
