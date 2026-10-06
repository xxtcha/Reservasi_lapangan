<?php
session_start(); // Wajib ada untuk mengambil id_pelanggan
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = $_SESSION['id_pelanggan'] ?? 1; // Pastikan session login sudah diset
    $id_lapangan  = $_POST['id_lapangan'];
    $tanggal      = $_POST['tanggal'];
    $jam          = $_POST['jam'];
    $tujuan       = $_POST['tujuan'];
    $total_bayar  = $_POST['total_bayar']; 
    $metode       = $_POST['metode'];

   $angka_acak = rand(10000, 99999);
    $kode_invoice = "INV" . $angka_acak;

    $query_pesanan = "INSERT INTO pesanan (id_pelanggan, kode_invoice, id_lapangan, tanggal, jam, tujuan, total_biaya) 
                      VALUES ('$id_pelanggan', '$kode_invoice', '$id_lapangan', '$tanggal', '$jam', '$tujuan', '$total_bayar')";

    if (mysqli_query($conn, $query_pesanan)) {
        $id_pesanan_baru = mysqli_insert_id($conn);
        $query_pembayaran = "INSERT INTO pembayaran (id_pesanan, metode_bayar, status_pembayaran) 
                             VALUES ('$id_pesanan_baru', '$metode', 'Menunggu Verifikasi')";
        mysqli_query($conn, $query_pembayaran);
        header("Location: pesanan_anda.php?id=" . $id_pesanan_baru);
        exit();
    } else {
        die("Error Pesanan: " . mysqli_error($conn));
    }
}
?>