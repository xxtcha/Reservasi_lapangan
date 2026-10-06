<?php
session_start();
include 'koneksi.php';

if(!isset($_GET['id'])){
    die("ID Pesanan tidak ditemukan");
}

$id_pesanan = $_GET['id'];

$query = mysqli_query($conn,"
SELECT
    p.*,
    pl.nama_pelanggan,
    pl.email,
    pl.no_hp,
    pb.metode_bayar,
    pb.status_pembayaran
FROM pesanan p
JOIN pelanggan pl
ON p.id_pelanggan = pl.id_pelanggan
LEFT JOIN pembayaran pb
ON p.id_pesanan = pb.id_pesanan
WHERE p.id_pesanan='$id_pesanan'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data pesanan tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Pesanan Anda</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Poppins',sans-serif;
    background:
    radial-gradient(circle at top left,#1d2935,#0b1016 60%);
    color:white;
    min-height:100vh;
    overflow-x:hidden;
}

/* NAVBAR */

.navbar-custom{
    background:rgba(17,24,31,.7);
    backdrop-filter:blur(15px);
    border-bottom:1px solid rgba(255,255,255,.08);
}

.logo{
    font-family:'Anton',sans-serif;
    color:#ffb23f;
    font-size:32px;
    letter-spacing:2px;
}

.menu a{
    color:white;
    text-decoration:none;
    margin:0 18px;
    font-weight:500;
    transition:.3s;
}

.menu a:hover{
    color:#ffb23f;
}

.menu .active{
    color:#ffb23f;
    border-bottom:2px solid #ffb23f;
    padding-bottom:6px;
}

.btn-login{
    background:linear-gradient(135deg,#ffb100,#ff7a00);
    border:none;
    color:black;
    font-weight:700;
    border-radius:50px;
    padding:12px 28px;
    transition:.3s;
}

.btn-login:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(255,170,0,.3);
}

/* JUDUL */

.judul{
    color:#ffb23f;
    font-family:'Anton',sans-serif;
    font-size:70px;
    letter-spacing:3px;
    margin-bottom:40px;
    text-shadow:0 0 20px rgba(255,166,0,.4);
}

/* CARD */

.card-pesanan{
    background:
    linear-gradient(
    145deg,
    rgba(25,30,38,.95),
    rgba(17,22,29,.95)
    );

    border:1px solid rgba(255,255,255,.08);

    border-radius:25px;

    padding:50px;

    box-shadow:
    0 20px 40px rgba(0,0,0,.45),
    0 0 40px rgba(255,170,0,.06);

    backdrop-filter:blur(10px);

    transition:.4s;
}

.card-pesanan:hover{
    transform:translateY(-4px);
}

/* INVOICE */

.invoice{
    font-family:'Anton',sans-serif;
    font-size:90px;
    color:white;
    line-height:1;
    text-shadow:
    0 0 15px rgba(255,255,255,.1);
}

small.text-secondary{
    font-size:14px;
    letter-spacing:1px;
}

/* SECTION */

.section-title{
    font-family:'Anton',sans-serif;
    font-size:36px;
    color:white;
}

.garis{
    border-bottom:1px solid rgba(255,255,255,.15);
    margin-bottom:30px;
}

.label{
    color:#ffb23f;
    font-size:12px;
    font-weight:700;
    letter-spacing:1px;
}

/* INFO BOX */

.info-box{
    background:
    linear-gradient(
    135deg,
    rgba(36,49,38,.8),
    rgba(30,40,31,.8)
    );

    border:1px solid rgba(122,255,124,.15);

    border-radius:16px;

    padding:25px;

    box-shadow:
    0 0 20px rgba(80,255,120,.08);
}

/* BIAYA */

.biaya-box{
    border:1px solid rgba(255,177,0,.2);
    border-radius:20px;
    overflow:hidden;
}

.biaya-row{
    display:flex;
    justify-content:space-between;
    padding:22px;
    font-size:15px;
}

.biaya-row:nth-child(odd){
    background:rgba(255,255,255,.02);
}

.total-box{
    background:
    linear-gradient(
    90deg,
    #3f3121,
    #4f3a1e
    );
}

.total-text{
    color:#ffb23f;
    font-family:'Anton',sans-serif;
    font-size:45px;
}

/* BUTTONS */

.btn-batal{
    border:1px solid #ff6e6e;
    color:#ff6e6e;
    background:transparent;
    padding:14px 35px;
    border-radius:12px;
    transition:.3s;
}

.btn-batal:hover{
    background:#ff6e6e;
    color:white;
}

.btn-upload{
    background:
    linear-gradient(
    135deg,
    #ffb100,
    #ff8600
    );

    color:black;
    font-weight:700;
    border:none;
    padding:14px 35px;
    border-radius:12px;
    transition:.3s;
}

.btn-upload:hover{
    transform:translateY(-3px);
    box-shadow:
    0 10px 25px rgba(255,165,0,.4);
}

.btn-riwayat{
    position:relative;
    display:inline-flex;
    align-items:center;
    gap:10px;

    padding:15px 30px;

    border-radius:15px;

    background:
    linear-gradient(
        135deg,
        rgba(255,255,255,.08),
        rgba(255,255,255,.03)
    );

    border:1px solid rgba(255,255,255,.15);

    color:#fff;

    font-weight:600;
    letter-spacing:.5px;

    text-decoration:none;

    backdrop-filter:blur(12px);

    overflow:hidden;

    transition:.4s ease;
}

.btn-riwayat i{
    font-size:18px;
    color:#f6b041;
}

.btn-riwayat::before{
    content:'';

    position:absolute;
    top:0;
    left:-120%;

    width:100%;
    height:100%;

    background:
    linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,.3),
        transparent
    );

    transition:.8s;
}

.btn-riwayat:hover::before{
    left:120%;
}

.btn-riwayat:hover{
    transform:translateY(-4px) scale(1.03);

    border-color:#f6b041;

    box-shadow:
    0 10px 30px rgba(246,176,65,.25),
    0 0 25px rgba(246,176,65,.15);

    background:
    linear-gradient(
        135deg,
        rgba(246,176,65,.18),
        rgba(255,140,0,.08)
    );

    color:white;
}

</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom px-5">
    <div class="logo">
        SPORT ACADEMY
    </div>

    <div class="mx-auto menu">
        <a href="home.php">HOME</a>
        <a href="home.php">PEMESANAN</a>
        <a href="#" class="active">PESANAN SAYA</a>
    </div>

</nav>

<div class="container py-5">

    <h1 class="judul mb-5">
        PESANAN ANDA
    </h1>

    <div class="card-pesanan">

        <div class="row">

            <div class="col-lg-7">

                <div class="mb-4">
                    <small class="text-secondary">
                        KODE INVOICE
                    </small>

                    <div class="invoice">
                        <?php echo $data['kode_invoice']; ?>
                    </div>
                </div>

                <div class="section-title">
                    DATA PENYEWA LAPANGAN
                </div>

                <div class="garis"></div>

                <div class="mb-5">

                    <div class="mb-4">
                        <div class="label">
                            NAMA LENGKAP
                        </div>
                        <h5>
                            <?php echo $data['nama_pelanggan']; ?>
                        </h5>
                    </div>

                    <div class="mb-4">
                        <div class="label">
                            NOMOR TELEPON / WA
                        </div>
                        <h5>
                            <?php echo $data['no_hp']; ?>
                        </h5>
                    </div>

                    <div class="mb-4">
                        <div class="label">
                            ALAMAT EMAIL
                        </div>
                        <h5>
                            <?php echo $data['email']; ?>
                        </h5>
                    </div>

                </div>

                <div style="border-left:4px solid #f6b041;padding-left:20px;color:#ccc;">
                    * Pembayaran dapat melalui BANK BRI - 12345678
                </div>

            </div>

            <div class="col-lg-5">

                <div class="info-box mb-4">

                    <strong style="color:#f6b041;">
                        PENTING:
                    </strong>

                    Silahkan upload bukti pembayaran Anda untuk dikonfirmasi oleh admin

                </div>

                <div class="section-title">
                    RINCIAN TOTAL BIAYA
                </div>

                <div class="garis"></div>

                <div class="biaya-box">

                    <div class="biaya-row">
                        <span>Sewa Lapangan</span>
                        <span>
                            Rp <?php echo number_format($data['total_biaya'],0,',','.'); ?>
                        </span>
                    </div>

                    <div class="biaya-row">
                        <span>Metode Pembayaran</span>
                        <span>
                            <?php echo $data['metode_bayar']; ?>
                        </span>
                    </div>

                    <div class="total-box">

                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fw-bold">
                                TOTAL PEMBAYARAN
                            </span>

                            <span class="total-text">
                                Rp <?php echo number_format($data['total_biaya'],0,',','.'); ?>
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="text-end mt-5">

            <a href="batalkan_pesanan.php?id=<?php echo $data['id_pesanan']; ?>"
               class="btn btn-batal">
                BATALKAN PESANAN
            </a>

            <a href="upload_bukti.php?id=<?php echo $data['id_pesanan']; ?>"
               class="btn btn-upload ms-3">
                UPLOAD BUKTI PEMBAYARAN
            </a>

          <a href="riwayat_pesanan.php" class="btn-riwayat ms-3">
    <i class="fas fa-history"></i>
    LIHAT PESANAN SAYA
</a>

        </div>

    </div>

</div>

</body>
</html>