<?php

function hitungBMI($berat, $tinggi, $gender) {

    // Verifikasi dasar
    if (!is_numeric($berat) || !is_numeric($tinggi)) {
        return [
            'error' => 'Input harus berupa angka.'
        ];
    }

    if ($berat <= 0 || $tinggi <= 0) {
        return [
            'error' => 'Berat dan tinggi harus lebih dari 0.'
        ];
    }

    // Konversi tinggi ke meter
    $tinggiMeter = $tinggi / 100;

    // Rumus bmi
    $bmi = $berat / ($tinggiMeter * $tinggiMeter);
    $bmi = round($bmi, 1);

    // Tentukan kategori
    if ($bmi < 18.5) {
        $kategori = "Kurus";
        $deskripsi = "Berat badan berada di bawah normal.";
        $tips = "Perbanyak asupan nutrisi dan latihan kekuatan.";
    } 
    elseif ($bmi <= 24.9) {
        $kategori = "Normal";
        $deskripsi = "Berat badan berada dalam rentang ideal.";
        $tips = "Pertahankan pola makan dan olahraga rutin.";
    } 
    elseif ($bmi <= 29.9) {
        $kategori = "Gemuk";
        $deskripsi = "Berat badan melebihi rentang ideal.";
        $tips = "Kurangi kalori dan tingkatkan aktivitas fisik.";
    } 
    else {
        $kategori = "Obesitas";
        $deskripsi = "Berisiko terhadap penyakit metabolik.";
        $tips = "Disarankan konsultasi medis dan program diet terkontrol.";
    }

    // Tambahan info gender (opsional, bukan rumus beda)
    if ($gender === "perempuan") {
        $deskripsi .= " Wanita alami memiliki lemak tubuh lebih tinggi.";
    } elseif ($gender === "laki-laki") {
        $deskripsi .= " Pria berotot bisa memiliki BMI tinggi tanpa obesitas.";
    }

    return [
        'bmi' => $bmi,
        'kategori' => $kategori,
        'deskripsi' => $deskripsi,
        'tips' => $tips
    ];
}