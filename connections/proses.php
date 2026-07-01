<?php
session_start();

include_once 'koneksi.php';

if (!isset($koneksi) || !$koneksi) {
    $_SESSION['pesan_error'] = "Koneksi database gagal!";
    header('Location: ../php/daftar.php');
    exit();
}

if (isset($_POST['submit'])) {
    
    $nama_lengkap        = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nik                 = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $nisn                = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $tempat_lahir        = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir       = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $jenis_kelamin       = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $agama               = mysqli_real_escape_string($koneksi, $_POST['agama']);
    $email               = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp               = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat_ktp          = mysqli_real_escape_string($koneksi, $_POST['alamat_ktp']);
    $kode_pos            = mysqli_real_escape_string($koneksi, $_POST['kode_pos']);
    $asal_sekolah        = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
    $jurusan_sekolah     = mysqli_real_escape_string($koneksi, $_POST['jurusan_sekolah']);
    $tahun_lulus         = mysqli_real_escape_string($koneksi, $_POST['tahun_lulus']);
    $pilihan_prodi_1     = mysqli_real_escape_string($koneksi, $_POST['pilihan_prodi_1']);
    $pilihan_prodi_2     = mysqli_real_escape_string($koneksi, $_POST['pilihan_prodi_2']);
    $jalur_pendaftaran   = mysqli_real_escape_string($koneksi, $_POST['jalur_pendaftaran']);
    $nama_orang_tua      = mysqli_real_escape_string($koneksi, $_POST['nama_orang_tua']);
    $no_hp_orang_tua     = mysqli_real_escape_string($koneksi, $_POST['no_hp_orang_tua']);
    $pekerjaan_orang_tua = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_orang_tua']);
    
    $errors = array();
    
    if (strlen($nik) != 16 || !is_numeric($nik)) {
        $errors[] = "NIK harus 16 digit angka!";
    }
    
    if (strlen($nisn) != 10 || !is_numeric($nisn)) {
        $errors[] = "NISN harus 10 digit angka!";
    }
    
    if (strlen($tahun_lulus) != 4 || !is_numeric($tahun_lulus)) {
        $errors[] = "Tahun lulus harus 4 digit!";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid!";
    }
    
    if (!preg_match('/^[0-9]{10,15}$/', $no_hp)) {
        $errors[] = "Nomor HP harus 10-15 digit angka!";
    }
    
    if (!empty($errors)) {
        $_SESSION['pesan_error'] = implode("<br>", $errors);
        header('Location: ../php/daftar.php');
        exit();
    }
    
    $query = "INSERT INTO pendaftaran_kampus (
                nama_lengkap, nik, nisn, tempat_lahir, tanggal_lahir, 
                jenis_kelamin, agama, email, no_hp, alamat_ktp, kode_pos, 
                asal_sekolah, jurusan_sekolah, tahun_lulus, 
                pilihan_prodi_1, pilihan_prodi_2, jalur_pendaftaran, 
                nama_orang_tua, no_hp_orang_tua, pekerjaan_orang_tua
              ) VALUES (
                '$nama_lengkap', '$nik', '$nisn', '$tempat_lahir', '$tanggal_lahir', 
                '$jenis_kelamin', '$agama', '$email', '$no_hp', '$alamat_ktp', '$kode_pos', 
                '$asal_sekolah', '$jurusan_sekolah', '$tahun_lulus', 
                '$pilihan_prodi_1', '$pilihan_prodi_2', '$jalur_pendaftaran', 
                '$nama_orang_tua', '$no_hp_orang_tua', '$pekerjaan_orang_tua'
              )";
    
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['pesan_sukses'] = "Pendaftaran Berhasil! Terima kasih telah mendaftar.";
        $_SESSION['data_pendaftar'] = [
            'nama' => $nama_lengkap,
            'prodi' => $pilihan_prodi_1
        ];
        header('Location: ../php/daftar.php');
        exit();
    } else {
        $_SESSION['pesan_error'] = "Gagal mendaftar: " . mysqli_error($koneksi);
        header('Location: ../php/daftar.php');
        exit();
    }
}

mysqli_close($koneksi);

header('Location: ../php/daftar.php');
exit();
?>