<?php

session_start();
include 'koneksi.php';

$id_pesanan = $_GET['id'];

if(isset($_POST['upload']))
{
    $file = $_FILES['bukti_bayar'];

    $namaFile = $file['name'];
    $tmpFile = $file['tmp_name'];
    $ukuran = $file['size'];

    $ext = strtolower(
        pathinfo(
            $namaFile,
            PATHINFO_EXTENSION
        )
    );

    $allowed = [
        'jpg',
        'jpeg',
        'png'
    ];

    if(!in_array($ext,$allowed))
    {
        echo "
        <script>
        alert('File harus JPG, JPEG atau PNG');
        history.back();
        </script>";
        exit;
    }

    if($ukuran > 5000000)
    {
        echo "
        <script>
        alert('Ukuran maksimal 5MB');
        history.back();
        </script>";
        exit;
    }

    $namaBaru =
        'BUKTI_'.
        time().
        '_'.
        rand(1000,9999).
        '.'.$ext;

    $folder = "uploads/";

    if(!is_dir($folder))
    {
        mkdir($folder,0777,true);
    }

    if(
        move_uploaded_file(
            $tmpFile,
            $folder.$namaBaru
        )
    )
    {

        mysqli_query(
            $conn,
            "
            UPDATE pembayaran
            SET

            bukti_pembayaran='$namaBaru',
            status_pembayaran='Menunggu Verifikasi'

            WHERE id_pesanan='$id_pesanan'
            "
        );

        echo "
        <script>

        alert('Bukti pembayaran berhasil diupload');

        window.location='pesanan_anda.php?id=$id_pesanan';

        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Upload Bukti Pembayaran</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#121417;
color:white;
font-family:Poppins,sans-serif;
}

.card-upload{
background:#1c1f24;
border:1px solid #333;
border-radius:15px;
padding:30px;
max-width:600px;
margin:auto;
margin-top:80px;
}

.btn-upload{
background:#f39c12;
border:none;
width:100%;
padding:15px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="card-upload">

<h2 class="mb-4">
UPLOAD BUKTI PEMBAYARAN
</h2>

<form
method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">
Pilih Bukti Transfer
</label>

<input
type="file"
name="bukti_bayar"
class="form-control"
required>

</div>

<button
type="submit"
name="upload"
class="btn btn-upload">

UPLOAD SEKARANG

</button>

</form>

</div>

</body>
</html>