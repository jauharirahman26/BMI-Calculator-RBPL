<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menyesuaikan dengan 'name' di form Anggota 2
    $gender = $_POST['gender'] ?? '';
    $berat = $_POST['weight'] ?? 0; // Harus 'weight' agar sinkron
    $tinggi_cm = $_POST['height'] ?? 0; // Harus 'height' agar sinkron

    // Validasi server-side sesuai instruksi
    if (empty($gender) || $berat <= 0 || $tinggi_cm <= 0) {
        echo "<h3>Error: Data tidak valid!</h3><a href='index.php'>Kembali</a>";
        exit();
    }

    // Perhitungan BMI
    $tinggi_m = $tinggi_cm / 100;
    $bmi = $berat / ($tinggi_m * $tinggi_m);
    $bmi_format = number_format($bmi, 1);

    // Penentuan kategori & Tips (Sesuai dokumen tugas)
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
        $tips = "Saran: Konsultasikan dengan ahli gizi.";
        $warna = "red";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil BMI</title>
</head>
<body>
    <div style="text-align: center; margin-top: 50px;">
        <h3>Tampilan Hasil</h3>
        <p>Jenis Kelamin: <?php echo htmlspecialchars($gender); ?></p>
        <p>BMI Anda: <strong><?php echo $bmi_format; ?></strong></p>
        <p>Kategori: <b style="color: <?php echo $warna; ?>;"><?php echo $kategori; ?></b></p>
        <p><i><?php echo $tips; ?></i></p>
        <br>
        <a href="index.php">Hitung Ulang</a>
    </div>
</body>
</html>