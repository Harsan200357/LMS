<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/functions.php';
require_login('student');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="max-width:900px;margin:40px auto;padding:20px;background:#fff;border-radius:8px;">
        <h1 style="color:var(--green);">Student Dashboard</h1>
        <p>Welcome, <?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?></p>
        <p>Your Registration Number: <?= htmlspecialchars($_SESSION['user']['reg_no'] ?? '') ?></p>
        <p><a href="/logout.php">Logout</a></p>
    </div>
</body>
</html>