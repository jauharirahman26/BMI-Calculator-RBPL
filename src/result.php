<?php
/**
 * TUGAS ANGGOTA 3: HALAMAN HASIL (RESULT)
 * Deskripsi: Menghubungkan Input (Anggota 2) dengan Fungsi (Anggota 4)
 */

// 1. Memanggil file logika dari Anggota 4
// Pastikan file functions.php ada di folder yang sama (src/)
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 2. Mengambil data POST sesuai 'name' dari form Anggota 2
    $gender = $_POST['gender'] ?? '';
    $berat  = $_POST['weight'] ?? 0; // Sesuai name="weight" Anggota 2
    $tinggi = $_POST['height'] ?? 0; // Sesuai name="height" Anggota 2

    // 3. Menjalankan fungsi hitungBMI yang dibuat Anggota 4
    // Fungsi ini mengembalikan array berisi bmi, kategori, deskripsi, dan tips
    $hasil = hitungBMI($berat, $tinggi, $gender);

    // 4. Cek apakah ada error dari validasi fungsi
    if (isset($hasil['error'])) {
        $error_msg = $hasil['error'];
    } else {
        $score_bmi  = $hasil['bmi'];
        $kategori   = $hasil['kategori'];
        $deskripsi  = $hasil['deskripsi'];
        $tips       = $hasil['tips'];
    }
} else {
    // Proteksi jika halaman diakses tanpa form, balikkan ke folder utama
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan BMI</title>
    <link rel="stylesheet" href="../style.css"> <style>
        .result-container { 
            border: 2px solid #ccc; 
            padding: 25px; 
            border-radius: 15px; 
            width: 350px; 
            margin: 50px auto; 
            text-align: center; 
            font-family: Arial, sans-serif; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
        }
        .bmi-score { font-size: 48px; font-weight: bold; color: #2c3e50; margin: 10px 0; }
        .kategori-label { font-size: 20px; font-weight: bold; color: #e67e22; text-transform: uppercase; }
        .tips-box { background: #fdf2e9; padding: 10px; border-radius: 8px; margin-top: 20px; text-align: left; font-size: 14px; }
        .btn-back { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

    <div class="result-container">
        <?php if (isset($error_msg)): ?>
            <h3 style="color: red;">Kesalahan Input!</h3>
            <p><?php echo htmlspecialchars($error_msg); ?></p>
            <a href="../index.php" class="btn-back">Kembali</a>
        <?php else: ?>
            <h2>Hasil Analisis BMI</h2>
            <hr>
            <p>Skor Indeks Massa Tubuh Anda:</p>
            <div class="bmi-score"><?php echo $score_bmi; ?></div>
            <div class="kategori-label"><?php echo $kategori; ?></div>
            <p><i>"<?php echo $deskripsi; ?>"</i></p>
            
            <div class="tips-box">
                <strong>💡 Tips Kesehatan:</strong><br>
                <?php echo $tips; ?>
            </div>

            <a href="../index.php" class="btn-back">Hitung Ulang</a>
        <?php endif; ?>
    </div>

</body>
</html>