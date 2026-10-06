<?php
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"
UPDATE pesanan
SET status_pesanan='Dibayar'
WHERE id_pesanan='$id'
");

echo "
<script>
alert('Pesanan berhasil dikonfirmasi');
window.location='pesanan_admin.php';
</script>
";
?>