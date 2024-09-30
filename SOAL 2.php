<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Kompensasi</title>
</head>
<body>
    <h1>Hitung Kompensasi Pegawai</h1>
    <form method="post" action="">
        <p>Jam mulai kerja:</p>
        <input type="time" name="jamMulai" required />
        <p>Jam pulang kerja:</p>
        <input type="time" name="jamPulang" required />
        <button type="submit">Hitung Kompensasi</button>
    </form>
    <p>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $jamMulai = $_POST['jamMulai'];
            $jamPulang = $_POST['jamPulang'];

            

            $jamNormal = 8;

            $jamLembur = max(0, $lamaKerja - $jamNormal);

            
            $kompensasiJamPertama = 50000;
            $kompensasiJamBerikutnya = 25000;

          
            if ($jamLembur > 0) {
                $kompensasi = $kompensasiJamPertama; 
                $jamLembur -= 1; 
                $kompensasi += $jamLembur * $kompensasiJamBerikutnya; 
            } else {
                $kompensasi = 0;
            }

            echo "Lama kerja: " . $lamaKerja . " jam<br>";
            echo "Jam lembur: " . $jamLembur . " jam<br>";
            echo "Jumlah kompensasi: Rp. "($kompensasi, 0, ',', '.');
        }
        ?>
    </p>
</body>
</html>
