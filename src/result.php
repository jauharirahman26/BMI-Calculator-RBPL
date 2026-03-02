<?php
// 1. Menerima data POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = $_POST['gender'] ?? '';
    $berat = $_POST['berat'] ?? 0;
    $tinggi_cm = $_POST['tinggi'] ?? 0;
    $satuan = $_POST['satuan'] ?? 'cm';

    // 2. Validasi server-side
    if (empty($gender) || empty($berat) || empty($tinggi_cm)) {
        $error = "Semua data harus diisi!";
    } elseif (!is_numeric($berat) || !is_numeric($tinggi_cm) || $berat <= 0 || $tinggi_cm <= 0) {
        $error = "Data harus berupa angka positif!";
    } else {
        // 3. Perhitungan BMI
        $tinggi_m = $tinggi_cm / 100;
        $bmi = $berat / ($tinggi_m * $tinggi_m);
        $bmi_format = number_format($bmi, 1);

        // 4. Penentuan kategori & Tips kesehatan
        if ($bmi < 18.5) {
            $kategori = "Kurus";
            $tips = "Saran: Tambah asupan gizi dan kalori sehat.";
            $warna = "orange";
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $kategori = "Normal";
            $tips = "Saran: Pertahankan pola makan dan olahraga teratur.";
            $warna = "green";
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $kategori = "Gemuk";
            $tips = "Saran: Kurangi makanan manis dan perbanyak aktivitas fisik.";
            $warna = "blue";
        } else {
            $kategori = "Obesitas";
            $tips = "Saran: Konsultasikan dengan ahli gizi untuk program diet.";
            $warna = "red";
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
    <title>Hasil BMI - Tugas Vian</title>
    <style>
        .result-box { border: 2px solid #ccc; padding: 20px; border-radius: 10px; width: 300px; margin: 50px auto; text-align: center; }
        .tips { font-style: italic; color: #555; margin-top: 15px; }
    </style>
</head>
<body>

    <div class="result-box">
        <?php if (isset($error)): ?>
            <h3 style="color: red;"><?php echo $error; ?></h3>
            <a href="index.php">Kembali</a>
        <?php else: ?>
            <h3>Tampilan Hasil</h3>
            <p>Gender: <?php echo htmlspecialchars($gender); ?></p>
            <p>BMI Anda: <strong><?php echo $bmi_format; ?></strong></p>
            <p>Kategori: <b style="color: <?php echo $warna; ?>;"><?php echo $kategori; ?></b></p>
            
            <div class="tips">
                <p><?php echo $tips; ?></p>
            </div>
            <br>
            <a href="index.php">Hitung Ulang</a>
        <?php endif; ?>
    </div>

</body>
</html>