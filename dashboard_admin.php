<?php
session_start();

if(!isset($_SESSION['id_admin'])){
    header("Location: admin/dashboard_admin.php");
exit;
}

// sementara data dummy
$pesanan_hari = 12;
$pesanan_bulan = 248;
$pendapatan_bulan = 42500000;
$pendapatan_tahun = 512200000;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#050b12;
    font-family:'Poppins',sans-serif;
    color:white;
    min-height:100vh;
}

/* Navbar */

.navbar-admin{
    background:#f4a20b;
    padding:25px;
}

.menu-admin{
    display:flex;
    justify-content:center;
    gap:80px;
}

.menu-admin a{
    text-decoration:none;
    color:#2d2200;
    font-family:'Anton',sans-serif;
    font-size:24px;
    letter-spacing:1px;
    transition:.3s;
}

.menu-admin a:hover{
    color:white;
}

.active-menu{
    color:white !important;
    border-bottom:4px solid white;
    padding-bottom:5px;
}

/* Judul */

.judul{
    text-align:center;
    font-family:'Anton',sans-serif;
    font-size:80px;
    letter-spacing:3px;
    margin-top:50px;
    margin-bottom:50px;
}

/* Card */

.card-dashboard{

    background:
    linear-gradient(
    90deg,
    rgba(255,255,255,.03),
    rgba(255,255,255,.06),
    rgba(255,255,255,.03));

    border:1px solid rgba(255,255,255,.08);

    border-radius:25px;

    padding:40px;

    min-height:260px;

    transition:.4s;

    overflow:hidden;

    position:relative;
}

.card-dashboard:hover{

    transform:translateY(-8px);

    box-shadow:
    0 0 30px rgba(244,162,11,.15);
}

.card-dashboard h5{

    color:#d7c0a3;
    font-weight:600;
    margin-bottom:20px;
}

.card-dashboard .angka{

    font-size:80px;
    font-weight:700;
    line-height:1;
}

.card-dashboard p{

    margin-top:25px;
    color:#8f8f8f;
    font-size:15px;
}

/* warna */

.orange{
    color:#ffc36b;
}

.blue{
    color:#7dc7ff;
}

.putih{
    color:#e9ecef;
}

.gold{

    background:
    linear-gradient(
    135deg,
    rgba(244,162,11,.15),
    rgba(255,255,255,.05));

    border:1px solid rgba(244,162,11,.4);
}

.gold .angka{
    color:#a66500;
}

/* logout */

.logout{
    position:absolute;
    right:30px;
    top:25px;
}

.logout a{

    background:#111;

    color:white;

    text-decoration:none;

    padding:10px 20px;

    border-radius:10px;
}

.logout a:hover{
    background:#222;
}

</style>
</head>
<body>

<!-- Navbar -->

<div class="navbar-admin">

    <div class="logout">
        <a href="../logout.php">Logout</a>
    </div>

    <div class="menu-admin">

        <a href="dashboard_admin.php" class="active-menu">
            DASHBOARD
        </a>

        <a href="pesanan_masuk.php">
            PESANAN
        </a>

        <a href="lapangan.php">
            LAPANGAN
        </a>

    </div>

</div>

<div class="container">

    <div class="judul">
        DASHBOARD
    </div>

    <div class="row g-4">

        <div class="col-md-6">

            <div class="card-dashboard">

                <h5>PESANAN HARI INI</h5>

                <div class="angka orange">
                    <?= $pesanan_hari ?>
                </div>

                <p>
                    ⏱ Total pesanan yang masuk hari ini
                </p>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card-dashboard">

                <h5>PESANAN BERHASIL BULAN INI</h5>

                <div class="angka blue">
                    <?= $pesanan_bulan ?>
                </div>

                <p>
                    ⏱ Total pesanan berhasil bulan ini
                </p>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card-dashboard">

                <h5>PENDAPATAN BULAN INI</h5>

                <div class="angka putih">
                    Rp <?= number_format($pendapatan_bulan,0,',','.') ?>
                </div>

                <p>
                    ⏱ Total pendapatan bulan berjalan
                </p>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card-dashboard gold">

                <h5>PENDAPATAN TAHUN INI</h5>

                <div class="angka">
                    Rp <?= number_format($pendapatan_tahun,0,',','.') ?>
                </div>

                <p>
                    ⏱ Total pendapatan tahun berjalan
                </p>

            </div>

        </div>

    </div>

</div>

</body>
</html>