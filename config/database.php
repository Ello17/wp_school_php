<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_pendaftaran');

$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8");

$sql_create = "CREATE TABLE IF NOT EXISTS pendaftaran_kampus (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    nik VARCHAR(16) NOT NULL,
    nisn VARCHAR(10) NOT NULL,
    tempat_lahir VARCHAR(50) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    agama VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    alamat_ktp TEXT NOT NULL,
    kode_pos VARCHAR(5) NOT NULL,
    asal_sekolah VARCHAR(100) NOT NULL,
    jurusan_sekolah VARCHAR(50) NOT NULL,
    tahun_lulus YEAR(4) NOT NULL,
    pilihan_prodi_1 VARCHAR(50) NOT NULL,
    pilihan_prodi_2 VARCHAR(50) NOT NULL,
    jalur_pendaftaran VARCHAR(20) NOT NULL,
    nama_orang_tua VARCHAR(100) NOT NULL,
    no_hp_orang_tua VARCHAR(15) NOT NULL,
    pekerjaan_orang_tua VARCHAR(50) NOT NULL,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

mysqli_query($koneksi, $sql_create);
?>