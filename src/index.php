<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator BMI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-bmi">
        <h2>Kalkulator Indeks Massa Tubuh (BMI)</h2>
        
        <form action="result.php" method="POST" onsubmit="return validasiInput()">
            
            <div class="input-group">
                <label>Jenis Kelamin:</label><br>
                <input type="radio" id="pria" name="gender" value="pria" required>
                <label for="pria">Pria</label>
                <input type="radio" id="wanita" name="gender" value="wanita" required>
                <label for="wanita">Wanita</label>
            </div>

            <div class="input-group">
                <label for="weight">Berat Badan (kg):</label>
                <input type="number" id="weight" name="weight" step="any" required>
            </div>

            <div class="input-group">
                <label for="height">Tinggi Badan (cm):</label>
                <input type="number" id="height" name="height" step="any" required>
            </div>

            <button type="submit" id="btn-submit">Hitung BMI</button>
            
        </form>
    </div>

    <script>
        function validasiInput() {
            // Mengambil nilai dari input form
            let berat = document.getElementById("weight").value;
            let tinggi = document.getElementById("height").value;

            // Mengecek apakah angka yang dimasukkan positif
            if (berat <= 0) {
                alert("Mohon masukkan berat badan dengan angka positif yang valid.");
                return false; // Membatalkan submit form
            }

            if (tinggi <= 0) {
                alert("Mohon masukkan tinggi badan dengan angka positif yang valid.");
                return false; // Membatalkan submit form
            }

            // Jika semua validasi lolos, form akan dikirim ke result.php
            return true;
        }
    </script>
</body>
</html>