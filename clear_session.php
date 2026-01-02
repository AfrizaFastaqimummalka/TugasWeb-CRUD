<?php
// File clear semua session
// Akses file ini jika tidak bisa masuk ke halaman login

session_start();
session_unset();
session_destroy();

echo "<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Clear Session</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #89c4e1 0%, #2c5f7d 100%);
            margin: 0;
        }
        .message {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            text-align: center;
        }
        .message h1 {
            color: #2c5f7d;
            margin-bottom: 20px;
        }
        .message p {
            color: #666;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn:hover {
            background: #4cae4c;
        }
    </style>
</head>
<body>
    <div class='message'>
        <h1>✓ Session Berhasil Dihapus!</h1>
        <p>Semua session telah dibersihkan. Silakan login kembali.</p>
        <a href='login.php' class='btn'>Kembali ke Login</a>
    </div>
</body>
</html>";
?>
