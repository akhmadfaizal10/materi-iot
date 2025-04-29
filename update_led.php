<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $sql = "UPDATE led_status SET status='$status' WHERE id = 1";
    $conn->query($sql);
    header("Location: tampil.php");
}
?>
