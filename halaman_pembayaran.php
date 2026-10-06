<?php
$id_pesanan = $_GET['id_pesanan'];

// Join tabel pesanan dan pembayaran untuk mendapatkan kode invoice
$query = "SELECT pesanan.kode_invoice, pesanan.total_biaya 
          FROM pesanan 
          WHERE pesanan.id_pesanan = '$id_pesanan'";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

echo "Kode Invoice Anda: " . $data['kode_invoice'];
?>