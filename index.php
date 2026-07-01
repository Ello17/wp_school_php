<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./assets/logo2.png" type="image/x-icon">
    <title>Nusa Bina Informatika</title>
</head>
<body>
    <nav>
        <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="#home" class="nav-link">Beranda</a></li>
            <li><a href="#faculties" class="nav-link">Fakultas</a></li>
            <li><a href="#statistics" class="nav-link">Statistik</a></li>
            <li><a href="#testimonials" class="nav-link">Testimoni</a></li>
            <li><a href="#footer" class="nav-link">Hubungi Kami</a></li>
        </ul>
        <ul>
            <li class="nav-name"><a href="#home" class="nav-name-link"><img src="./assets/logo2.png" alt="Logo" height="30" width="30"> <p>Nusa Bina Informatika</p></a></li>
            <li class="hide-on-mobile"><a href="#home" class="nav-link">Beranda</a></li>
            <li class="hide-on-mobile"><a href="#faculties" class="nav-link">Fakultas</a></li>
            <li class="hide-on-mobile"><a href="#statistics" class="nav-link">Statistik</a></li>
            <li class="hide-on-mobile"><a href="#testimonials" class="nav-link">Testimoni</a></li>
            <li class="hide-on-mobile"><a href="#footer" class="nav-link">Hubungi Kami</a></li>
            <li class="menu-button" onclick="showSidebar()"><a href="#" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>

    <!-- SECTION 1: Welcome/Hero -->
    <section id="home" class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Selamat Datang di <br><span>Nusa Bina Informatika</span></h1>
                <p class="hero-description">Kampus unggulan yang mencetak generasi profesional di bidang teknologi informasi, bisnis, dan komunikasi. Dengan kurikulum berbasis industri dan tenaga pengajar berpengalaman, kami siap mengantarkan Anda menuju karir gemilang.</p>
                <div class="hero-buttons">
                    <a href="#faculties" class="btn-primary">Lihat Fakultas</a>
                    <a href="#footer" class="btn-secondary">Hubungi Kami</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="./assets/logo2.png" alt="Nusa Bina Informatika">
            </div>
        </div>
    </section>

    <!-- SECTION 2: Faculties -->
    <section id="faculties" class="faculties-section">
        <div class="section-header">
            <h2>Fakultas & Program Studi</h2>
            <p>Pilih program studi yang sesuai dengan minat dan bakat Anda</p>
        </div>
        <div class="faculties-grid">
            <div class="faculty-card">
                <!-- <div class="faculty-icon">💻</div> -->
                <h3>Teknologi Informasi</h3>
                <p>Program studi yang mempelajari pengembangan perangkat lunak, jaringan komputer, dan sistem informasi.</p>
                <span class="faculty-badge">S1</span>
            </div>
            <div class="faculty-card">
                <!-- <div class="faculty-icon">📊</div> -->
                <h3>Bisnis Digital</h3>
                <p>Mempelajari strategi bisnis berbasis teknologi, e-commerce, dan manajemen digital.</p>
                <span class="faculty-badge">S1</span>
            </div>
            <div class="faculty-card">
                <!-- <div class="faculty-icon">🎨</div> -->
                <h3>Desain Komunikasi Visual</h3>
                <p>Program studi yang fokus pada desain grafis, animasi, dan multimedia interaktif.</p>
                <span class="faculty-badge">S1</span>
            </div>
            <div class="faculty-card">
                <!-- <div class="faculty-icon">📱</div> -->
                <h3>Sistem Informasi</h3>
                <p>Menggabungkan ilmu manajemen dan teknologi untuk mengelola sistem informasi perusahaan.</p>
                <span class="faculty-badge">S1</span>
            </div>
            <div class="faculty-card">
                <!-- <div class="faculty-icon">🤖</div> -->
                <h3>Teknik Komputer</h3>
                <p>Mempelajari perangkat keras, mikrokontroler, dan sistem embedded.</p>
                <span class="faculty-badge">S1</span>
            </div>
            <div class="faculty-card">
                <!-- <div class="faculty-icon">📡</div> -->
                <h3>Komunikasi</h3>
                <p>Program studi yang mempelajari strategi komunikasi, jurnalistik, dan public relations.</p>
                <span class="faculty-badge">S1</span>
            </div>
        </div>
    </section>

    <!-- SECTION 3: Statistics -->
    <section id="statistics" class="statistics-section">
        <div class="section-header">
            <h2>Statistik Kampus</h2>
            <p>Prestasi dan pencapaian mahasiswa Nusa Bina Informatika</p>
        </div>
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number" data-target="5000">0</div>
                <div class="stat-label">Mahasiswa Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-target="350">0</div>
                <div class="stat-label">Mahasiswa Berprestasi</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-target="98">0</div>
                <div class="stat-label">Lulusan Terserap Kerja</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-target="250">0</div>
                <div class="stat-label">Kerjasama Industri</div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: Testimonials -->
    <section id="testimonials" class="testimonials-section">
        <div class="section-header">
            <h2>Testimoni Mahasiswa</h2>
            <p>Apa kata mereka tentang pengalaman belajar di Nusa Bina Informatika</p>
        </div>
        <div class="testimonials-wrapper">
            <button class="testimonial-btn prev-btn" onclick="slideTestimonial(-1)" aria-label="Previous testimonial">❮</button>
            <div class="testimonials-slider-container">
                <div class="testimonials-slider" id="testimonialSlider">
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="https://ui-avatars.com/api/?name=Andi+Putra&background=4a7fa5&color=fff&size=80" alt="Andi Putra">
                        </div>
                        <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Kampus ini memberikan pengalaman belajar yang luar biasa. Dosen-dosennya sangat kompeten dan fasilitasnya lengkap. Saya merasa siap untuk memasuki dunia kerja."</p>
                        <h4 class="testimonial-name">Andi Putra</h4>
                        <span class="testimonial-role">Mahasiswa TI Angkatan 2022</span>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=6f9bd1&color=fff&size=80" alt="Siti Nurhaliza">
                        </div>
                        <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Saya sangat bersyukur kuliah di sini. Kurikulumnya selalu update dengan perkembangan industri. Banyak proyek nyata yang membantu saya mengasah skill."</p>
                        <h4 class="testimonial-name">Siti Nurhaliza</h4>
                        <span class="testimonial-role">Mahasiswa Bisnis Digital Angkatan 2021</span>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=4a7fa5&color=fff&size=80" alt="Budi Santoso">
                        </div>
                        <div class="testimonial-rating">⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Lingkungan kampus yang nyaman dan mendukung. Banyak kegiatan ekstrakurikuler yang bisa mengembangkan soft skills. Sangat direkomendasikan!"</p>
                        <h4 class="testimonial-name">Budi Santoso</h4>
                        <span class="testimonial-role">Mahasiswa DKV Angkatan 2023</span>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="https://ui-avatars.com/api/?name=Rina+Wati&background=6f9bd1&color=fff&size=80" alt="Rina Wati">
                        </div>
                        <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Program magang yang disediakan kampus sangat membantu. Saya mendapatkan pengalaman kerja sebelum lulus dan langsung diterima di perusahaan tempat magang."</p>
                        <h4 class="testimonial-name">Rina Wati</h4>
                        <span class="testimonial-role">Mahasiswa Sistem Informasi Angkatan 2020</span>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="https://ui-avatars.com/api/?name=Agus+Firmansyah&background=4a7fa5&color=fff&size=80" alt="Agus Firmansyah">
                        </div>
                        <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Dosen-dosen sangat ramah dan selalu memberikan motivasi. Saya merasa didukung penuh untuk meraih prestasi akademik maupun non-akademik."</p>
                        <h4 class="testimonial-name">Agus Firmansyah</h4>
                        <span class="testimonial-role">Mahasiswa Teknik Komputer Angkatan 2022</span>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="https://ui-avatars.com/api/?name=Dewi+Lestari&background=4a7fa5&color=fff&size=80" alt="Dewi Lestari">
                        </div>
                        <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Kampus ini benar-benar membentuk karakter dan skill saya. Dari yang awalnya tidak percaya diri, sekarang saya bisa tampil profesional di depan umum."</p>
                        <h4 class="testimonial-name">Dewi Lestari</h4>
                        <span class="testimonial-role">Mahasiswa Komunikasi Angkatan 2021</span>
                    </div>
                </div>
            </div>
            <button class="testimonial-btn next-btn" onclick="slideTestimonial(1)" aria-label="Next testimonial">❯</button>
        </div>
        <div class="testimonial-dots" id="testimonialDots"></div>
    </section>

    <!-- FOOTER -->
    <footer id="footer">
        <div class="footer-container">
            <div class="footer-column">
                <div class="footer-logo">
                    <img src="./assets/logo2.png" alt="Nusa Bina Informatika" height="50" width="50">
                    <h3>Nusa Bina Informatika</h3>
                </div>
                <p class="footer-description">Kampus unggulan yang berkomitmen mencetak generasi profesional di bidang teknologi, bisnis, dan komunikasi dengan standar industri.</p>
                <div class="footer-social">
                    <a href="#" class="social-link"><img src="./assets/icons8-facebook-100.png" alt="Facebook"></a>
                    <a href="#" class="social-link"><img src="./assets/icons8-instagram-100.png" alt="Instagram"></a>
                    <a href="#" class="social-link"><img src="./assets/icons8-tiktok-100.png" alt="TikTok"></a>
                    <a href="#" class="social-link"><img src="./assets/icons8-youtube-100.png" alt="YouTube"></a>
                </div>
            </div>
            <div class="footer-column">
                <h4>Kontak</h4>
                <p class="footer-contact">📞 <span>+62 812-3456-7890</span></p>
                <p class="footer-contact">📧 <span>info@nusabina.ac.id</span></p>
                <p class="footer-contact">🏢 <span>Jl. Teknologi No. 123, Jakarta Selatan</span></p>
            </div>
            <div class="footer-column">
                <h4>Pendaftaran</h4>
                <p class="footer-info">Pendaftaran mahasiswa baru dibuka!</p>
                <a href="./php/daftar.php" class="footer-register-btn">Daftar Sekarang</a>
                <p class="footer-info-small">*Pendaftaran ditutup 31 Agustus 2026</p>
            </div>
            <div class="footer-column">
                <h4>Lokasi</h4>
                <div class="footer-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.829471!3d-6.208845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta!5e0!3m2!1sen!2sid!4v1700000000000" 
                        width="100%" 
                        height="120" 
                        style="border:0; border-radius: 10px;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Nusa Bina Informatika. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>