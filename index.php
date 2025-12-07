<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finansisten - Asisten Finansialmu</title>
    <link rel="stylesheet" href="style_index.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="img/logo-finansisten.png" alt="finansisten logo">
        </div>
        <nav>
            <a href="#features">Fitur</a>
            <a href="#about">Tentang</a>
            <a href="login.php" class="nav-login">Masuk</a>
        </nav>
    </header>

    <section class="welcome-page">
        <div class="welcome-page-text">
            <h1>Asisten Finansial-mu</h1>
            <p>Bantu kamu catat pengeluaran mu. <br>
            Semua ada di satu genggaman!</p>
            <button class="cta-btn" onclick="window.location.href='register.php'">Mulai Sekarang</button>
        </div>

        <div class="welcome-img">
            <img src="img/homepage-pict-02.png" alt="finansisten illustration">
        </div>
    </section>

<section class="features" id="features">
        <h2 class="section-title">Fitur</h2>

        <div class="feature-grid">
            <div class="feature-card">
                <img src="img/bill.png" alt="icon">
                <h3>Pencatatan Instan</h3>
                <p>Tambah transaksi dalam hitungan detik, biar ga lupa kemana uangmu pergi.</p>
            </div>

            <div class="feature-card">
            <img src="img/analytics.png" alt="icon">
                <h3>Laporan Real-Time</h3>
                <p>Bisa lihat daftar transaksi kamu sesuai tanggal, jenis, dan  kategori.</p>
            </div>

        </div>
    </section>

<section class="about" id="about">
    <div class="about-container">

        <div class="about-img">
            <img src="img/graph.png" alt="About Finansisten">
        </div>

        <div class="about-box">
            <h2>Kelola Keuangan mu</h2>
            <p>
                Finansisten dibuat untuk kamu yang ingin hidup finansial lebih teratur tanpa perlu jadi expert dulu.
                Tampilan yang simpel dan alur penggunaan yang gampang bikin kamu betah mencatat
                keuangan setiap hari.
            </p>
            <button class="about-btn" onclick="window.location.href='register.php'">Daftar</button>
        </div>

    </div>
</section>

    <footer>
        © 2025 Finansisten
    </footer>

</body>
</html>
