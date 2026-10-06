<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_pelanggan']))
{
    header("Location:index.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$query = mysqli_query($conn,"
SELECT
p.*,
l.nama_lapangan,
pb.metode_bayar

FROM pesanan p

LEFT JOIN lapangan l
ON p.id_lapangan = l.id_lapangan

LEFT JOIN pembayaran pb
ON p.id_pesanan = pb.id_pesanan

WHERE p.id_pelanggan = '$id_pelanggan'

ORDER BY p.id_pesanan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pesanan Saya</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Poppins',sans-serif;
background:
radial-gradient(circle at top,#1d2733,#0b0f14 70%);
color:white;
min-height:100vh;
overflow-x:hidden;
}

nav{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 70px;
background:rgba(0,0,0,.3);
backdrop-filter:blur(10px);
border-bottom:1px solid rgba(255,255,255,.1);
}

.logo{
font-family:'Anton',sans-serif;
font-size:34px;
color:#f39c12;
}

.menu{
display:flex;
gap:35px;
}

.menu a{
text-decoration:none;
color:white;
font-weight:500;
transition:.3s;
}

.menu a:hover{
color:#f39c12;
}

.menu a.active{
color:#f39c12;
border-bottom:3px solid #f39c12;
padding-bottom:8px;
}

.container{
width:88%;
margin:auto;
padding:50px 0;
}

.title{
font-family:'Anton',sans-serif;
font-size:80px;
text-align:center;
letter-spacing:4px;
color:#f39c12;
animation:glow 2s infinite alternate;
}

.line{
width:130px;
height:5px;
background:#f39c12;
margin:15px auto 50px;
border-radius:20px;
}

.statistik{
display:flex;
justify-content:center;
gap:30px;
flex-wrap:wrap;
margin-bottom:50px;
}

.card-stat{
width:240px;
padding:30px;
text-align:center;
background:rgba(255,255,255,.05);
backdrop-filter:blur(15px);
border-radius:25px;
border:1px solid rgba(255,255,255,.08);
transition:.4s;
}

.card-stat:hover{
transform:translateY(-10px);
box-shadow:0 0 30px rgba(243,156,18,.4);
}

.card-stat i{
font-size:40px;
color:#f39c12;
margin-bottom:15px;
}

.card-stat h2{
font-size:42px;
font-weight:700;
}

.card-stat p{
color:#bbb;
}

.table-wrapper{
background:rgba(255,255,255,.05);
backdrop-filter:blur(15px);
border-radius:25px;
overflow:hidden;
border:1px solid rgba(255,255,255,.08);
box-shadow:0 0 40px rgba(0,0,0,.4);
animation:fadeUp .8s ease;
}

table{
width:100%;
border-collapse:collapse;
}

thead{
background:#f39c12;
}

thead th{
padding:25px;
color:black;
font-weight:700;
font-size:16px;
}

tbody td{
padding:25px;
color:#ddd;
}

tbody tr{
transition:.3s;
}

tbody tr:hover{
background:rgba(243,156,18,.08);
}

.action{
display:flex;
gap:15px;
}

.view,
.delete{
width:42px;
height:42px;
display:flex;
align-items:center;
justify-content:center;
border-radius:50%;
font-size:18px;
text-decoration:none;
transition:.3s;
}

.view{
background:rgba(0,191,255,.15);
color:#00cfff;
}

.view:hover{
transform:scale(1.1);
box-shadow:0 0 20px #00cfff;
}

.delete{
background:rgba(255,0,0,.15);
color:#ff8080;
}

.delete:hover{
transform:scale(1.1);
box-shadow:0 0 20px #ff6b6b;
}

.status{
padding:8px 18px;
border-radius:30px;
font-size:13px;
font-weight:600;
}

.lunas{
background:linear-gradient(135deg,#00c16a,#1b8d55);
box-shadow:0 0 15px rgba(0,193,106,.4);
}

.dp{
background:linear-gradient(135deg,#ffb300,#c27a00);
box-shadow:0 0 15px rgba(255,179,0,.4);
}

.footer-table{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 30px;
background:rgba(255,255,255,.03);
}

.footer-table span{
color:#aaa;
}

.footer-table i{
font-size:20px;
margin-left:15px;
cursor:pointer;
}

.empty{
padding:60px;
text-align:center;
color:#aaa;
}

@keyframes glow{

from{
text-shadow:0 0 10px #f39c12;
}

to{
text-shadow:
0 0 20px #f39c12,
0 0 40px #f39c12;
}

}

@keyframes fadeUp{

from{
opacity:0;
transform:translateY(30px);
}

to{
opacity:1;
transform:translateY(0);
}

}

</style>

</head>
<body>

<nav>

<div class="logo">
SPORT ACADEMY
</div>

<div class="menu">
<a href="home.php">Home</a>
<a href="home.php">Pemesanan</a>
<a href="riwayat_pesanan.php" class="active">Pesanan Saya</a>
</div>

</nav>

<div class="container">

<h1 class="title">PESANAN SAYA</h1>

<div class="line"></div>

<div class="table-wrapper">

<table>

<thead>

<tr>
<th>NO PESANAN</th>
<th>JENIS LAPANGAN</th>
<th>TANGGAL PESAN</th>
<th>WAKTU PESAN</th>
<th>AKSI</th>
<th>STATUS</th>
</tr>

</thead>

<tbody>

<?php
if(mysqli_num_rows($query) > 0)
{
while($data=mysqli_fetch_assoc($query))
{
?>

<tr>

<td>
<?= $data['kode_invoice']; ?>
</td>

<td>
<?= $data['nama_lapangan']; ?>
</td>

<td>
<?= date('d / m / Y',strtotime($data['tanggal'])); ?>
</td>

<td>
<?= $data['jam']; ?>
</td>

<td>

<div class="action">

<a
href="pesanan_anda.php?id=<?= $data['id_pesanan']; ?>"
class="view"
title="Lihat Detail">

<i class="fa-solid fa-download"></i>

</a>

<a
href="hapus_pesanan.php?id=<?= $data['id_pesanan']; ?>"
class="delete"
onclick="return confirm('Yakin ingin menghapus pesanan?')">

<i class="fa-regular fa-trash-can"></i>

</a>

</div>

</td>

<td>

<?php
if(strtolower($data['metode_bayar'])=='lunas')
{
echo "<span class='status lunas'>Lunas</span>";
}
else
{
echo "<span class='status dp'>DP</span>";
}
?>

</td>

</tr>

<?php
}
}
else
{
?>

<tr>
<td colspan="6" class="empty">

Belum ada pesanan yang dibuat.

</td>
</tr>

<?php
}
?>

</tbody>

</table>

<div class="footer-table">

<span>
Menampilkan <?= mysqli_num_rows($query); ?>
pesanan
</span>

<div>
<i class="fa-solid fa-angle-left"></i>
<i class="fa-solid fa-angle-right"></i>
</div>

</div>

</div>

</div>

</body>
</html>