<?php
function compareNames($name1, $name2) {
    // Menghitung jumlah karakter dari kedua nama
    $length1 = strlen($name1);
    $length2 = strlen($name2);

    // Menampilkan jumlah karakter dari kedua nama
    echo "Jumlah karakter nama pertama: " . $length1 . "<br>";
    echo "Jumlah karakter nama kedua: " . $length2 . "<br>";

    // Membandingkan jumlah karakter dan menampilkan hasilnya
    if ($length1 > $length2) {
        echo "Nama dengan jumlah karakter lebih banyak adalah: \"$name1\" dengan selisih " . ($length1 - $length2) . " karakter.<br>";
    } elseif ($length2 > $length1) {
        echo "Nama dengan jumlah karakter lebih banyak adalah: \"$name2\" dengan selisih " . ($length2 - $length1) . " karakter.<br>";
    } else {
        echo "Kedua nama memiliki jumlah karakter yang sama.<br>";
    }
}

// Contoh penggunaan
compareNames("Fema Flamelia Putri", "Artasya Legina");
?>
