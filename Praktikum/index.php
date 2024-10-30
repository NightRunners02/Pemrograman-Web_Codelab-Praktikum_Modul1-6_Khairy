<?php

function cetakBilangan($n) {
    // Memastikan input adalah bilangan bulat positif
    if (!is_int($n) || $n <= 0) {
        echo json_encode(["error" => "Silakan masukkan bilangan bulat positif."]) . "\n";
        return;
    }

    // Array untuk menyimpan hasil
    $hasil = [];

    for ($i = 1; $i <= $n; $i++) {
        // Cek kondisi
        if ($i % 4 == 0 && $i % 6 == 0) {
            $hasil[] = "Pemrograman Website 2024";
        } elseif ($i % 5 == 0) {
            $hasil[] = "2024";
        } elseif ($i % 4 == 0) {
            $hasil[] = "Pemrograman";
        } elseif ($i % 6 == 0) {
            $hasil[] = "Website";
        } else {
            $hasil[] = $i; // Mencetak bilangan itu sendiri
        }
    }

    // Mengonversi hasil ke format JSON
    echo json_encode($hasil, JSON_PRETTY_PRINT) . "\n";
}

// Contoh penggunaan fungsi
$n = 24; // Ganti nilai ini untuk mencoba bilangan lain
cetakBilangan($n);
