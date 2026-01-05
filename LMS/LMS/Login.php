<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/functions.php';

$error = '';
$role = isset($_GET['role']) && $_GET['role'] === 'admin' ? 'admin' : 'student';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $rolePost = $_POST['role'] ?? $role;

    if ($rolePost === 'admin') {
        // simple admin check
        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['user'] = ['role' => 'admin', 'name' => 'admin'];
            header('Location: /admin.php');
            exit;
        } else {
            $error = 'Invalid Admin Username or Password';
        }
    } else {
        $student = find_student($username, $password);
        if ($student) {
            $_SESSION['user'] = ['role' => 'student', 'name' => $student['name'], 'reg_no' => $student['reg_no']];
            header('Location: /LMS/Student_dashboard.php');
            exit;
        } else {
            $error = 'Invalid Student Name or Password. (Initial password is your Registration Number)';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SmartStudent</title>
    <link rel="stylesheet" href="style.css">
    <style>.error{color:#e74c3c;margin-bottom:12px}.login-wrapper{display:flex;align-items:center;justify-content:center;min-height:100vh}.login-card{background:white;padding:40px;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.1);width:100%;max-width:400px;text-align:center}.password-container{position:relative;display:flex;align-items:center}.password-container input{width:100%;padding-right:40px}.toggle-password{position:absolute;right:15px;cursor:pointer;user-select:none;font-size:1.2rem;color:var(--asphalt)}</style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h2><?= $role === 'admin' ? 'Admin Login' : 'Student Login' ?></h2>
            <p>Please enter your credentials below.</p>

            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" id="loginForm">
                <input type="hidden" name="role" value="<?= htmlspecialchars($role) ?>">
                <div class="form-group"><input type="text" name="username" placeholder="Username (Name)" required></div>
                <div class="form-group password-container"><input type="password" name="password" placeholder="Password" required><span class="toggle-password" onclick="togglePassword()">👁️</span></div>
                <button class="btn" type="submit" style="width:100%;margin-top:10px;">Login to Portal</button>
            </form>

            <p style="margin-top:12px"><a href="/LMS/Hero.html">← Choose a different role</a></p>
        </div>
    </div>

    <script>
        function togglePassword(){const p=document.querySelector('input[name=\'password\']');const t=document.querySelector('.toggle-password');if(p.type==='password'){p.type='text';t.innerText='🙈'}else{p.type='password';t.innerText='👁️'}}
        document.addEventListener('keypress',function(e){if(e.key==='Enter'){document.getElementById('loginForm').submit();}});
    </script>
</body>
</html>