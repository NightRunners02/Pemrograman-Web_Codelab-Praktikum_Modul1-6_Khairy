<?php
$tinggi = 5; // Tinggi segitiga

for ($i = $tinggi; $i >= 1; $i--) {
    // Cetak spasi
    for ($j = $tinggi; $j > $i; $j--) {
        echo "&nbsp;&nbsp;"; // Tambahkan spasi ganda (jika Anda masih ingin spasi)
    }

    // Cetak bintang
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }

    // Pindah ke baris berikutnya
    echo "<br>";
}
?>
