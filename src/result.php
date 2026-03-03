<?php
 * Anggota 3: Halaman Result
 * Menghubungkan input dengan fungsi
 */

// LANGKAH PENTING: Memanggil file functions.php agar fungsi hitungBMI() dikenali
require_once 'functions.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form index.php
    $gender = $_POST['gender'] ?? '';
    $berat  = $_POST['weight'] ?? 0; 
    $tinggi = $_POST['height'] ?? 0;

    // Menjalankan fungsi
    $hasil = hitungBMI($berat, $tinggi, $gender);

    if (isset($hasil['error'])) {
        $pesan_error = $hasil['error'];
    } else {
        $skor_bmi  = $hasil['bmi'];
        $kategori  = $hasil['kategori'];
        $deskripsi = $hasil['deskripsi'];
        $tips      = $hasil['tips'];
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
    <title>Hasil Analisis BMI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-bmi">
        <?php if (isset($pesan_error)): ?>
            <div class="error-box">
                <h3><?php echo $pesan_error; ?></h3>
                <a href="index.php" class="btn-back">Kembali</a>
            </div>
        <?php else: ?>
            <div class="result-card">
                <h2>Hasil Perhitungan BMI</h2>

                <div class="result-score">
                    <span>Skor BMI</span>
                    <h1><?php echo $skor_bmi; ?></h1>
                </div>

                <div class="result-category">
                    <strong><?php echo $kategori; ?></strong>
                    <p><?php echo $deskripsi; ?></p>
                </div>

                <div class="result-tips">
                    <h4>Saran</h4>
                    <p><?php echo $tips; ?></p>
                </div>

                <a href="index.php" class="btn-back">Hitung Ulang</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
