<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok Bilangan</title>
</head>
<body>
    <h1>Kelompok Bilangan</h1>
    <p>
        <?php
        $variabel1 = [77, 55, 90, 80];
        $variabel2 = [80, 65, 89, 12, 86];

        $kelompok1 = array_intersect($variabel1, $variabel2);

        $kelompok2 = array_merge(array_diff($variabel1, $variabel2), array_diff($variabel2, $variabel1));

        echo "Bilangan yang ada di kedua variabel: " . implode(", ", $kelompok1) . "<br>";
        echo "Bilangan yang tidak ada di kedua variabel: " . implode(", ", $kelompok2);
        ?>
    </p>
</body>
</html>