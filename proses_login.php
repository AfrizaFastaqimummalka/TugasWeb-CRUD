<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);

    // Validasi input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Username dan password harus diisi!';
        redirect('login.php');
    }

    // Query untuk cek user di database
    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password (gunakan password_verify jika password di-hash)
        if ($password === $user['password']) {
            // Set session
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            
            redirect('dashboard.php');
        } else {
            $_SESSION['error'] = 'Password salah!';
            redirect('login.php');
        }
    } else {
        $_SESSION['error'] = 'Username tidak ditemukan!';
        redirect('login.php');
    }
} else {
    redirect('login.php');
}
?>
