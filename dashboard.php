<?php
session_start();
include("connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

$getUser = $conn->query("SELECT user_id FROM user WHERE username='$username'");
$userData = $getUser->fetch_assoc();
$user_id = $userData['user_id'];

$totalMasukQuery = $conn->query("
    SELECT SUM(jumlah) AS total 
    FROM transaksi 
    WHERE user_id = $user_id AND jenis='pemasukan'
");
$totalMasuk = $totalMasukQuery->fetch_assoc()['total'] ?? 0;
$totalKeluarQuery = $conn->query("
    SELECT SUM(jumlah) AS total 
    FROM transaksi 
    WHERE user_id = $user_id AND jenis='pengeluaran'
");
$totalKeluar = $totalKeluarQuery->fetch_assoc()['total'] ?? 0;

$kategoriQuery = $conn->query("
    SELECT * FROM kategori 
    WHERE user_id = $user_id 
    ORDER BY nama
");

$dataQuery = $conn->query("
    SELECT t.*, k.nama AS kategori 
    FROM transaksi t 
    JOIN kategori k ON t.kategori_id = k.id
    WHERE t.user_id = $user_id 
    ORDER BY tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Finansisten</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>

<div class="dashboard-container">
    <div class="welcome-box">
        <div class="welcome-left">
            <h2>Halo, <?= $username ?></h2>
            <a href="index.php" class="logout-btn">Logout</a>
            <p>Yuk kelola keuanganmu</p>
        </div>
    </div>

    <div class="total-wrapper">
        <div class="total-card">
            Total Pemasukan:
            <span>Rp <?= number_format($totalMasuk, 0, ',', '.') ?></span>
        </div>

        <div class="total-card">
            Total Pengeluaran:
            <span>Rp <?= number_format($totalKeluar, 0, ',', '.') ?></span>
        </div>
    </div>

    <div class="input-section">
        <h3>Catat Transaksi</h3>
        <form action="tambah_transaksi.php" method="POST" class="expense-form" id="formTransaksi">
            <select name="jenis" id="selectJenis" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="pemasukan">Pemasukan</option>
                <option value="pengeluaran">Pengeluaran</option>
            </select>

            <select name="kategori_id" id="kategoriSelect" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while ($k = $kategoriQuery->fetch_assoc()) { ?>
                    <option value="<?= $k['id'] ?>"><?= ucfirst($k['nama']) ?></option>
                <?php } ?>
                <option value="add_new">Tambah kategori</option>
            </select>

        <div class="input-wrapper">
            <span class="prefix">Rp</span>
            <input type="number" name="jumlah" id="inputJumlah" required>
        </div>
        
            <input type="date" name="tanggal" id="inputTanggal" required>
            <button type="submit" class="btn">Tambah</button>
        </form>
    </div>

    <div class="table-section">
        <h3>Riwayat Transaksi</h3>
        <table class="data-table">
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
            <?php while ($row = $dataQuery->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['tanggal'] ?></td>
                <td><?= ucfirst($row['jenis']) ?></td>
                <td><?= ucfirst($row['kategori']) ?></td>
                <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="modal" id="modalKategori">
    <div class="modal-content">
        <h3>Tambah Kategori Baru</h3>

        <form id="formKategori">
            <input type="hidden" name="jenis" id="jenisKategori">
            <input type="text" name="nama" placeholder="Nama kategori..." required>
            <button class="btn-save" type="submit">Simpan</button>
        </form>
        <button class="close-btn" onclick="closeModal()">Batal</button>
    </div>
</div>

<div id="popupOverlay" class="popup-overlay">
    <div class="popup-box">
        <h3>Pilih jenis transaksi</h3>
    </div>
</div>


<script>
const kategoriSelect = document.getElementById("kategoriSelect");
const modal = document.getElementById("modalKategori");
const jenisSelect = document.getElementById("selectJenis");
const jenisKategoriInput = document.getElementById("jenisKategori");

kategoriSelect.addEventListener("change", () => {
    if (kategoriSelect.value === "add_new") {
        if (jenisSelect.value === "") {
            const popup = document.getElementById("popupOverlay");
            popup.style.display = "flex";

            setTimeout(() => {
                popup.style.display = "none";
            }, 3000);

            kategoriSelect.value = "";
            return;
        }
    }
});

function closeModal() {
    modal.style.display = "none";
}

document.getElementById("formKategori").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("tambah_kategori.php", {
        method: "POST",
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === "success") {

            let opt = document.createElement("option");
            opt.value = data.id;
            opt.textContent = data.nama;

            kategoriSelect.appendChild(opt);
            kategoriSelect.value = data.id;

            closeModal();
        }
    });
});
</script>

</body>
</html>