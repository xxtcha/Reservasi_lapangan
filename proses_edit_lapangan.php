<?php
include 'koneksi.php';

$id_lapangan = $_POST['id_lapangan'];

$nama_lapangan = mysqli_real_escape_string($conn,$_POST['nama_lapangan']);

$panjang = (int)$_POST['panjang'];
$lebar   = (int)$_POST['lebar'];

$ukuran_lapangan = $panjang." x ".$lebar." Meter";

$jenis_lantai = mysqli_real_escape_string($conn,$_POST['jenis_lantai']);
$tempat = $_POST['tempat'];

$harga_per_jam = $_POST['harga_per_jam'];

$harga_pagi = $_POST['harga_pagi'];
$harga_sore = $_POST['harga_sore'];
$harga_malam = $_POST['harga_malam'];

$durasi_sesi = $_POST['durasi_sesi'];

$foto = $_POST['foto_lama'];

if($_FILES['foto']['name']!=""){

    $ext = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);

    $foto = time().".".$ext;

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "assets/img/".$foto
    );
}

$query = mysqli_query($conn,"
UPDATE lapangan SET

nama_lapangan='$nama_lapangan',
ukuran_lapangan='$ukuran_lapangan',

panjang='$panjang',
lebar='$lebar',

jenis_lantai='$jenis_lantai',
tempat='$tempat',

harga_per_jam='$harga_per_jam',

harga_pagi='$harga_pagi',
harga_sore='$harga_sore',
harga_malam='$harga_malam',

durasi_sesi='$durasi_sesi',

foto='$foto'

WHERE id_lapangan='$id_lapangan'
");

if($query){

    header("Location: lapangan_admin.php");
    exit;

}else{

    echo mysqli_error($conn);

}
?>