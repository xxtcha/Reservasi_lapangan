<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_admin']))
{
    header("Location:index.php");
    exit;
}

$query = mysqli_query($conn,"
SELECT
p.id_pesanan,
p.kode_invoice,
p.jam,
pl.nama_pelanggan,
pb.metode_bayar
FROM pesanan p
JOIN pelanggan pl
ON p.id_pelanggan = pl.id_pelanggan
LEFT JOIN pembayaran pb
ON p.id_pesanan = pb.id_pesanan
ORDER BY p.id_pesanan DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Pesanan Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:
linear-gradient(rgba(0,0,0,.85),rgba(0,0,0,.9)),
url('assets/img/lapangan.png');
background-size:cover;
font-family:Poppins,sans-serif;
color:white;
min-height:100vh;
}

/* NAVBAR */

.navbar{
background:#f39c12;
padding:20px 50px;
display:flex;
justify-content:center;
gap:70px;
}

.navbar a{
font-family:Anton;
font-size:26px;
text-decoration:none;
color:#222;
}

.navbar .active{
color:white;
border-bottom:4px solid white;
padding-bottom:5px;
}

/* TITLE */

.banner{
background:#6d6840;
padding:50px;
text-align:center;
}

.banner h1{
font-family:Anton;
font-size:65px;
letter-spacing:8px;
text-shadow:0 4px 10px rgba(0,0,0,.5);
}

/* TABLE */

.container{
width:90%;
margin:40px auto;
}

.header{
display:grid;
grid-template-columns:
1fr 1.5fr 1.5fr 1fr 1fr;
padding:20px;
font-weight:600;
letter-spacing:2px;
font-size:13px;
color:#d7c5aa;
}

.row{
display:grid;
grid-template-columns:
1fr 1.5fr 1.5fr 1fr 1fr;

align-items:center;

padding:20px 25px;
margin-bottom:18px;

background:
linear-gradient(
90deg,
rgba(28,35,42,.95),
rgba(18,25,30,.95)
);

border-radius:15px;

box-shadow:
0 0 20px rgba(0,0,0,.4);

transition:.3s;
}

.row:hover{
transform:translateY(-4px);
}

.kode{
color:#ffbe57;
font-weight:700;
}

.nama{
font-weight:600;
}

.badge{
display:inline-block;
padding:5px 12px;
border-radius:20px;
font-size:12px;
}

.dp{
background:#4e3820;
color:#ffc15f;
}

.lunas{
background:#0f3145;
color:#58d2ff;
}

.btn{
background:#20d086;
color:white;
padding:10px 25px;
border-radius:8px;
text-decoration:none;
font-size:14px;
font-weight:600;
display:inline-block;
text-align:center;
}

.btn:hover{
background:#18b874;
}

</style>
</head>

<body>

<div class="navbar">

<a href="dashboard.php">
DASHBOARD
</a>

<a href="pesanan_admin.php"
class="active">
PESANAN
</a>

<a href="lapangan_admin.php">
LAPANGAN
</a>

</div>

<div class="banner">
<h1>PESANAN MASUK</h1>
</div>

<div class="container">

<div class="header">

<div>NO PESANAN</div>
<div>WAKTU BOOKING</div>
<div>NAMA PEMESAN</div>
<div>JENIS PEMBAYARAN</div>
<div>AKSI</div>

</div>

<?php while($data=mysqli_fetch_assoc($query)){ ?>

<div class="row">

<div class="kode">
<?php echo $data['kode_invoice']; ?>
</div>

<div>
<?php echo $data['jam']; ?>
</div>

<div class="nama">
<?php echo $data['nama_pelanggan']; ?>
</div>

<div>

<?php
if($data['metode_bayar']=="DP")
{
echo "<span class='badge dp'>DP</span>";
}
else
{
echo "<span class='badge lunas'>LUNAS</span>";
}
?>

</div>

<div>

<a
class="btn"
href="detail_pesanan_admin.php?id=<?php echo $data['id_pesanan']; ?>">
TINJAU
</a>

</div>

</div>

<?php } ?>

</div>

</body>
</html>