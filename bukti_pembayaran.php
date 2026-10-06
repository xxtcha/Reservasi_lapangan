<?php
session_start();
include 'koneksi.php';

if(!isset($_GET['id'])){
    die("ID pesanan tidak ditemukan");
}

$id = $_GET['id'];

$query = mysqli_query($conn,"
SELECT
    p.*,
    pb.metode_bayar,
    pb.bukti_pembayaran,
    pb.status_pembayaran
FROM pesanan p
LEFT JOIN pembayaran pb
ON p.id_pesanan = pb.id_pesanan
WHERE p.id_pesanan='$id'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data tidak ditemukan");
}

$total_biaya = $data['total_biaya'];
$total_bayar = $data['total_bayar'];
$sisa = $total_biaya - $total_bayar;

if($sisa < 0){
    $sisa = 0;
}

$metode = strtolower($data['metode_bayar']);

$bukti = !empty($data['bukti_pembayaran'])
    ? "uploads/".$data['bukti_pembayaran']
    : "assets/img/no-image.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Bukti Pembayaran</title>

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
    radial-gradient(circle at top left,#1b2735,#0b1012 60%);
    color:#fff;
    font-family:'Poppins',sans-serif;
    overflow-x:hidden;
}

/* ================= NAVBAR ================= */

.navbar{
    background:rgba(20,20,20,.92);
    backdrop-filter:blur(12px);
    padding:25px 90px;
    border-bottom:2px solid #f6a21a;
    position:sticky;
    top:0;
    z-index:999;
}

.logo{
    font-family:'Anton',sans-serif;
    color:#f6a21a;
    font-size:38px;
    letter-spacing:2px;
    animation:fadeDown .8s ease;
}

/* ================= CONTAINER ================= */

.container{
    width:88%;
    max-width:1300px;
    margin:45px auto;
    animation:fadeUp .8s ease;
}

/* ================= BUTTON KEMBALI ================= */

.kembali{
    display:inline-flex;
    align-items:center;
    gap:8px;
    text-decoration:none;
    color:#f6b35b;
    padding:12px 24px;
    border:2px solid #f6a21a;
    border-radius:50px;
    font-weight:600;
    transition:.35s;
    margin-bottom:25px;
}

.kembali:hover{
    background:#f6a21a;
    color:#1b1b1b;
    transform:translateX(-5px);
    box-shadow:0 10px 20px rgba(246,162,26,.25);
}

/* ================= TITLE ================= */

.title{
    font-family:'Anton',sans-serif;
    font-size:60px;
    letter-spacing:2px;
    margin-bottom:45px;
    color:#fff;
    animation:fadeLeft .8s ease;
}

.title span{
    color:#f6a21a;
}

/* ================= WRAPPER ================= */

.wrapper{
    width:620px;
    max-width:100%;
    margin:auto;
}

/* ================= SUB TITLE ================= */

.sub-title{
    font-family:'Anton',sans-serif;
    font-size:36px;
    color:#fff;
    margin-bottom:18px;
    letter-spacing:1px;
}

.sub-title.dp{
    color:#f6b35b;
}

/* ================= CARD ================= */

.card{

    position:relative;

    overflow:hidden;

    background:
    linear-gradient(
        145deg,
        rgba(255,255,255,.05),
        rgba(255,255,255,.02));

    border:1px solid rgba(255,255,255,.08);

    border-radius:22px;

    padding:35px;

    backdrop-filter:blur(18px);

    transition:.35s;

    animation:fadeUp .8s ease;

}

.card::before{

    content:"";

    position:absolute;

    top:0;

    left:0;

    width:100%;

    height:4px;

    background:linear-gradient(90deg,#ffcf73,#f6a21a,#ffcf73);

}

.card:hover{

    transform:translateY(-8px);

    border-color:#f6a21a;

    box-shadow:

    0 18px 35px rgba(0,0,0,.45),

    0 0 25px rgba(246,162,26,.18);

}

/* ================= CARD TITLE ================= */

.card-title{

    text-align:center;

    font-family:'Anton';

    font-size:26px;

    letter-spacing:4px;

    color:#ffd58d;

    padding-bottom:20px;

    border-bottom:1px solid rgba(255,255,255,.08);

    margin-bottom:25px;

}

/* ================= ROW ================= */

.row{

    display:flex;

    justify-content:space-between;

    align-items:center;

    background:rgba(255,255,255,.03);

    border:1px solid rgba(255,255,255,.06);

    padding:18px 22px;

    border-radius:12px;

    margin-bottom:15px;

    transition:.3s;

}

.row:hover{

    transform:translateX(5px);

    border-color:#f6a21a;

    background:rgba(246,162,26,.08);

}

.row.dp-row{

    background:rgba(120,20,20,.25);

    border-color:rgba(255,120,120,.2);

}

/* ================= LABEL ================= */

.label{

    color:#cfcfcf;

    font-size:13px;

    font-weight:600;

    text-transform:uppercase;

    letter-spacing:.5px;

}

/* ================= VALUE ================= */

.value{

    color:#f6c98a;

    font-size:19px;

    font-weight:600;

}

.nominal{

    color:#fff;

    font-size:24px;

    font-weight:bold;

}

/* ================= NOTE ================= */

.note{

    text-align:center;

    margin:20px 0;

    color:#9f9f9f;

    font-size:13px;

}

/* ================= IMAGE ================= */

.bukti-img{

    width:100%;

    height:600px;

    object-fit:cover;

    border-radius:16px;

    border:2px solid rgba(255,255,255,.08);

    transition:.35s;

}

.bukti-img:hover{

    transform:scale(1.02);

    border-color:#f6a21a;

    box-shadow:

    0 0 25px rgba(246,162,26,.25);

}

/* ================= SISA ================= */

.sisa{

    margin-top:28px;

    background:

    linear-gradient(
    135deg,
    #c31432,
    #8e0000);

    padding:24px;

    border-radius:16px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:

    0 12px 30px rgba(195,20,50,.25);

}

.sisa strong{

    font-family:'Anton';

    font-size:34px;

    letter-spacing:1px;

}

/* ================= BUTTON ================= */

.actions{

    display:flex;

    justify-content:center;

    gap:18px;

    margin-top:35px;

}

.btn{

    padding:16px 38px;

    border-radius:12px;

    font-size:15px;

    font-weight:700;

    cursor:pointer;

    transition:.35s;

    text-transform:uppercase;

}

.btn-konfirmasi{

    background:linear-gradient(
    135deg,
    #ffc24c,
    #f6a21a);

    color:#2b1b00;

    border:none;

}

.btn-konfirmasi:hover{

    transform:translateY(-4px);

    box-shadow:

    0 15px 30px rgba(246,162,26,.35);

}

.btn-tolak{

    background:transparent;

    border:2px solid #ff6d6d;

    color:#ffb3b3;

}

.btn-tolak:hover{

    background:#d62828;

    color:white;

    border-color:#d62828;

    transform:translateY(-4px);

}

/* ================= SCROLLBAR ================= */

::-webkit-scrollbar{

    width:9px;

}

::-webkit-scrollbar-track{

    background:#111;

}

::-webkit-scrollbar-thumb{

    background:#f6a21a;

    border-radius:30px;

}

::-webkit-scrollbar-thumb:hover{

    background:#ffbf47;

}

/* ================= ANIMATION ================= */

@keyframes fadeUp{

    from{

        opacity:0;

        transform:translateY(35px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}

@keyframes fadeDown{

    from{

        opacity:0;

        transform:translateY(-30px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}

@keyframes fadeLeft{

    from{

        opacity:0;

        transform:translateX(-40px);

    }

    to{

        opacity:1;

        transform:translateX(0);

    }

}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    .navbar{

        padding:20px;

        text-align:center;

    }

    .logo{

        font-size:30px;

    }

    .title{

        font-size:42px;

    }

    .wrapper{

        width:100%;

    }

    .row{

        flex-direction:column;

        align-items:flex-start;

        gap:8px;

    }

    .bukti-img{

        height:350px;

    }

    .actions{

        flex-direction:column;

    }

    .btn{

        width:100%;

    }

}
</style>
</head>

<body>

<div class="navbar">
    <div class="logo">SPORT ACADEMY</div>
</div>

<div class="container">

    <a href="tinjau_pesanan.php?id=<?= $data['id_pesanan']; ?>" class="kembali">
        ← KEMBALI
    </a>

    <h1 class="title">BUKTI PEMBAYARAN</h1>

    <div class="wrapper">

        <?php if($metode == 'lunas'): ?>



            <div class="card">
                <div class="card-title">BUKTI PEMBAYARAN</div>

                <div class="row">
                    <span class="label">JENIS PEMBAYARAN</span>
                    <span class="value">LANGSUNG LUNAS</span>
                </div>

                <div class="row">
                    <span class="label">NOMINAL TRANSFER</span>
                    <span class="nominal">
                        <div class="text-warning" id="total-text">Rp<?php echo number_format($total_biaya,0,',','.'); ?></div>
                    </span>
                </div>

                <div class="note">
                    *pastikan nominal transfer sesuai dengan bukti pembayaran
                </div>

                <img src="<?= $bukti; ?>" class="bukti-img">
            </div>

        <?php elseif($metode == 'dp'): ?>

            

            <div class="card">
                <div class="card-title">BUKTI PEMBAYARAN</div>

                <div class="row dp-row">
                    <span class="label">JENIS PEMBAYARAN</span>
                    <span class="value">DP - DOWN PAYMENT</span>
                </div>

                <div class="row dp-row">
                    <span class="label">NOMINAL TRANSFER</span>
                    <span class="nominal">
                        <div class="text-warning" id="total-text">Rp<?php echo number_format($total_biaya,0,',','.'); ?></div>
                    </span>
                </div>

                <div class="note">
                    *pastikan nominal transfer sesuai dengan bukti pembayaran
                </div>

                <img src="<?= $bukti; ?>" class="bukti-img">

                <div class="sisa">
                    <span>SISA PEMBAYARAN</span>
                    <strong>RP <?= number_format($sisa,0,',','.'); ?></strong>
                </div>
            </div>

        <?php else: ?>

            <div class="card">
                <div class="card-title">BUKTI PEMBAYARAN</div>
                <p style="text-align:center;color:#aaa;">
                    Metode pembayaran belum tersedia.
                </p>
            </div>

        <?php endif; ?>

        

    </div>

</div>

</body>
</html>