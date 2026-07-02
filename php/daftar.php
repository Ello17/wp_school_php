<?php
session_start();

$pesan_sukses = isset($_SESSION['pesan_sukses']) ? $_SESSION['pesan_sukses'] : '';
$pesan_error = isset($_SESSION['pesan_error']) ? $_SESSION['pesan_error'] : '';
$data_pendaftar = isset($_SESSION['data_pendaftar']) ? $_SESSION['data_pendaftar'] : null;

unset($_SESSION['pesan_sukses']);
unset($_SESSION['pesan_error']);
unset($_SESSION['data_pendaftar']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa Baru</title>
    <link rel="stylesheet" type="text/css" href='../css/daftar.css'>
</head>
<body>

<div class="container">
    <h2>Form Pendaftaran Mahasiswa Baru</h2>
    
    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress-track" aria-hidden="true"></div>
        <div class="progress-bar" id="progressBar" style="width: 0%;"></div>
        <div class="progress-steps">
            <div class="step active" data-step="1">1</div>
            <div class="step" data-step="2">2</div>
            <div class="step" data-step="3">3</div>
            <div class="step" data-step="4">4</div>
        </div>
    </div>

    <div class="step-indicator">
        <span id="stepTitle">Data Pribadi</span>
        <span id="stepCounter">1 / 4</span>
    </div>
    
    <?php if (!empty($pesan_sukses)): ?>
        <div class="alert alert-sukses">
            <?php echo $pesan_sukses; ?>
            <?php if ($data_pendaftar): ?>
                <div class="data-ringkasan">
                    <p><strong>Nama:</strong> <?php echo $data_pendaftar['nama']; ?></p>
                    <p><strong>Program Studi:</strong> <?php echo $data_pendaftar['prodi']; ?></p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($pesan_error)): ?>
        <div class="alert alert-error">
            <?php echo $pesan_error; ?>
        </div>
    <?php endif; ?>

    <form action="../connections/proses.php" method="POST" id="registrationForm">
        
        <!-- STEP 1: Data Pribadi -->
        <div class="form-step" data-step="1">
            <h3>1. Data Pribadi</h3>
            
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap (Sesuai Ijazah):</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label for="nik">NIK (No. KTP / 16 Digit):</label>
                <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  id="nik" name="nik" maxlength="16" placeholder="Masukkan 16 digit NIK" required>
            </div>

            <div class="form-group">
                <label for="nisn">NISN (10 Digit):</label>
                <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="nisn" name="nisn" maxlength="10" placeholder="Masukkan 10 digit NISN" required>
            </div>

            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="agama">Agama:</label>
                <select id="agama" name="agama" required>
                    <option value="">-- Pilih Agama --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Khonghucu">Khonghucu</option>
                </select>
            </div>
        </div>

        <!-- STEP 2: Kontak & Alamat -->
        <div class="form-step" data-step="2" style="display: none;">
            <h3>2. Kontak & Alamat</h3>

            <div class="form-group">
                <label for="email">Email Aktif:</label>
                <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
            </div>

            <div class="form-group">
                <label for="no_hp">No. HP / WhatsApp:</label>
                <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label for="alamat_ktp">Alamat Lengkap (Sesuai KTP):</label>
                <textarea id="alamat_ktp" name="alamat_ktp" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
            </div>

            <div class="form-group">
                <label for="kode_pos">Kode Pos:</label>
                <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="kode_pos" name="kode_pos" maxlength="5" placeholder="5 digit kode pos" required>
            </div>
        </div>

        <!-- STEP 3: Asal Sekolah & Pilihan Prodi -->
        <div class="form-step" data-step="3" style="display: none;">
            <h3>3. Asal Sekolah & Pilihan Prodi</h3>

            <div class="form-group">
                <label for="asal_sekolah">Nama Asal Sekolah (SMA/SMK/MA):</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" placeholder="Masukkan nama sekolah" required>
            </div>

            <div class="form-group">
                <label for="jurusan_sekolah">Jurusan Sekolah:</label>
                <input type="text" id="jurusan_sekolah" name="jurusan_sekolah" placeholder="Contoh: IPA / IPS / TKJ" required>
            </div>

            <div class="form-group">
                <label for="tahun_lulus">Tahun Lulus:</label>
                <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="tahun_lulus" name="tahun_lulus" placeholder="Contoh: 2025" maxlength="4" required>
            </div>

            <div class="form-group">
                <label for="pilihan_prodi_1">Pilihan Program Studi 1:</label>
                <select id="pilihan_prodi_1" name="pilihan_prodi_1" required>
                    <option value="">-- Pilih Prodi 1 --</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Manajemen">Manajemen</option>
                    <option value="Akuntansi">Akuntansi</option>
                    <option value="Teknik Elektro">Teknik Elektro</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pilihan_prodi_2">Pilihan Program Studi 2:</label>
                <select id="pilihan_prodi_2" name="pilihan_prodi_2" required>
                    <option value="">-- Pilih Prodi 2 --</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Manajemen">Manajemen</option>
                    <option value="Akuntansi">Akuntansi</option>
                    <option value="Teknik Elektro">Teknik Elektro</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jalur_pendaftaran">Jalur Pendaftaran:</label>
                <select id="jalur_pendaftaran" name="jalur_pendaftaran" required>
                    <option value="">-- Pilih Jalur --</option>
                    <option value="Reguler">Reguler</option>
                    <option value="Prestasi">Prestasi</option>
                    <option value="Beasiswa">Beasiswa / KIP</option>
                </select>
            </div>
        </div>

        <!-- STEP 4: Data Orang Tua / Wali -->
        <div class="form-step" data-step="4" style="display: none;">
            <h3>4. Data Orang Tua / Wali</h3>

            <div class="form-group">
                <label for="nama_orang_tua">Nama Orang Tua / Wali:</label>
                <input type="text" id="nama_orang_tua" name="nama_orang_tua" placeholder="Masukkan nama orang tua/wali" required>
            </div>

            <div class="form-group">
                <label for="no_hp_orang_tua">No. HP Orang Tua:</label>
                <input type="text" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="no_hp_orang_tua" name="no_hp_orang_tua" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label for="pekerjaan_orang_tua">Pekerjaan Orang Tua:</label>
                <input type="text" id="pekerjaan_orang_tua" name="pekerjaan_orang_tua" placeholder="Masukkan pekerjaan" required>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="nav-buttons">
            <button type="button" class="btn-prev" id="prevBtn" style="display: none;">
                ← Sebelumnya
            </button>
            <button type="button" class="btn-next" id="nextBtn">
                Selanjutnya →
            </button>
            <button type="submit" name="submit" class="btn-submit" id="submitBtn" style="display: none;">
                🚀 Daftar Sekarang
            </button>
        </div>
    </form>
</div>

<script src="../js/daftar.js"></script>
</body>
</html>