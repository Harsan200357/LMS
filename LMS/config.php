<?php
// config.php - basic configuration and session initialization
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lms_db');

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $conn = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Paths
define('ROOT_PATH', __DIR__);
define('DATA_PATH', ROOT_PATH . '/data');
// STUDENTS_FILE is kept for backward compatibility or transition if needed
define('STUDENTS_FILE', DATA_PATH . '/students.json');

// Helper for simple path-based redirects if needed
function base_url($path = '')
{
    return $path;
}
