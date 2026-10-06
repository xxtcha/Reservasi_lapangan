<?php
include 'koneksi.php';

$id = $_POST['id_lapangan'];

$nama = $_POST['nama_lapangan'];
$ukuran = $_POST['ukuran_lapangan'];
$lantai = $_POST['jenis_lantai'];
$tempat = $_POST['tempat'];

$harga_pagi = $_POST['harga_pagi'];
$harga_sore = $_POST['harga_sore'];
$harga_malam = $_POST['harga_malam'];

$durasi = $_POST['durasi_sesi'];

if($_FILES['foto']['name']!="")
{
    $foto =
    $_FILES['foto']['name'];

    move_uploaded_file(
    $_FILES['foto']['tmp_name'],
    "uploads/lapangan/".$foto
    );

    mysqli_query($conn,"
    UPDATE lapangan
    SET
    foto_lapangan='$foto'
    WHERE id_lapangan='$id'
    ");
}

mysqli_query($conn,"
UPDATE lapangan
SET

nama_lapangan='$nama',
ukuran_lapangan='$ukuran',
jenis_lantai='$lantai',
tempat='$tempat',

harga_pagi='$harga_pagi',
harga_sore='$harga_sore',
harga_malam='$harga_malam',

durasi_sesi='$durasi'

WHERE id_lapangan='$id'
");

echo "
<script>
alert('Data lapangan berhasil diperbarui');
window.location='lapangan_admin.php';
</script>
";
?>