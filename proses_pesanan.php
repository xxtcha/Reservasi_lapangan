<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Generate kode invoice otomatis
    $tanggal_sekarang = date('Ymd');
    $random_number = rand(1000, 9999);
    $kode_invoice = "INV" . $tanggal_sekarang . $random_number;

    // 2. Ambil data dari form
    $id_pelanggan = $_SESSION['id_pelanggan']; // Contoh sesi
    $total = $_POST['total_biaya'];

    // 3. Simpan ke tabel 'pesanan'
    $query = "INSERT INTO pesanan (kode_invoice, id_pelanggan, total_biaya, status) 
              VALUES ('$kode_invoice', '$id_pelanggan', '$total', 'Menunggu Pembayaran')";
    
    if (mysqli_query($conn, $query)) {
        // Ambil ID pesanan yang baru saja dibuat
        $id_pesanan = mysqli_insert_id($conn);
        
        // 4. Arahkan ke halaman pembayaran dengan membawa id_pesanan
        header("Location: halaman_pembayaran.php?id_pesanan=" . $id_pesanan);
    }
}
?>