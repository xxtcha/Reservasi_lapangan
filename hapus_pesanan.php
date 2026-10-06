<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_pelanggan']))
{
    header("Location:index.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];
$id_pesanan = $_GET['id'];

$cek = mysqli_query(
$conn,
"SELECT *
FROM pesanan
WHERE id_pesanan='$id_pesanan'
AND id_pelanggan='$id_pelanggan'"
);

if(mysqli_num_rows($cek)==0)
{
    die("Akses ditolak");
}

mysqli_query(
$conn,
"DELETE FROM pembayaran
WHERE id_pesanan='$id_pesanan'"
);

mysqli_query(
$conn,
"DELETE FROM detail_pesanan
WHERE id_pesanan='$id_pesanan'"
);

mysqli_query(
$conn,
"DELETE FROM pesanan
WHERE id_pesanan='$id_pesanan'"
);

header("Location:riwayat_pesanan.php");
exit;
?>