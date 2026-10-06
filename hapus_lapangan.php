<?php
include 'koneksi.php';

$id = $_GET['id'];

$data =
mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT foto_lapangan
FROM lapangan
WHERE id_lapangan='$id'"
)
);

if(file_exists(
"uploads/lapangan/".
$data['foto_lapangan']
))
{
unlink(
"uploads/lapangan/".
$data['foto_lapangan']
);
}

mysqli_query(
$conn,
"DELETE FROM lapangan
WHERE id_lapangan='$id'"
);

echo "
<script>
alert('Lapangan berhasil dihapus');
window.location='lapangan_admin.php';
</script>
";
?>