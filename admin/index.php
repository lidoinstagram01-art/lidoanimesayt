<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $pass = $_POST['password'];

    if ($login === 'admin1134' && $pass === 'admin1134') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Login yoki parol xato!";
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Kirish</title>
    <style>
        body { background: #121212; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #1f1f1f; padding: 30px; border-radius: 8px; width: 300px; text-align: center; }
        input { width: 90%; padding: 10px; margin: 10px 0; border: none; border-radius: 4px; }
        button { background: #e50914; color: white; border: none; padding: 10px; width: 100%; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Panel</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="password" placeholder="Parol" required>
            <button type="submit">Kirish</button>
        </form>
    </div>
</body>
</html>
