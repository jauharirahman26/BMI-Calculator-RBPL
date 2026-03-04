<?php

require_once __DIR__ . '/../src/functions.php';

echo "HASIL UNIT TESTING - KALKULATOR BMI\n";
echo "-----------------------------------\n";

$testCases = [
    // --- 1. INPUT NORMAL & INVALID ---
    ["id" => "TC-01", "ket" => "Pria (Standard)", "w" => 70, "h" => 175, "expect" => "Normal"],
    ["id" => "TC-02", "ket" => "Wanita (Standard)", "w" => 55, "h" => 160, "expect" => "Normal"],
    ["id" => "TC-03", "ket" => "Input Kosong", "w" => "", "h" => "", "expect" => "error"],
    ["id" => "TC-04", "ket" => "Angka Negatif", "w" => -50, "h" => 160, "expect" => "error"],

    // --- 2. BATAS KATEGORI (URUT SESUAI PERMINTAAN) ---
    ["id" => "TC-05", "ket" => "Batas Bawah Normal", "w" => 53.47, "h" => 170, "expect" => "Normal"],
    ["id" => "TC-06", "ket" => "Batas Atas Normal",  "w" => 71.97, "h" => 170, "expect" => "Normal"],
    ["id" => "TC-07", "ket" => "Kategori Kurus",      "w" => 45,    "h" => 170, "expect" => "Kurus"],
    ["id" => "TC-08", "ket" => "Kategori Gemuk",      "w" => 72.25, "h" => 170, "expect" => "Gemuk"],
    ["id" => "TC-09", "ket" => "Kategori Obesitas",   "w" => 86.7,  "h" => 170, "expect" => "Obesitas"]
];

$passed = 0;

foreach ($testCases as $case) {
    // Kita asumsikan pria untuk testing kategori karena batasnya sama
    $res = hitungBMI($case['w'], $case['h'], "pria");
    $status = "FAIL";
    
    if ($case['expect'] == "error") {
        if (isset($res['error'])) $status = "OK";
    } else {
        if (isset($res['kategori']) && strpos(strtolower($res['kategori']), strtolower($case['expect'])) !== false) {
            $status = "OK";
        }
    }

    if ($status == "OK") $passed++;
    
    printf("%-7s %-30s [%s]\n", $case['id'], $case['ket'], $status);
}

echo "-----------------------------------\n";
echo "TOTAL LULUS: $passed/" . count($testCases) . "\n";
echo "HASIL AKHIR: " . ($passed == count($testCases) ? "TERVERIFIKASI" : "ADA BUG") . "\n";