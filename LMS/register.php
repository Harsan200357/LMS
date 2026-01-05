<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $regno = trim($_POST['reg_no'] ?? '');
    $password = trim($_POST['password'] ?? $regno);

    if ($name === '' || $regno === '') {
        $message = 'Name and Registration Number are required.';
    } else {
        if (add_student($name, $regno, $password)) {
            $message = 'Student registered successfully.';
        } else {
            $message = 'A student with that Registration Number already exists.';
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register Student</title>
    <link rel="stylesheet" href="LMS/style.css">
    <style>body{background:#f4f7f6}</style>
</head>
<body>
    <div style="max-width:600px;margin:40px auto;padding:20px;background:#fff;border-radius:8px;">
        <h2>Register Student</h2>
        <?php if ($message): ?><p style="color:var(--teal);"><?= htmlspecialchars($message) ?></p><?php endif; ?>
        <form method="post">
            <div><label>Name</label><br><input type="text" name="name" required></div>
            <div><label>Registration Number</label><br><input type="text" name="reg_no" required></div>
            <div><label>Password (optional — default is registration number)</label><br><input type="text" name="password"></div>
            <div style="margin-top:10px;"><button class="btn" type="submit">Register</button></div>
        </form>
        <p><a href="/LMS/Login.php">Back to Login</a></p>
    </div>
</body>
</html>
