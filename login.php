<?php
// Start session terlebih dahulu
session_start();

// Include database
require_once 'db.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Akademik</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-illustration">
        </div>
        
        <div class="login-box fade-in">
            <div class="login-header">
                <h2>LOGIN ADMIN</h2>
                <p>Sistem Informasi Akademik</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="proses_login.php" method="POST">
                <div class="form-group">
                    <label for="username">USERNAME</label>
                    <input type="text" class="form-control" id="username" name="username" 
                           placeholder="Masukkan username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Masukkan password" required>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">LOGIN</button>
                    <button type="reset" class="btn btn-secondary">BATAL</button>
                </div>
            </form>

            <div style="margin-top: 20px; text-align: center; color: #999; font-size: 12px;">
                <p>Demo Login: username = admin, password = admin</p>
            </div>
        </div>
    </div>
</body>
</html>
