<?php
include 'db.php';

// Cek apakah form dikirimkan dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang dikirimkan melalui form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Cek apakah data tidak kosong
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Query untuk menyimpan pesan kontak ke dalam database
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            // Menampilkan pesan sukses
            echo json_encode(['message' => 'Pesan berhasil dikirim']);
        } else {
            // Menampilkan pesan error jika gagal menyimpan
            echo json_encode(['error' => 'Gagal mengirim pesan']);
        }
    } else {
        echo json_encode(['error' => 'Semua field harus diisi']);
    }
}

$conn->close();
?>
