<?php
/**
 * INTEGRASI FINAL: Anggota 6 (Validasi) + Anggota 3 (Tampilan)
 */
require_once 'functions.php'; 

$pesan_error = "";
$skor_bmi = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Ambil & Bersihkan Data (Tugas Anggota 6)
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $berat  = isset($_POST['weight']) ? trim($_POST['weight']) : ''; 
    $tinggi = isset($_POST['height']) ? trim($_POST['height']) : '';

    // 2. Validasi Server-Side (Tugas Anggota 6)
    if (empty($gender) || empty($berat) || empty($tinggi)) {
        $pesan_error = "Data tidak lengkap! Harap isi berat, tinggi, dan pilih jenis kelamin.";
    } 
    elseif (!is_numeric($berat) || !is_numeric($tinggi)) {
        $pesan_error = "Berat dan tinggi harus berupa angka.";
    } 
    elseif ($berat <= 0 || $tinggi <= 0) {
        $pesan_error = "Nilai berat dan tinggi harus lebih besar dari nol.";
    }

    // 3. Eksekusi Fungsi (Tugas Anggota 4)
    if (empty($pesan_error)) {
        $hasil = hitungBMI($berat, $tinggi, $gender);

        if (isset($hasil['error'])) {
            $pesan_error = $hasil['error'];
        } else {
            $skor_bmi  = $hasil['bmi'];
            $kategori  = $hasil['kategori'];
            $deskripsi = $hasil['deskripsi'];
            $tips      = $hasil['tips'];
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis BMI</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container-bmi">
        
        <?php if (!empty($pesan_error)): ?>
            <div class="error-box" style="text-align: center; margin-top: 50px;">
                <div style="background: #e74c3c; color: white; padding: 20px; border-radius: 8px; display: inline-block;">
                    <h3>Oops! Ada Kesalahan</h3>
                    <p><?php echo htmlspecialchars($pesan_error); ?></p>
                    <a href="index.php" style="color: white; text-decoration: underline;">Kembali</a>
                </div>
            </div>

        <?php elseif ($skor_bmi !== null): ?>
            <div class="result-card">
                <h2>Hasil Perhitungan BMI</h2>

                <div class="result-score">
                    <span>Skor BMI</span>
                    <h1><?php echo number_format($skor_bmi, 1); ?></h1>
                </div>

                <div class="result-category">
                    <strong><?php echo $kategori; ?></strong>
                    <p><?php echo $deskripsi; ?></p>
                </div>

                <div class="result-tips">
                    <h4>Saran Kesehatan</h4>
                    <p><?php echo $tips; ?></p>
                </div>

                <a href="index.php" class="btn-back">Hitung Ulang</a>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>