<?php
session_start();
include 'koneksi.php';

if(!isset($_GET['id'])){
    die("ID Pesanan tidak ditemukan");
}

$id = $_GET['id'];

// Cek apakah sudah upload bukti pembayaran
$cek = mysqli_query($conn,"
SELECT bukti_pembayaran
FROM pembayaran
WHERE id_pesanan='$id'
");

$data = mysqli_fetch_assoc($cek);

if($data && !empty($data['bukti_pembayaran'])){
    echo "
    <script>
    alert('Pesanan tidak dapat dibatalkan karena bukti pembayaran sudah diupload.');
    history.back();
    </script>";
    exit;
}

// Hapus pembayaran
mysqli_query($conn,"
DELETE FROM pembayaran
WHERE id_pesanan='$id'
");

// Hapus pesanan
mysqli_query($conn,"
DELETE FROM pesanan
WHERE id_pesanan='$id'
");

// Kembali ke home
header("Location: home.php");
exit;
?>