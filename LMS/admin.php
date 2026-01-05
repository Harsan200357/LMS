<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_login('admin');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="LMS/style.css">
</head>
<body>
    <div style="max-width:900px;margin:40px auto;padding:20px;background:#fff;border-radius:8px;">
        <h1 style="color:var(--teal);">Administrator Portal</h1>
        <p>Welcome, <?= htmlspecialchars($_SESSION['user']['name'] ?? 'Admin') ?></p>
        <p><a href="LMS/addStudent.html">Add Student</a> • <a href="LMS/Subjectlist.html">Subjects</a> • <a href="/logout.php">Logout</a></p>
    </div>
</body>
</html>
