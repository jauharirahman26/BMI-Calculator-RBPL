<?php
/**
 * Anggota 3: Halaman Result
 * Menghubungkan input Anggota 2 dengan fungsi Anggota 4
 */

// LANGKAH PENTING: Memanggil file functions.php agar fungsi hitungBMI() dikenali
require_once 'functions.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form index.php (Anggota 2)
    $gender = $_POST['gender'] ?? '';
    $berat  = $_POST['weight'] ?? 0; 
    $tinggi = $_POST['height'] ?? 0;

    // Menjalankan fungsi dari Anggota 4
    // Baris di bawah ini tidak akan error lagi setelah ada require_once di atas
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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div style="text-align: center; margin-top: 50px; font-family: sans-serif;">
        <?php if (isset($pesan_error)): ?>
            <h3 style="color: red;"><?php echo $pesan_error; ?></h3>
        <?php else: ?>
            <h2>Hasil Perhitungan BMI</h2>
            <p>Skor: <strong><?php echo $skor_bmi; ?></strong></p>
            <p>Kategori: <strong><?php echo $kategori; ?></strong></p>
            <p><i><?php echo $deskripsi; ?></i></p>
            <div style="margin-top: 20px; padding: 10px; background: #f0f0f0; display: inline-block;">
                <strong>Saran:</strong><br><?php echo $tips; ?>
            </div>
        <?php endif; ?>
        <br><br>
        <a href="index.php">Kembali</a>
    </div>
</body>
</html>