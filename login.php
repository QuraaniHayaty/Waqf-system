<?php
session_start();
require_once 'auth_config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === WAQF_ADMIN_USERNAME && hash('sha256', $password) === WAQF_ADMIN_PASSWORD_HASH) {
        $_SESSION['waqf_logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'اسم المستخدم أو كلمة المرور غير صحيحة';
    }
}

if (!empty($_SESSION['waqf_logged_in'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - وقف تعليم القرآن الكريم والعلوم الشرعية</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body {
            background-color: #f4f6f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            direction: rtl;
            text-align: right;
            padding: 20px;
        }
        .login-card {
            background-color: #fcf6f5;
            width: 100%;
            max-width: 420px;
            border-radius: 14px;
            padding: 35px 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
        }
        .login-logo { max-width: 140px; height: auto; object-fit: contain; margin-bottom: 15px; }
        .login-title { font-size: 20px; font-weight: bold; color: #2e5a36; margin-bottom: 6px; }
        .login-subtitle { font-size: 13px; color: #7f8c8d; margin-bottom: 25px; }
        .form-group { position: relative; margin-bottom: 16px; text-align: right; }
        .form-group input {
            width: 100%;
            padding: 12px 40px 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: #ffffff;
            text-align: right;
        }
        .form-group input:focus { outline: none; border-color: #27ae60; }
        .field-icon {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            color: #9aa5ac;
            font-size: 15px;
            pointer-events: none;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #9aa5ac;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 15px;
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 6px;
            transition: background 0.2s;
        }
        .login-btn:hover { background-color: #219653; }
        .error-msg {
            background-color: #fde8e8;
            color: #c0392b;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 16px;
            border: 1px solid #f5c6cb;
        }
        @media (max-width: 480px) {
            .login-card { padding: 25px 18px; }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <img src="logo.png" alt="شعار الوقف" class="login-logo">
        <div class="login-title">تسجيل الدخول</div>
        <div class="login-subtitle">مرحباً بعودتك! يرجى تسجيل الدخول إلى حسابك.</div>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <input type="text" name="username" placeholder="اسم المستخدم" required autofocus>
                <span class="field-icon">👤</span>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="passwordField" placeholder="كلمة المرور" required>
                <span class="field-icon">🔒</span>
                <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
            </div>
            <button type="submit" class="login-btn">تسجيل الدخول</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            let field = document.getElementById('passwordField');
            field.type = (field.type === 'password') ? 'text' : 'password';
        }
    </script>
</body>
</html>
