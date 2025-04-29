<?php
include 'koneksi.php';
$data = $conn->query("SELECT status FROM led_status WHERE id = 1");
echo $data->fetch_assoc()['status'];
?>
