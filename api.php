<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $suhu = $_POST['suhu'] ?? null;
    $kelembaban = $_POST['kelembaban'] ?? null;

    if (is_numeric($suhu) && is_numeric($kelembaban)) {
        $stmt = $conn->prepare("INSERT INTO sensor_data (suhu, kelembaban) VALUES (?, ?)");
        $stmt->bind_param("dd", $suhu, $kelembaban);
        if ($stmt->execute()) {
            echo "Data berhasil dimasukkan";
        } else {
            echo "Gagal menyimpan data";
        }
        $stmt->close();
    } else {
        echo "Data tidak valid";
    }
} else {
    echo "Gunakan metode POST";
}

$conn->close();
?>
