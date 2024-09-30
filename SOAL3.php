<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perkalian 5</title>
</head>
<body>
    <h1>Hasil Perkalian 5</h1>
    <p>
        <?php
        $max = 50;
        $perkalian = 10;
        
        for ($i = 1; $i <= $max; $i++) {
            if (strpos((string)($i * $perkalian), '0') === false) {
                echo $i . " x " . $perkalian . " = " . ($i * $perkalian) . "<br>";
            }
        }
        ?>
    </p>
</body>
</html>
