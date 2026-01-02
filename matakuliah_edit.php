<?php
session_start();
require_once 'db.php';

// Cek login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    redirect('login.php');
}

// Ambil ID dari URL
$id = isset($_GET['id']) ? clean_input($_GET['id']) : '';

if (empty($id)) {
    $_SESSION['error'] = 'ID tidak valid!';
    redirect('matakuliah_list.php');
}

// Ambil data matakuliah berdasarkan ID
$query = "SELECT * FROM matakuliah WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = 'Data tidak ditemukan!';
    redirect('matakuliah_list.php');
}

$matakuliah = mysqli_fetch_assoc($result);

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
        $check_query = "SELECT * FROM matakuliah WHERE kode_mk = '$kode_mk' AND id != '$id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['error'] = 'Kode Matakuliah sudah digunakan!';
        } else {
            // Update data
            $update_query = "UPDATE matakuliah SET 
                            kode_mk = '$kode_mk',
                            nama_mk = '$nama_mk',
                            sks = '$sks',
                            semester = '$semester',
                            dosen = '$dosen'
                            WHERE id = '$id'";
            
            if (mysqli_query($conn, $update_query)) {
                $_SESSION['success'] = 'Data matakuliah berhasil diupdate!';
                redirect('matakuliah_list.php');
            } else {
                $_SESSION['error'] = 'Gagal mengupdate data: ' . mysqli_error($conn);
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
    <title>Edit Matakuliah - Sistem Akademik</title>
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
                <h1>Edit Matakuliah</h1>
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
                <h2 style="color: #2c5f7d; margin-bottom: 25px;">Form Edit Matakuliah</h2>
                
                <form method="POST" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="kode_mk">Kode Matakuliah</label>
                            <input type="text" class="form-control" id="kode_mk" name="kode_mk" 
                                   value="<?php echo htmlspecialchars($matakuliah['kode_mk']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="sks">SKS</label>
                            <input type="number" class="form-control" id="sks" name="sks" 
                                   min="1" max="6" value="<?php echo htmlspecialchars($matakuliah['sks']); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama_mk">Nama Matakuliah</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk" 
                               value="<?php echo htmlspecialchars($matakuliah['nama_mk']); ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                <?php for ($i = 1; $i <= 8; $i++): ?>
                                <option value="<?php echo $i; ?>" 
                                    <?php echo ($matakuliah['semester'] == $i) ? 'selected' : ''; ?>>
                                    Semester <?php echo $i; ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dosen">Dosen Pengampu</label>
                            <input type="text" class="form-control" id="dosen" name="dosen" 
                                   value="<?php echo htmlspecialchars($matakuliah['dosen']); ?>" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Update Data</button>
                        <a href="matakuliah_list.php" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
