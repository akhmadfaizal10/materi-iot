<?php
include 'koneksi.php';

// Ambil data sensor
$sql = "SELECT * FROM sensor_data ORDER BY waktu DESC";
$result = $conn->query($sql);

// Ambil status LED
$ledStatus = "OFF";
$led = $conn->query("SELECT status FROM led_status WHERE id = 1");
if ($led && $led->num_rows > 0) {
    $ledStatus = $led->fetch_assoc()['status'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Sensor</title>
    <!-- <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        .center { text-align: center; margin-top: 20px; }
        button { padding: 10px 20px; margin: 5px; }
    </style> -->
</head>
<body>
    <h2 >Data Sensor Suhu & Kelembaban</h2>

    <div class="center">
        <p>Status LED: <b id="led"><?= $ledStatus ?></b></p>
        <form method="POST" action="update_led.php">
            <button name="status" value="ON">LED ON</button>
            <button name="status" value="OFF">LED OFF</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Suhu (°C)</th>
                <th>Kelembaban (%)</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['suhu'] ?></td>
                        <td><?= $row['kelembaban'] ?></td>
                        <td><?= $row['waktu'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">Belum ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php $conn->close(); ?>
