<?php
session_start();
require_once 'db.php';

// Cek login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    redirect('login.php');
}

// Ambil jumlah matakuliah
$query_count = "SELECT COUNT(*) as total FROM matakuliah";
$result_count = mysqli_query($conn, $query_count);
$total_matakuliah = mysqli_fetch_assoc($result_count)['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Akademik</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>Sistem Civitas - Akademik</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="matakuliah_list.php">Data Matakuliah</a></li>
                <li><a href="matakuliah_tambah.php">Tambah Matakuliah</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-header fade-in">
                <h1>Selamat Datang di Sistem Civitas - Akademik</h1>
            </div>

            <div class="welcome-card fade-in">
                <h2>Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h2>
                <p>Sistem Toujou Mantappu</p>
            </div>

            <div class="stats-container">
                <div class="stat-card fade-in">
                    <h3>Total Matakuliah</h3>
                    <p><?php echo $total_matakuliah; ?></p>
                </div>
                <div class="stat-card fade-in">
                    <h3>Konsultasi</h3>
                    <p>24/7</p>
                </div>
                <div class="stat-card fade-in">
                    <h3>Layanan Aktif</h3>
                    <p>90%</p>
                </div>
            </div>

            <div class="content-card fade-in">
                <h2>Berita Sistem</h2>
                <p style="color: #666; line-height: 1.8; margin-top: 15px;">
                    Sistem Informasi Civitas - Akademik 
                </p>
                <div style="margin-top: 20px;">
                    <a href="matakuliah_list.php" class="btn-add">Lihat Data Matakuliah</a>
                </div>
            </div>

            <div style="margin-top: 30px; text-align: center; color: #999; font-size: 14px;">
                <p>Copyright © 2025 Sistem Civitas - Akademik | Desain oleh A.F</p>
            </div>
        </div>
    </div>
</body>
</html>
