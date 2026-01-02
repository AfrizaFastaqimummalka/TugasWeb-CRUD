<?php
session_start();
require_once 'db.php';

// Cek login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    redirect('login.php');
}

// Proses form jika di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_mk = clean_input($_POST['kode_mk']);
    $nama_mk = clean_input($_POST['nama_mk']);
    $sks = clean_input($_POST['sks']);
    $semester = clean_input($_POST['semester']);
    $dosen = clean_input($_POST['dosen']);

    // Validasi input
    if (empty($kode_mk) || empty($nama_mk) || empty($sks) || empty($semester) || empty($dosen)) {
        $_SESSION['error'] = 'Semua field harus diisi!';
    } else {
        // Cek apakah kode_mk sudah ada
        $check_query = "SELECT * FROM matakuliah WHERE kode_mk = '$kode_mk'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['error'] = 'Kode Matakuliah sudah ada!';
        } else {
            // Insert data
            $insert_query = "INSERT INTO matakuliah (kode_mk, nama_mk, sks, semester, dosen) 
                            VALUES ('$kode_mk', '$nama_mk', '$sks', '$semester', '$dosen')";
            
            if (mysqli_query($conn, $insert_query)) {
                $_SESSION['success'] = 'Data matakuliah berhasil ditambahkan!';
                redirect('matakuliah_list.php');
            } else {
                $_SESSION['error'] = 'Gagal menambahkan data: ' . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Matakuliah - Sistem Akademik</title>
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
                <li><a href="matakuliah_list.php">Data Matakuliah</a></li>
                <li><a href="matakuliah_tambah.php" class="active">Tambah Matakuliah</a></li>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-header fade-in">
                <h1>Tambah Matakuliah</h1>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger fade-in">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="form-card fade-in">
                <h2 style="color: #2c5f7d; margin-bottom: 25px;">Form Tambah Matakuliah</h2>
                
                <form method="POST" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="kode_mk">Kode Matakuliah</label>
                            <input type="text" class="form-control" id="kode_mk" name="kode_mk" 
                                   placeholder="Contoh: MK001" required>
                        </div>

                        <div class="form-group">
                            <label for="sks">SKS</label>
                            <input type="number" class="form-control" id="sks" name="sks" 
                                   min="1" max="6" placeholder="Contoh: 3" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_mk">Nama Matakuliah</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk" 
                               placeholder="Contoh: Pemrograman Web" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dosen">Dosen Pengampu</label>
                            <input type="text" class="form-control" id="dosen" name="dosen" 
                                   placeholder="Contoh: Dr. Budi Santoso, M.Kom" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Simpan Data</button>
                        <a href="matakuliah_list.php" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
