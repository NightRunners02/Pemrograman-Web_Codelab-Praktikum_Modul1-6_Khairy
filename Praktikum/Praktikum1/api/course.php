<?php
include '../db.php';  // Menghubungkan ke database

// Menangani permintaan GET untuk mendapatkan kursus berdasarkan ID atau semua kursus
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Mencari kursus berdasarkan ID
        $id = $_GET['id'];
        $sql = "SELECT * FROM courses WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $course = $result->fetch_assoc();
            echo json_encode($course);
        } else {
            echo json_encode(['message' => 'Kursus tidak ditemukan']);
        }
    } else {
        // Mengambil semua kursus
        $sql = "SELECT * FROM courses";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $courses = [];
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row;
            }
            echo json_encode($courses);
        } else {
            echo json_encode(['message' => 'Tidak ada kursus ditemukan']);
        }
    }
}

// Menangani permintaan POST untuk menambahkan kursus baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $name = $data->name;
    $description = $data->description;

    // Query untuk memasukkan kursus baru
    $sql = "INSERT INTO courses (name, description) VALUES ('$name', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Kursus berhasil ditambahkan']);
    } else {
        echo json_encode(['error' => 'Gagal menambahkan kursus']);
    }
}

// Menangani permintaan PUT untuk memperbarui kursus
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = json_decode(file_get_contents("php://input"));
    $name = $data->name;
    $description = $data->description;

    // Query untuk memperbarui kursus
    $sql = "UPDATE courses SET name='$name', description='$description' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Kursus berhasil diperbarui']);
    } else {
        echo json_encode(['error' => 'Gagal memperbarui kursus']);
    }
}

// Menangani permintaan DELETE untuk menghapus kursus
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus kursus berdasarkan ID
    $sql = "DELETE FROM courses WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Kursus berhasil dihapus']);
    } else {
        echo json_encode(['error' => 'Gagal menghapus kursus']);
    }
}
?>
