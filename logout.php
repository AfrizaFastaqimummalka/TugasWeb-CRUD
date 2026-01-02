<?php
session_start();
require_once 'db.php';

// Hapus semua session
session_unset();
session_destroy();

// Start session baru untuk pesan
session_start();
$_SESSION['success'] = 'Anda berhasil logout!';

// Redirect ke login
redirect('login.php');
?>
