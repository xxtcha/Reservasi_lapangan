<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_pelanggan'])){
    header("Location:index.php");
    exit;
}

$nama = $_SESSION['nama_pelanggan'] ?? 'Pengguna';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;padding:40px}
        .nav{margin-bottom:20px}
        .nav a{margin-right:12px}
    </style>
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="pesanan_anda.php">Pesanan Saya</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Selamat datang, <?php echo htmlspecialchars($nama); ?></h1>
    <p>Ini adalah dashboard pengguna. Gunakan menu untuk melihat pesanan atau melakukan pemesanan.</p>

</body>
</html>