<?php
// logout.php - safely destroy the session and redirect to the login page
// If config.php exists and initializes the session, include it; otherwise start session ourselves.
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
} else {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
}

// Clear session array
$_SESSION = [];

// Delete session cookie if present
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'], $params['secure'] ?? false, $params['httponly'] ?? false
    );
}

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: /LMS/Login.php');
exit;
