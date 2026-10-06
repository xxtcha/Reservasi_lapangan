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
pb.*,
p.total_biaya,
p.id_pesanan,
p.kode_invoice

FROM pembayaran pb

JOIN pesanan p
ON pb.id_pesanan = p.id_pesanan

WHERE pb.id_pembayaran='$id'
");

$data = mysqli_fetch_assoc($query);

$total = $data['total_biaya'];

if($data['metode_bayar']=="DP")
{
    $dibayar = $total * 0.5;
    $sisa = $total - $dibayar;
}
else
{
    $dibayar = $total;
    $sisa = 0;
}
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Verifikasi Pembayaran</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:#030c11;
font-family:Poppins,sans-serif;
color:white;
min-height:100vh;
}

/* HEADER */

.header{
background:#1d2024;
padding:20px 70px;
border-bottom:1px solid rgba(255,255,255,.05);
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
padding:30px 0;
}

.back{
color:#ffbe57;
text-decoration:none;
font-size:14px;
}

.title{
font-family:Anton;
font-size:48px;
margin-top:10px;
margin-bottom:30px;
}

/* GRID */

.grid{
display:grid;
grid-template-columns:1fr 1fr;
gap:25px;
}

/* CARD */

.card{
background:
linear-gradient(
135deg,
#171d22,
#11171c
);

padding:20px;
border-radius:12px;

border:1px solid
rgba(255,255,255,.05);
}

.card h2{
font-family:Anton;
font-size:28px;
margin-bottom:15px;
}

.lunas-title{
color:#e5e5e5;
}

.dp-title{
color:#ffbe57;
}

/* BOX */

.box{
background:#232d2d;
padding:12px 15px;
border-radius:8px;
margin-bottom:10px;

display:flex;
justify-content:space-between;
}

.box.dp{
background:#341d23;
border:1px solid #5f2834;
}

.label{
font-size:12px;
text-transform:uppercase;
color:#cfcfcf;
}

.value{
font-size:15px;
font-weight:600;
}

/* NOTE */

.note{
font-size:11px;
color:#888;
text-align:center;
margin:12px 0;
}

/* IMAGE */

.preview{
margin-top:15px;
height:520px;
border:1px dashed rgba(255,255,255,.08);
overflow:hidden;
}

.preview img{
width:100%;
height:100%;
object-fit:cover;
}

/* SISA */

.sisa{
margin-top:20px;
background:#b60008;
padding:15px 20px;
border-radius:8px;

display:flex;
justify-content:space-between;
align-items:center;
}

.sisa span{
font-family:Anton;
font-size:32px;
}

/* BUTTON */

.action{
display:flex;
justify-content:flex-end;
gap:15px;
margin-top:30px;
}

.btn{
padding:15px 30px;
border-radius:8px;
text-decoration:none;
font-weight:600;
}

.tolak{
border:1px solid #b9a48a;
color:#b9a48a;
}

.konfirmasi{
background:#ffb600;
color:#222;
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

<a
class="back"
href="detail_pesanan_admin.php?id=<?php echo $data['id_pesanan']; ?>">
← KEMBALI
</a>

<div class="title">
BUKTI PEMBAYARAN
</div>

<div class="grid">

<!-- LUNAS -->

<?php
if($data['metode_bayar']=="Lunas")
{
?>

<div class="card">

<h2 class="lunas-title">
LUNAS
</h2>

<div class="box">

<div class="label">
Jenis Pembayaran
</div>

<div class="value">
LANGSUNG LUNAS
</div>

</div>

<div class="box">

<div class="label">
Nominal Transfer
</div>

<div class="value">
Rp <?php echo number_format($total,0,',','.'); ?>
</div>

</div>

<div class="note">
*Pastikan nominal transfer sesuai bukti pembayaran
</div>

<div class="preview">

<img src="<?php echo $data['bukti_pembayaran']; ?>">

</div>

</div>

<?php
}
?>

<!-- DP -->

<?php
if($data['metode_bayar']=="DP")
{
?>

<div class="card">

<h2 class="dp-title">
DP
</h2>

<div class="box dp">

<div class="label">
Jenis Pembayaran
</div>

<div class="value">
DP - DOWN PAYMENT
</div>

</div>

<div class="box dp">

<div class="label">
Nominal Transfer
</div>

<div class="value">
Rp <?php echo number_format($dibayar,0,',','.'); ?>
</div>

</div>

<div class="note">
*Pastikan nominal transfer sesuai bukti pembayaran
</div>

<div class="preview">

<img src="uploads/bukti/<?php echo $data['bukti_pembayaran']; ?>">

</div>

<div class="sisa">

<div>
SISA PEMBAYARAN
</div>

<span>
Rp <?php echo number_format($sisa,0,',','.'); ?>
</span>

</div>

</div>

<?php
}
?>

</div>

<div class="action">

<a
class="btn tolak"
href="proses_tolak_bukti.php?id=<?php echo $data['id_pembayaran']; ?>"
onclick="return confirm('Tolak bukti pembayaran ini ?')">
TOLAK BUKTI
</a>

<a
class="btn konfirmasi"
href="proses_konfirmasi_bukti.php?id=<?php echo $data['id_pembayaran']; ?>"
onclick="return confirm('Konfirmasi bukti pembayaran ini ?')">
KONFIRMASI PESANAN
</a>

</div>

</div>

</body>
</html>