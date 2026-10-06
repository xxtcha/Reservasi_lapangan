<?php
session_start();

if(!isset($_SESSION['id_admin']))
{
    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tambah Lapangan</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

body{
background:#05080d;
font-family:Poppins;
color:white;
padding:40px;
}

h1{
font-family:Anton;
font-size:60px;
text-align:center;
}

.form{
width:800px;
margin:auto;
}

label{
display:block;
margin-top:15px;
margin-bottom:5px;
color:#f5a300;
font-weight:bold;
}

input,
select{
width:100%;
padding:15px;
border:none;
border-radius:6px;
}

button{
margin-top:25px;
background:#f5a300;
border:none;
padding:15px 30px;
border-radius:8px;
font-weight:bold;
cursor:pointer;
}

</style>
</head>

<body>

<h1>TAMBAH LAPANGAN</h1>

<form
class="form"
action="proses_tambah_lapangan.php"
method="POST"
enctype="multipart/form-data">

<label>Foto Lapangan</label>
<input type="file" name="foto" required>

<label>Nama Lapangan</label>
<input type="text" name="nama_lapangan" required>

<label>Ukuran Lapangan</label>
<input type="text" name="ukuran_lapangan" required>

<label>Jenis Lantai</label>
<input type="text" name="jenis_lantai" required>

<label>Tempat</label>

<select name="tempat">
<option>Indoor</option>
<option>Outdoor</option>
</select>

<label>Harga Pagi</label>
<input type="number" name="harga_pagi" required>

<label>Harga Sore</label>
<input type="number" name="harga_sore" required>

<label>Harga Malam</label>
<input type="number" name="harga_malam" required>

<label>Durasi Sesi</label>
<input type="text" name="durasi_sesi" required>

<button type="submit">
SIMPAN LAPANGAN
</button>

</form>

</body>
</html>