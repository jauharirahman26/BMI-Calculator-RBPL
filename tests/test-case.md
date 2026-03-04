# Laporan Dokumentasi Pengujian (Test Cases)

Dokumen ini merinci 9 skenario pengujian yang telah dilakukan pada aplikasi Kalkulator BMI untuk memastikan validasi input, akurasi perhitungan, dan ketepatan nilai ambang batas.

## Tabel Skenario Pengujian (Urutan Terverifikasi)

| ID | Deskripsi Skenario | Input (W, H) | Ekspektasi Output | Status |
|:---|:---|:---|:---|:---|
| **TC-01** | Input Normal Pria | 70, 175 | Normal | **PASS** |
| **TC-02** | Input Normal Wanita | 55, 160 | Normal | **PASS** |
| **TC-03** | Validasi Input Kosong | "", "" | Error (Mohon isi kolom ini) | **PASS** |
| **TC-04** | Validasi Angka Negatif | -50, 160 | Error (Mohon masukkan dengan angka positif yang valid) | **PASS** |
| **TC-05** | Batas Bawah Normal | 53.47, 170 | Normal | **PASS** |
| **TC-06** | Batas Atas Normal | 71.97, 170 | Normal | **PASS** |
| **TC-07** | Kategori Kurus | 45, 170 | Kurus | **PASS** |
| **TC-08** | Kategori Gemuk | 72.25, 170 | Gemuk | **PASS** |
| **TC-09** | Kategori Obesitas | 86.7, 170 | Obesitas | **PASS** |

---

## Ringkasan Hasil Pengujian (Automated Testing)
Seluruh skenario di atas telah dieksekusi menggunakan skrip unit testing otomatis `BMITest.php` dengan hasil sebagai berikut:

* **Total Test Cases**: 9
* **Passed**: 9
* **Failed**: 0
* **Akurasi Nilai Batas**: Terverifikasi tepat pada angka ambang batas sesuai standar sistem.

**Kesimpulan:**
Berdasarkan hasil pengujian otomatis, aplikasi telah memenuhi standar validasi dan mampu memberikan klasifikasi kategori BMI yang akurat. Urutan pengujian telah disesuaikan untuk memastikan titik transisi (Boundary Value) antara kategori berfungsi dengan benar.