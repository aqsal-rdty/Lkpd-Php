<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urutan Perkalian Terbalik</title>
</head>
<body>
    <h1>Urutan Perkalian Terbalik</h1>
    <p>
        <?php
        $startX = 1;
        $endX = 2;
        $startY = 1;
        $endY = 10;

        // Mengumpulkan semua hasil perkalian dalam array
        $hasil = [];

        for ($i = $startX; $i <= $endX; $i++) {
            for ($j = $startY; $j <= $endY; $j++) {
                $hasil[] = $i . " x " . $j . " = " . ($i * $j);
            }
        }

        // Menampilkan hasil dalam urutan terbalik
        for ($k = count($hasil) - 1; $k >= 0; $k--) {
            echo $hasil[$k] . "<br>";
        }
        ?>
    </p>
</body>
</html>
