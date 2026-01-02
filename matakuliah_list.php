<?php
session_start();
require_once 'db.php';

// Cek login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    redirect('login.php');
}

// Pencarian
$search = isset($_GET['search']) ? clean_input($_GET['search']) : '';

// Query untuk mengambil data matakuliah
if (!empty($search)) {
    $query = "SELECT * FROM matakuliah WHERE 
              kode_mk LIKE '%$search%' OR 
              nama_mk LIKE '%$search%' OR 
              dosen LIKE '%$search%'
              ORDER BY kode_mk ASC";
} else {
    $query = "SELECT * FROM matakuliah ORDER BY kode_mk ASC";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Matakuliah - Sistem Akademik</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3>Sistem Akademik</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="matakuliah_list.php" class="active">Data Matakuliah</a></li>
                <li><a href="matakuliah_tambah.php">Tambah Matakuliah</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-header fade-in">
                <h1>Data Matakuliah</h1>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success fade-in">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger fade-in">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="content-card fade-in">
                <div class="content-header">
                    <h2>Daftar Matakuliah</h2>
                    <a href="matakuliah_tambah.php" class="btn-add">+ Tambah Matakuliah</a>
                </div>

                <!-- Search Box -->
                <div class="search-box">
                    <form method="GET" action="">
                        <input type="text" name="search" placeholder="Cari berdasarkan kode, nama, atau dosen..." 
                               value="<?php echo htmlspecialchars($search); ?>">
                    </form>
                </div>

                <?php if (mysqli_num_rows($result) > 0): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode MK</th>
                                <th>Nama Matakuliah</th>
                                <th>SKS</th>
                                <th>Semester</th>
                                <th>Dosen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['kode_mk']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_mk']); ?></td>
                                <td><?php echo htmlspecialchars($row['sks']); ?></td>
                                <td><?php echo htmlspecialchars($row['semester']); ?></td>
                                <td><?php echo htmlspecialchars($row['dosen']); ?></td>
                                <td>
                                    <div class="table-actions">
                                        <a href="matakuliah_edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                        <a href="matakuliah_hapus.php?id=<?php echo $row['id']; ?>" 
                                           class="btn-delete"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus matakuliah ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <h3>Tidak Ada Data</h3>
                    <p>Belum ada data matakuliah. Silakan tambah data baru.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
