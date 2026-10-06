<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM pembayaran
WHERE id_pembayaran='$id'"
)
);

mysqli_query($conn,"
UPDATE pembayaran
SET status_pembayaran='Diterima'
WHERE id_pembayaran='$id'
");

mysqli_query($conn,"
UPDATE pesanan
SET status_pesanan='Dibayar'
WHERE id_pesanan='".$data['id_pesanan']."'
");

echo "
<script>
alert('Pembayaran berhasil dikonfirmasi');
window.location='pesanan_admin.php';
</script>
";
?>