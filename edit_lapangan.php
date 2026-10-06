<?php
session_start();
include 'koneksi.php';

$id=$_GET['id'];

$q=mysqli_query($conn,"
SELECT *
FROM lapangan
WHERE id_lapangan='$id'
");

$data=mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Lapangan</title>

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
text-align:center;
font-size:60px;
}

.grid{
display:grid;
grid-template-columns:
350px 1fr;
gap:30px;
}

.card{
background:#1c1f24;
padding:20px;
border-radius:12px;
}

img{
width:100%;
height:320px;
object-fit:cover;
border-radius:10px;
}

input,
select{
width:100%;
padding:15px;
margin-top:10px;
margin-bottom:15px;
border:none;
border-radius:6px;
}

label{
color:#f5a300;
font-weight:bold;
}

.btn{
background:#556ba7;
color:white;
border:none;
padding:15px 30px;
border-radius:8px;
cursor:pointer;
margin-top:20px;
}

.btn-kembali{
display:inline-block;
margin-bottom:25px;
padding:12px 20px;
background:#2c3440;
color:white;
text-decoration:none;
border-radius:8px;
font-weight:600;
}

.btn-kembali:hover{
background:#3b4553;
}

</style>
</head>

<body>

<h1>EDIT LAPANGAN</h1>

<a href="lapangan_admin.php" class="btn-kembali">
← KEMBALI
</a>

<form
action="proses_update_lapangan.php"
method="POST"
enctype="multipart/form-data">

<input
type="hidden"
name="id_lapangan"
value="<?php echo $data['id_lapangan']; ?>">

<div class="grid">

<div class="card">

<img
src="uploads/lapangan/<?php echo $data['foto_lapangan']; ?>">

<br><br>

<input
type="file"
name="foto">

</div>

<div>

<label>Nama Lapangan</label>

<input
type="text"
name="nama_lapangan"
value="<?php echo $data['nama_lapangan']; ?>">

<label>Ukuran Lapangan</label>

<input
type="text"
name="ukuran_lapangan"
value="<?php echo $data['ukuran_lapangan']; ?>">

<label>Jenis Lantai</label>

<input
type="text"
name="jenis_lantai"
value="<?php echo $data['jenis_lantai']; ?>">

<label>Tempat</label>

<select name="tempat">

<option
value="Indoor"
<?php if($data['tempat']=="Indoor") echo "selected"; ?>>
Indoor
</option>

<option
value="Outdoor"
<?php if($data['tempat']=="Outdoor") echo "selected"; ?>>
Outdoor
</option>

</select>

<label>Harga Pagi</label>

<input
type="number"
name="harga_pagi"
value="<?php echo $data['harga_pagi']; ?>">

<label>Harga Sore</label>

<input
type="number"
name="harga_sore"
value="<?php echo $data['harga_sore']; ?>">

<label>Harga Malam</label>

<input
type="number"
name="harga_malam"
value="<?php echo $data['harga_malam']; ?>">

<label>Durasi Sesi</label>

<input
type="text"
name="durasi_sesi"
value="<?php echo $data['durasi_sesi']; ?>">

<button
class="btn"
type="submit">
SIMPAN INFORMASI
</button>

</div>

</div>

</form>

</body>
</html>