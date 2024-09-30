<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Angka dalam Teks</title>
</head>
<body>
    <h1>Cek Angka dalam Teks</h1>
    <form method="post" action="">
        <p>Masukkan teks:</p>
        <input type="text" name="inputTeks" />
        <button type="submit">Cek</button>
    </form>
    <p>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil nilai dari input teks
            $teks = $_POST['inputTeks'];
            // Temukan angka dalam teks
            preg_match_all('/\d/', $teks, $matches);

            if (!empty($matches[0])) {
                // Jika ditemukan angka, gabungkan menjadi string dengan koma
                $angkaTerdapat = implode(", ", $matches[0]);
                echo "teks mengandung angka : " . $angkaTerdapat;
            } else {
                // Jika tidak ditemukan angka
                echo "teks tidak mengandung angka.";
            }
        }
        ?>
    </p>
</body>
</html>
