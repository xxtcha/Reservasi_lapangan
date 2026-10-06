<?php
session_start();
include 'koneksi.php';

$foto = $_FILES['foto']['name'];

move_uploaded_file(
$_FILES['foto']['tmp_name'],
"uploads/lapangan/".$foto
);

$admin = $_SESSION['id_admin'];

$nama = $_POST['nama_lapangan'];
$ukuran = $_POST['ukuran_lapangan'];
$lantai = $_POST['jenis_lantai'];
$tempat = $_POST['tempat'];

$harga_pagi = $_POST['harga_pagi'];
$harga_sore = $_POST['harga_sore'];
$harga_malam = $_POST['harga_malam'];

$durasi = $_POST['durasi_sesi'];

mysqli_query($conn,"
INSERT INTO lapangan
(
id_admin,
nama_lapangan,
foto_lapangan,
ukuran_lapangan,
jenis_lantai,
tempat,
harga_pagi,
harga_sore,
harga_malam,
durasi_sesi
)
VALUES
(
'$admin',
'$nama',
'$foto',
'$ukuran',
'$lantai',
'$tempat',
'$harga_pagi',
'$harga_sore',
'$harga_malam',
'$durasi'
)
");

echo "
<script>
alert('Lapangan berhasil ditambahkan');
window.location='lapangan_admin.php';
</script>
";
?>