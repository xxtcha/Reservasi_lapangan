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
SET status_pembayaran='Ditolak'
WHERE id_pembayaran='$id'
");

mysqli_query($conn,"
UPDATE pesanan
SET status_pesanan='Dibatalkan'
WHERE id_pesanan='".$data['id_pesanan']."'
");

echo "
<script>
alert('Bukti pembayaran ditolak');
window.location='pesanan_admin.php';
</script>
";
?>