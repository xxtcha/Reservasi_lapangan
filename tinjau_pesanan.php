<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id_admin'])){
    header("Location: index.php");
    exit;
}

if(!isset($_GET['id'])){
    die("ID pesanan tidak ditemukan");
}

$id = $_GET['id'];

$query = mysqli_query($conn,"
SELECT
    p.*,
    pl.nama_pelanggan,
    pl.email,
    pl.no_hp,
    l.nama_lapangan,
    pb.metode_bayar,
    pb.bukti_pembayaran,
    pb.status_pembayaran
FROM pesanan p

LEFT JOIN pelanggan pl
ON p.id_pelanggan = pl.id_pelanggan

LEFT JOIN lapangan l
ON p.id_lapangan = l.id_lapangan

LEFT JOIN pembayaran pb
ON p.id_pesanan = pb.id_pesanan

WHERE p.id_pesanan = '$id'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Pesanan tidak ditemukan");
}

$total_biaya = (int)$data['total_biaya'];
$metode = strtolower($data['metode_bayar']);

if($metode == 'lunas'){
    $jumlah_bayar = $total_biaya;
    $sisa = 0;
}
elseif($metode == 'dp'){
    $jumlah_bayar = $total_biaya * 0.5;
    $sisa = $total_biaya - $jumlah_bayar;
}
else{
    $jumlah_bayar = 0;
    $sisa = $total_biaya;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tinjau Pesanan</title>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{

    background:
    radial-gradient(circle at top left,#1b2b39,#071019 45%,#030b12 100%);

    color:#fff;

    font-family:'Poppins',sans-serif;

    overflow-x:hidden;

    position:relative;

}

/* ==============================
BACKGROUND EFFECT
==============================*/

body::before{

    content:"";

    position:fixed;

    width:700px;
    height:700px;

    background:
    radial-gradient(circle,
    rgba(244,162,11,.10),
    transparent 70%);

    top:-200px;
    left:-150px;

    animation:lightMove 15s linear infinite;

    pointer-events:none;

}

body::after{

    content:"";

    position:fixed;

    width:550px;
    height:550px;

    background:
    radial-gradient(circle,
    rgba(0,170,255,.08),
    transparent 70%);

    bottom:-180px;
    right:-120px;

    animation:lightMove2 18s linear infinite;

    pointer-events:none;

}

@keyframes lightMove{

0%{

transform:translate(0,0);

}

50%{

transform:translate(180px,120px);

}

100%{

transform:translate(0,0);

}

}

@keyframes lightMove2{

0%{

transform:translate(0,0);

}

50%{

transform:translate(-150px,-80px);

}

100%{

transform:translate(0,0);

}

}

/* ==============================
CONTAINER
==============================*/

.container{

    width:1200px;

    margin:auto;

    padding:35px 0 80px;

    animation:fadePage .8s ease;

}

@keyframes fadePage{

from{

opacity:0;

transform:translateY(40px);

}

to{

opacity:1;

transform:translateY(0);

}

}

/* ==============================
LOGO
==============================*/

.logo{

    font-family:'Anton';

    font-size:68px;

    color:#ffb74d;

    letter-spacing:2px;

    animation:logoZoom 1s ease;

}

@keyframes logoZoom{

0%{

opacity:0;

transform:scale(.8);

}

100%{

opacity:1;

transform:scale(1);

}

}

/* ==============================
LINE
==============================*/

.line{

    height:1px;

    background:

    linear-gradient(

    to right,

    rgba(255,187,85,.7),

    rgba(255,255,255,.05)

    );

    margin:18px 0 25px;

}

/* ==============================
BUTTON KEMBALI
==============================*/

.btn-kembali{

    display:inline-flex;

    align-items:center;

    gap:12px;

    padding:12px 26px;

    border-radius:40px;

    border:2px solid #ffb74d;

    text-decoration:none;

    color:#ffb74d;

    transition:.35s;

    font-weight:600;

    position:relative;

    overflow:hidden;

}

.btn-kembali:hover{

    background:#ffb74d;

    color:#2b1b00;

    transform:translateX(-6px);

    box-shadow:

    0 10px 25px rgba(255,183,77,.35);

}

.btn-kembali span{

    transition:.35s;

}

.btn-kembali:hover span{

    transform:translateX(-6px);

}

.btn-kembali::before{

content:"";

position:absolute;

top:0;

left:-100%;

width:100%;

height:100%;

background:

linear-gradient(

90deg,

transparent,

rgba(255,255,255,.45),

transparent);

transition:.6s;

}

.btn-kembali:hover::before{

left:100%;

}

/* ==============================
TITLE
==============================*/

.judul{

    margin:35px 0;

    font-family:'Anton';

    font-size:60px;

    animation:slideTitle .9s ease;

}

.judul span{

    color:#ffb74d;

}

@keyframes slideTitle{

from{

opacity:0;

transform:translateX(-80px);

}

to{

opacity:1;

transform:translateX(0);

}

}

/* ==============================
ROW
==============================*/

.row{

display:flex;

gap:35px;

align-items:flex-start;

}

.kiri{

width:65%;

}

.kanan{

width:35%;

}

/* ==============================
CARD
==============================*/

.card{

    position:relative;

    overflow:hidden;

    background:
    linear-gradient(
        145deg,
        rgba(255,255,255,.05),
        rgba(255,255,255,.03));

    border:1px solid rgba(255,255,255,.08);

    border-radius:22px;

    padding:35px;

    backdrop-filter:blur(18px);

    transition:.35s;

    animation:fadeCard .8s ease;

}

/* Garis emas mengikuti header */

.card::before{

    content:"";

    position:absolute;

    top:0;

    left:0;

    width:100%;

    height:4px;

    background:

    linear-gradient(
        90deg,
        #ffb84d,
        #f4a20b,
        #ffcf73
    );

}

/* Sedikit cahaya di pojok kiri atas */

.card::after{

    content:"";

    position:absolute;

    width:280px;

    height:280px;

    background:

    radial-gradient(circle,
    rgba(244,162,11,.18),
    transparent 70%);

    top:-160px;

    left:-120px;

    pointer-events:none;

}

.card:hover{

    transform:translateY(-8px);

    border-color:rgba(244,162,11,.45);

    box-shadow:

    0 20px 40px rgba(0,0,0,.45),

    0 0 30px rgba(244,162,11,.15),

    inset 0 1px 0 rgba(255,255,255,.05);

}

.row{

    display:flex;

    gap:35px;

    align-items:flex-start;

    position:relative;

    padding-top:18px;

}

.row::before{

    content:"";

    position:absolute;

    top:0;

    left:0;

    width:100%;

    height:2px;

    background:

    linear-gradient(
        90deg,
        #ffb84d,
        rgba(255,184,77,.4),
        transparent
    );

}

@keyframes fadeCard{

from{

opacity:0;

transform:translateY(35px);

}

to{

opacity:1;

transform:translateY(0);

}

}

/* ==============================
CARD TITLE
==============================*/

.card-title{

font-family:'Anton';

font-size:30px;

color:#ffb74d;

margin-bottom:20px;

}

/* ==============================
INFO
==============================*/

.info{

display:flex;

justify-content:space-between;

align-items:center;

padding:18px 0;

border-bottom:1px solid rgba(255,255,255,.08);

transition:.3s;

}

.info:hover{

padding-left:8px;

background:rgba(255,255,255,.03);

}

.label{

color:#cfcfcf;

font-size:14px;

}

.value{

font-size:22px;

font-weight:600;

text-align:right;

}

.orange{

color:#ffb74d;

}

.blue{

color:#59c5ff;

}

.red{

color:#ff8f8f;

}

/* ==============================
BUTTON BUKTI
==============================*/

.btn-bukti{

display:block;

text-align:center;

padding:16px;

margin:22px 0;

border-radius:12px;

text-decoration:none;

border:2px solid rgba(255,255,255,.18);

color:#fff;

transition:.35s;

}

.btn-bukti:hover{

background:#2196f3;

border-color:#2196f3;

transform:translateY(-3px);

}

/* ==============================
BUTTON
==============================*/

.btn-konfirmasi,
.btn-tolak{

width:100%;

padding:18px;

border-radius:14px;

font-family:'Anton';

font-size:27px;

cursor:pointer;

transition:.35s;

margin-top:18px;

}

.btn-konfirmasi{

background:

linear-gradient(135deg,#ffca73,#f4a20b);

border:none;

color:#2b1b00;

}

.btn-konfirmasi:hover{

transform:translateY(-4px);

box-shadow:

0 12px 25px rgba(244,162,11,.35);

}

.btn-tolak{

background:none;

border:2px solid #ff6b6b;

color:#ff8b8b;

}

.btn-tolak:hover{

background:#ff4d4d;

color:white;

transform:translateY(-4px);

}

/* ==============================
SCROLLBAR
==============================*/

::-webkit-scrollbar{

width:8px;

}

::-webkit-scrollbar-track{

background:#061018;

}

::-webkit-scrollbar-thumb{

background:#ffb74d;

border-radius:20px;

}

/* ==============================
RESPONSIVE
==============================*/

@media(max-width:1200px){

.container{

width:95%;

}

}

@media(max-width:900px){

.row{

flex-direction:column;

}

.kiri,
.kanan{

width:100%;

}

.logo{

font-size:48px;

}

.judul{

font-size:42px;

}

.value{

font-size:18px;

}

}
</style>
</head>

<body>

<div class="container">

    <div class="logo">
        SPORT ACADEMY
    </div>

    <div class="line"></div>

    <a href="pesanan_masuk.php" class="btn-kembali">
    <span>←</span> Kembali
</a>

    <div class="judul">
        TINJAU PESANAN
        <span>#<?= $data['kode_invoice']; ?></span>
    </div>

    <div class="row">

        <div class="kiri">

            <div class="card">

                <div class="card-title">
                    👤 INFORMASI USER
                </div>

                <div class="info">
                    <div class="label">NAMA PEMESAN</div>
                    <div class="value"><?= $data['nama_pelanggan']; ?></div>
                </div>

                <div class="info">
                    <div class="label">NO TELEPON</div>
                    <div class="value"><?= $data['no_hp']; ?></div>
                </div>

                <div class="info">
                    <div class="label">EMAIL</div>
                    <div class="value"><?= $data['email']; ?></div>
                </div>

                <div class="info">
                    <div class="label">JENIS LAPANGAN</div>
                    <div class="value orange"><?= $data['nama_lapangan']; ?></div>
                </div>

                <div class="info">
                    <div class="label">HARI / TANGGAL</div>
                    <div class="value">
                        <?= date('d/m/Y', strtotime($data['tanggal'])); ?>
                    </div>
                </div>

                <div class="info">
                    <div class="label">JAM PEMAKAIAN</div>
                    <div class="value"><?= $data['jam']; ?></div>
                </div>

                <div class="info">
                    <div class="label">TUJUAN</div>
                    <div class="value"><?= $data['tujuan']; ?></div>
                </div>

                <div class="info" style="border:none;">
                    <div class="label">STATUS PESANAN</div>
                    <div class="value"><?= $data['status_pesanan']; ?></div>
                </div>

            </div>

        </div>

        <div class="kanan">

            <div class="card">

                <div class="card-title">
                    💳 RINCIAN BIAYA
                </div>

                <div class="info">
                    <div class="label">TOTAL BIAYA</div>
                    <div class="value">
                        Rp <?= number_format($total_biaya,0,',','.'); ?>
                    </div>
                </div>

                <div class="info">
                    <div class="label">METODE BAYAR</div>
                    <div class="value blue">
                        <?= $data['metode_bayar']; ?>
                    </div>
                </div>

                <div class="info">
                    <div class="label">JUMLAH DIBAYAR</div>
                    <div class="value blue">
   
                    <div class="text-warning" id="total-text">Rp<?php echo number_format($jumlah_bayar,0,',','.'); ?></div>
                    </div>
                </div>

                <?php if(!empty($data['bukti_pembayaran'])): ?>

                    <a href="bukti_pembayaran.php?id=<?= $data['id_pesanan']; ?>" class="btn-bukti">
    👁 LIHAT BUKTI PEMBAYARAN
</a>

                <?php else: ?>

                    <div class="btn-bukti">
                        Belum ada bukti pembayaran
                    </div>

                <?php endif; ?>

                <div class="info" style="border:none;">
                    <div class="label">SISA TAGIHAN</div>
                    <div class="value red">
                      <?php
if($metode == 'lunas'){
    echo "-";
}else{
    echo "Rp " . number_format($sisa,0,',','.');
}
?>
                    </div>
                </div>

            </div>

           <form action="proses_konfirmasi.php" method="POST">
    <input type="hidden" name="id" value="<?= $data['id_pesanan']; ?>">
    <button type="submit" class="btn-konfirmasi">
        KONFIRMASI PESANAN
    </button>
</form>

<form action="proses_tolak.php" method="POST">
    <input type="hidden" name="id" value="<?= $data['id_pesanan']; ?>">
    <button type="submit" class="btn-tolak">
        TOLAK PESANAN
    </button>
</form>

        </div>

    </div>

</div>

</body>
</html>