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

// Cek apakah data ada
$check_query = "SELECT * FROM matakuliah WHERE id = '$id'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) == 0) {
    $_SESSION['error'] = 'Data tidak ditemukan!';
    redirect('matakuliah_list.php');
}

// Hapus data
$delete_query = "DELETE FROM matakuliah WHERE id = '$id'";

if (mysqli_query($conn, $delete_query)) {
    $_SESSION['success'] = 'Data matakuliah berhasil dihapus!';
} else {
    $_SESSION['error'] = 'Gagal menghapus data: ' . mysqli_error($conn);
}

redirect('matakuliah_list.php');
?>
