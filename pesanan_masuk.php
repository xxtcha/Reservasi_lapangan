<?php
session_start();

if(!isset($_SESSION['id_admin'])){
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pesanan Masuk</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#020b12;
    font-family:'Poppins',sans-serif;
    color:white;
}

/* NAVBAR */

.navbar{
    background:#f4a20b;
    padding:30px 0;
}

.menu{
    display:flex;
    justify-content:center;
    gap:80px;
}

.menu a{
    text-decoration:none;
    color:#3b2a00;
    font-family:'Anton',sans-serif;
    font-size:24px;
    transition:.3s;
}

.menu a:hover{
    color:white;
}

.active{
    color:white !important;
    border-bottom:4px solid white;
    padding-bottom:5px;
}

/* HEADER */

.banner{

    height:280px;

    background:
    linear-gradient(
    90deg,
    rgba(140,130,70,.8),
    rgba(90,80,40,.8));

    display:flex;
    justify-content:center;
    align-items:center;
}

.banner h1{

    font-family:'Anton',sans-serif;
    font-size:90px;
    letter-spacing:8px;

    text-shadow:
    0 5px 10px rgba(0,0,0,.4);
}

/* TABLE */

.container{
    width:85%;
    margin:auto;
    margin-top:50px;
}

.header-row{

    display:grid;

    grid-template-columns:
    1fr
    1.5fr
    1.5fr
    1fr
    .8fr;

    color:#d8c5a8;

    font-weight:600;

    letter-spacing:2px;

    margin-bottom:25px;

    padding:0 35px;
}

.data-row{

    display:grid;

    grid-template-columns:
    1fr
    1.5fr
    1.5fr
    1fr
    .8fr;

    align-items:center;

    background:
    linear-gradient(
    90deg,
    rgba(255,255,255,.02),
    rgba(255,255,255,.04),
    rgba(255,255,255,.02));

    border:1px solid rgba(255,255,255,.08);

    border-radius:20px;

    padding:35px;

    margin-bottom:18px;

    transition:.3s;
}

.data-row:hover{

    transform:translateY(-4px);

    box-shadow:
    0 0 20px rgba(255,255,255,.08);
}

.kode{
    color:#ffc36b;
    font-weight:700;
}

.nama{
    font-weight:600;
}

.badge{

    display:inline-block;

    padding:8px 18px;

    border-radius:30px;

    font-size:13px;
}

.dp{
    color:#d7a14c;
    border:1px solid rgba(215,161,76,.5);
}

.lunas{
    color:#14aaff;
    border:1px solid rgba(20,170,255,.5);
}

.btn{

    text-decoration:none;

    background:#18c37d;

    color:white;

    text-align:center;

    padding:15px 25px;

    border-radius:10px;

    transition:.3s;
}

.btn:hover{

    background:#11a76a;

    box-shadow:
    0 0 20px rgba(24,195,125,.4);
}

</style>
</head>
<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="menu">

        <a href="dashboard_admin.php">
            DASHBOARD
        </a>

        <a href="pesanan_masuk.php" class="active">
            PESANAN
        </a>

        <a href="lapangan.php">
            LAPANGAN
        </a>

    </div>

</div>

<!-- HEADER -->

<div class="banner">

    <h1>PESANAN MASUK</h1>

</div>

<!-- DATA -->

<div class="container">

    <div class="header-row">

        <div>NO PESANAN</div>
        <div>WAKTU BOOKING</div>
        <div>NAMA PEMESAN</div>
        <div>JENIS PEMBAYARAN</div>
        <div>AKSI</div>

    </div>

    <div class="data-row">

        <div class="kode">NVXXX</div>

        <div>14:00 - 16:00 PM</div>

        <div class="nama">Budi Sudarsono</div>

        <div>
            <span class="badge dp">DP</span>
        </div>

        <div>
            <a href="#" class="btn">TINJAU</a>
        </div>

    </div>

    <div class="data-row">

        <div class="kode">NSXXX</div>

        <div>10:00 - 12:00 AM</div>

        <div class="nama">Ani Wijaya</div>

        <div>
            <span class="badge lunas">LUNAS</span>
        </div>

        <div>
            <a href="#" class="btn">TINJAU</a>
        </div>

    </div>

    <div class="data-row">

        <div class="kode">NCXXX</div>

        <div>18:00 - 20:00 PM</div>

        <div class="nama">Rendra Pratama</div>

        <div>
            <span class="badge dp">DP</span>
        </div>

        <div>
            <a href="#" class="btn">TINJAU</a>
        </div>

    </div>

    <div class="data-row">

        <div class="kode">NBXXX</div>

        <div>08:00 - 10:00 AM</div>

        <div class="nama">Siti Aminah</div>

        <div>
            <span class="badge lunas">LUNAS</span>
        </div>

        <div>
            <a href="#" class="btn">TINJAU</a>
        </div>

    </div>

</div>

</body>
</html>