<?php
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($conn,"
UPDATE pesanan
SET status_pesanan='Dibatalkan'
WHERE id_pesanan='$id'
");

echo "
<script>
alert('Pesanan ditolak');
window.location='pesanan_admin.php';
</script>
";
?>