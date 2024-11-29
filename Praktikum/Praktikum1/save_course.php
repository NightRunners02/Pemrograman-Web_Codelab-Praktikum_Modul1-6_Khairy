<?php
// Memasukkan file koneksi ke database
include 'db.php';

// Mengecek apakah data dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data kursus yang dikirim dari form
    $course_name = $_POST['course_name'];

    // Query untuk menyimpan data kursus ke dalam database
    $sql = "INSERT INTO courses (name) VALUES ('$course_name')";

    // Mengeksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "Anda berhasil mendaftar untuk kursus: " . $course_name;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
}
?>
