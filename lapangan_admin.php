<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_admin']))
{
    header("Location:index.php");
    exit;
}

$data = mysqli_query($conn,"
SELECT *
FROM lapangan
ORDER BY id_lapangan DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lapangan Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:#040b10;
font-family:Poppins,sans-serif;
color:white;
}

.navbar{
background:#f5a300;
padding:20px;
display:flex;
justify-content:center;
gap:50px;
}

.navbar a{
font-family:Anton;
font-size:25px;
text-decoration:none;
color:#222;
}

.active{
color:white !important;
border-bottom:4px solid white;
}

.title{
font-family:Anton;
font-size:120px;
text-align:center;
margin:30px 0;
}

.container{
width:85%;
margin:auto;
}

.card{

display:grid;
grid-template-columns:
250px
1fr
180px;

gap:25px;

padding:18px;

margin-bottom:25px;

background:
linear-gradient(
135deg,
#1a2025,
#10161c
);

border-radius:16px;

border:1px solid
rgba(255,255,255,.06);
}

.card img{
width:100%;
height:140px;
object-fit:cover;
border-radius:8px;
}

.nama{
font-family:Anton;
font-size:50px;
}

.spesifikasi{
margin-top:10px;
color:#cfcfcf;
line-height:2;
}

.harga{
margin-top:15px;
padding-top:10px;
border-top:1px solid rgba(255,255,255,.08);
}

.harga small{
display:block;
color:#777;
letter-spacing:2px;
}

.nominal{
font-family:Anton;
font-size:35px;
color:#f5a300;
}

.btn{
align-self:center;
background:#f5a300;
padding:15px;
text-align:center;
border-radius:8px;
text-decoration:none;
color:#111;
font-weight:bold;
}

.btn-tambah{
display:inline-block;
padding:15px 25px;
background:#f5a300;
color:#111;
text-decoration:none;
font-weight:bold;
border-radius:8px;
margin-bottom:25px;
}

.btn-hapus{
display:block;
margin-top:10px;
background:#d63031;
padding:12px;
border-radius:8px;
text-align:center;
text-decoration:none;
color:white;
font-weight:bold;
}

.search-box{
margin-bottom:25px;
display:flex;
gap:10px;
}

.search-box input{
flex:1;
padding:15px;
border:none;
border-radius:8px;
font-size:14px;
}

.search-box button{
padding:15px 25px;
border:none;
border-radius:8px;
background:#f5a300;
font-weight:bold;
cursor:pointer;
}

.search-box button:hover{
background:#ffb81f;
}

</style>
</head>

<body>

<div class="navbar">

<a href="dashboard.php">
DASHBOARD
</a>

<a href="pesanan_admin.php">
PESANAN
</a>

<a href="lapangan_admin.php"
class="active">
LAPANGAN
</a>

</div>

<div class="title">
LAPANGAN
</div>

<a href="tambah_lapangan.php" class="btn-tambah">
+ TAMBAH LAPANGAN
</a>

<form method="GET">

<input
type="text"
name="keyword"
placeholder="Cari lapangan...">

<button type="submit">
Cari
</button>

</form>

<a
class="btn-hapus"
href="hapus_lapangan.php?id=<?php echo $row['id_lapangan']; ?>"
onclick="return confirm('Hapus lapangan ini ?')">
HAPUS
</a>

<div class="container">

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<div class="card">

<div>

<img
src="uploads/lapangan/<?php echo $row['foto_lapangan']; ?>">

</div>

<div>

<div class="nama">
<?php echo strtoupper($row['nama_lapangan']); ?>
</div>

<div class="spesifikasi">

• <?php echo $row['jenis_lantai']; ?><br>

• <?php echo $row['ukuran_lapangan']; ?><br>

• <?php echo $row['tempat']; ?>

</div>

<div class="harga">

<small>
HARGA MULAI DARI
</small>

<div class="nominal">

Rp
<?php echo number_format($row['harga_pagi'],0,',','.'); ?>

-

Rp
<?php echo number_format($row['harga_malam'],0,',','.'); ?>

</div>

</div>

</div>

<a
class="btn"
href="edit_lapangan.php?id=<?php echo $row['id_lapangan']; ?>">
EDIT LAPANGAN
</a>

</div>

<?php } ?>

</div>

</body>
</html>