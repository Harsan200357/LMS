<?php
// includes/functions.php - helper functions for student management
require_once __DIR__ . '/../config.php';

function student_exists_by_regno($reg_no)
{
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT 1 FROM students WHERE reg_no = ? LIMIT 1");
        $stmt->execute([$reg_no]);
        return (bool) $stmt->fetchColumn();
    } catch (PDOException $e) {
        return false;
    }
}

function add_student($name, $reg_no, $password)
{
    global $conn;
    if (student_exists_by_regno($reg_no))
        return false;

    try {
        $stmt = $conn->prepare("INSERT INTO students (name, reg_no, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $reg_no, $password]);
    } catch (PDOException $e) {
        return false;
    }
}

function require_login($role = null)
{
    if (!isset($_SESSION['user'])) {
        header('Location: /LMS/Login.php');
        exit;
    }
    if ($role && ($_SESSION['user']['role'] ?? '') !== $role) {
        die('Unauthorized access: You do not have the required permissions.');
    }
}

function find_student($username, $password)
{
    global $conn;
    try {
        // Checking by name for username as per original logic, though reg_no is usually better
        $stmt = $conn->prepare("SELECT * FROM students WHERE name = ? AND password = ? LIMIT 1");
        $stmt->execute([$username, $password]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
}
