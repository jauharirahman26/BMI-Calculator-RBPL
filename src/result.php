<?php
require_once 'functions.php'; 

$pesan_error = "";
$skor_bmi = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $berat  = isset($_POST['weight']) ? trim($_POST['weight']) : ''; 
    $tinggi = isset($_POST['height']) ? trim($_POST['height']) : '';

    if (empty($gender) || empty($berat) || empty($tinggi)) {
        $pesan_error = "Data tidak lengkap! Harap isi berat, tinggi, dan pilih jenis kelamin.";
    } 
    elseif (!is_numeric($berat) || !is_numeric($tinggi)) {
        $pesan_error = "Berat dan tinggi harus berupa angka.";
    } 
    elseif ($berat <= 0 || $tinggi <= 0) {
        $pesan_error = "Nilai berat dan tinggi harus lebih besar dari nol.";
    }

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
    <title>Hasil Analisis BMI</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div style="text-align: center; margin-top: 50px; font-family: sans-serif;">
        
        <?php if (!empty($pesan_error)): ?>
            <div style="color: white; background: #e74c3c; padding: 20px; display: inline-block; border-radius: 8px;">
                <strong>Kesalahan Validasi:</strong><br>
                <?php echo htmlspecialchars($pesan_error); ?>
            </div>
        
        <?php elseif ($skor_bmi !== null): ?>
            <h2>Hasil Perhitungan BMI</h2>
            <p>Skor BMI: <strong><?php echo number_format($skor_bmi, 1); ?></strong></p>
            <p>Kategori: <strong><?php echo $kategori; ?></strong></p>
            <p><i><?php echo $deskripsi; ?></i></p>
            
            <div style="margin-top: 20px; padding: 15px; background: #ecf0f1; display: inline-block; border-radius: 8px; border-left: 5px solid #2ecc71;">
                <strong>Saran Kesehatan:</strong><br>
                <?php echo $tips; ?>
            </div>
        <?php endif; ?>

        <br><br>
        <a href="index.php" style="text-decoration: none; color: #3498db;">← Kembali Hitung</a>
    </div>
</body>
</html>