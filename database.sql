-- Database: akademik

CREATE DATABASE IF NOT EXISTS akademik;
USE akademik;

-- Tabel users untuk login
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data user 
INSERT INTO users (username, password, nama) VALUES 
('admin', 'admin', 'Administrator');

-- Tabel matakuliah
CREATE TABLE IF NOT EXISTS matakuliah (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    kode_mk VARCHAR(20) NOT NULL UNIQUE,
    nama_mk VARCHAR(100) NOT NULL,
    sks INT(2) NOT NULL,
    semester INT(2) NOT NULL,
    dosen VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data contoh matakuliah
INSERT INTO matakuliah (kode_mk, nama_mk, sks, semester, dosen) VALUES 
('MK001', 'Pemrograman Web', 3, 3, 'Dr. Budi Santoso, M.Kom'),
('MK002', 'Basis Data', 3, 3, 'Dr. Ani Wijaya, M.T'),
('MK003', 'Algoritma dan Struktur Data', 4, 2, 'Prof. Siti Nurhaliza, M.Kom'),
('MK004', 'Sistem Operasi', 3, 4, 'Dr. Agus Salim, M.Sc'),
('MK005', 'Jaringan Komputer', 3, 5, 'Dr. Rini Kartika, M.Kom');
