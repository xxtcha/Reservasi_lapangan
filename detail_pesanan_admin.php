<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_admin']))
{
    header("Location:index.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn,"
SELECT
p.*,
pl.nama_pelanggan,
pl.no_hp,
pl.email,

l.nama_lapangan,
l.jenis_lapangan,

pb.id_pembayaran,
pb.metode_bayar,
pb.bukti_pembayaran,

j.jam_mulai,
j.jam_selesai

FROM pesanan p

JOIN pelanggan pl
ON p.id_pelanggan = pl.id_pelanggan

JOIN lapangan l
ON p.id_lapangan = l.id_lapangan

LEFT JOIN pembayaran pb
ON p.id_pesanan = pb.id_pesanan

LEFT JOIN detail_pesanan dp
ON p.id_pesanan = dp.id_pesanan

LEFT JOIN jadwal j
ON dp.id_jadwal = j.id_jadwal

WHERE p.id_pesanan='$id'
");

$data = mysqli_fetch_assoc($query);

$total = $data['total_biaya'];

if($data['metode_bayar']=="DP")
{
    $dp = $total * 0.5;
    $sisa = $total - $dp;
}
else
{
    $dp = $total;
    $sisa = 0;
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Detail Pesanan</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:#020b11;
font-family:Poppins,sans-serif;
color:white;
}

/* HEADER */

.header{
padding:20px 60px;
background:#1b1f24;
border-bottom:1px solid rgba(255,255,255,.08);
}

.logo{
font-family:Anton;
font-size:34px;
color:#ffbe57;
}

/* CONTENT */

.container{
width:90%;
margin:auto;
padding:35px 0;
}

.back{
text-decoration:none;
color:#ffbe57;
font-size:14px;
}

.title{
font-family:Anton;
font-size:55px;
margin-top:15px;
margin-bottom:30px;
}

.grid{
display:grid;
grid-template-columns: 1.3fr 1fr;
gap:30px;
}

/* CARD */

.card{
background:
linear-gradient(
135deg,
#161d23,
#12181d
);

border-radius:12px;

padding:25px;

border:1px solid
rgba(255,255,255,.05);
}

.card-title{
font-family:Anton;
font-size:22px;
color:#ffbe57;
margin-bottom:25px;
}

/* TABLE */

.info-row{
display:flex;
justify-content:space-between;

padding:15px 0;

border-bottom:
1px solid rgba(255,255,255,.05);
}

.label{
font-size:12px;
color:#8f9aa4;
text-transform:uppercase;
}

.value{
font-size:14px;
font-weight:500;
text-align:right;
}

.highlight{
color:#ffbe57;
font-weight:700;
}

/* COST */

.cost{
font-size:38px;
font-family:Anton;
text-align:right;
}

.dp{
font-size:25px;
color:#6dc4ff;
text-align:right;
font-family:Anton;
}

.sisa{
font-size:40px;
color:#ff7474;
text-align:right;
font-family:Anton;
}

.note{
font-size:11px;
color:#a0a0a0;
text-align:right;
}

/* BUTTON */

.btn{
display:block;
width:100%;
padding:16px;
border-radius:10px;
text-align:center;
text-decoration:none;
font-weight:700;
margin-top:20px;
}

.bukti{
background:#353535;
color:white;
}

.konfirmasi{
background:#f7be63;
color:#222;
}

.tolak{
border:2px solid #ff8b8b;
color:#ff8b8b;
background:transparent;
}

.btn:hover{
opacity:.9;
}

</style>

</head>

<body>

<div class="header">
<div class="logo">
SPORT ACADEMY
</div>
</div>

<div class="container">

<a class="back"
href="pesanan_admin.php">
← KEMBALI
</a>

<div class="title">
TINJAU PESANAN #<?php echo $data['kode_invoice']; ?>
</div>

<div class="grid">

<!-- KIRI -->

<div class="card">

<div class="card-title">
INFORMASI PELANGGAN
</div>

<div class="info-row">
<div class="label">Nama Pemesan</div>
<div class="value">
<?php echo $data['nama_pelanggan']; ?>
</div>
</div>

<div class="info-row">
<div class="label">No. Telepon</div>
<div class="value">
<?php echo $data['no_hp']; ?>
</div>
</div>

<div class="info-row">
<div class="label">E-Mail</div>
<div class="value">
<?php echo $data['email']; ?>
</div>
</div>

<div class="info-row">
<div class="label">Jenis Lapangan</div>
<div class="value highlight">
<?php echo $data['nama_lapangan']; ?>
</div>
</div>

<div class="info-row">
<div class="label">Hari/Tanggal</div>
<div class="value">
<?php echo date('d F Y',
strtotime($data['tanggal'])); ?>
</div>
</div>

<div class="info-row">
<div class="label">Waktu Pakai</div>
<div class="value">
<?php echo $data['jam']; ?>
</div>
</div>

<div class="info-row">
<div class="label">Jam Pemakaian</div>
<div class="value">
<?php echo $data['jam_mulai']; ?>
-
<?php echo $data['jam_selesai']; ?>
</div>
</div>

<div class="info-row">
<div class="label">Pemakaian</div>
<div class="value">
<?php echo $data['tujuan']; ?>
</div>
</div>

</div>

<!-- KANAN -->

<div>

<div class="card">

<div class="card-title">
RINCIAN BIAYA
</div>

<div class="label">
TOTAL BIAYA
</div>

<div class="cost">
Rp <?php echo number_format($total,0,',','.'); ?>
</div>

<br>

<?php
if($data['metode_bayar']=="DP")
{
?>

<div class="label">
DOWN PAYMENT
</div>

<div class="dp">
Rp <?php echo number_format($dp,0,',','.'); ?>
</div>

<?php
}
?>

<a
class="btn bukti"
href="verifikasi_pembayaran.php?id=<?php echo $data['id_pembayaran']; ?>">
LIHAT BUKTI PEMBAYARAN
</a>

<br>

<?php
if($data['metode_bayar']=="DP")
{
?>

<div class="label">
SISA TAGIHAN
</div>

<div class="sisa">
Rp <?php echo number_format($sisa,0,',','.'); ?>
</div>

<div class="note">
*Sisa tagihan dibayar saat bermain
</div>

<?php
}
?>

</div>

<a
class="btn konfirmasi"
href="proses_konfirmasi.php?id=<?php echo $data['id_pesanan']; ?>"
onclick="return confirm('Konfirmasi pesanan ini ?')">
KONFIRMASI PESANAN
</a>

<a
class="btn tolak"
href="proses_tolak.php?id=<?php echo $data['id_pesanan']; ?>"
onclick="return confirm('Tolak pesanan ini ?')">
TOLAK PESANAN
</a>

</div>

</div>

</div>

</body>
</html>