<?php
include '../db.php';

// Cek apakah request menggunakan metode GET, POST, PUT, atau DELETE
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        // Mengambil pesan kontak berdasarkan ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM contact_messages WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo json_encode($row);
            } else {
                echo json_encode(['message' => 'Pesan tidak ditemukan']);
            }
        } else {
            // Jika tidak ada ID dalam URL, tampilkan semua pesan
            $sql = "SELECT * FROM contact_messages";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $contacts = [];
                while ($row = $result->fetch_assoc()) {
                    $contacts[] = $row;
                }
                echo json_encode($contacts);
            } else {
                echo json_encode(['message' => 'Tidak ada pesan kontak']);
            }
        }
        break;

    case 'POST':
        // Menambahkan pesan kontak baru
        $data = json_decode(file_get_contents("php://input"));

        // Ambil data dari body request
        $name = $data->name;
        $email = $data->email;
        $message = $data->message;

        // Validasi data
        if (!empty($name) && !empty($email) && !empty($message)) {
            // Query untuk menyimpan pesan kontak ke database
            $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(['message' => 'Pesan berhasil dikirim']);
            } else {
                echo json_encode(['error' => 'Gagal mengirim pesan']);
            }
        } else {
            echo json_encode(['error' => 'Semua field harus diisi']);
        }
        break;

    case 'PUT':
        // Memperbarui pesan kontak berdasarkan ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = json_decode(file_get_contents("php://input"));

            $name = $data->name;
            $email = $data->email;
            $message = $data->message;

            // Validasi data
            if (!empty($name) && !empty($email) && !empty($message)) {
                // Query untuk memperbarui pesan kontak di database
                $sql = "UPDATE contact_messages SET name='$name', email='$email', message='$message' WHERE id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo json_encode(['message' => 'Pesan berhasil diperbarui']);
                } else {
                    echo json_encode(['error' => 'Gagal memperbarui pesan']);
                }
            } else {
                echo json_encode(['error' => 'Semua field harus diisi']);
            }
        } else {
            echo json_encode(['error' => 'ID tidak ditemukan']);
        }
        break;

    case 'DELETE':
        // Menghapus pesan kontak berdasarkan ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query untuk menghapus pesan kontak
            $sql = "DELETE FROM contact_messages WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(['message' => 'Pesan berhasil dihapus']);
            } else {
                echo json_encode(['error' => 'Gagal menghapus pesan']);
            }
        } else {
            echo json_encode(['error' => 'ID tidak ditemukan']);
        }
        break;

    default:
        echo json_encode(['error' => 'Metode tidak valid']);
        break;
}

$conn->close();
?>
