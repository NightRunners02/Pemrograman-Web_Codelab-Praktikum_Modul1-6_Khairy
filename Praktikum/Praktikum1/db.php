<?php
// Konfigurasi database
$servername = "localhost"; // Ganti dengan host Anda
$username = "root";        // Ganti dengan username MySQL Anda
$password = "";            // Ganti dengan password MySQL Anda
$dbname = "kursus_db";     // Nama database yang digunakan

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
