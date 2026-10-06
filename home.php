<?php 
session_start();
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Lapangan - Sport Academy</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    color:white;
    min-height:100vh;

    background:
    linear-gradient(rgba(0,0,0,.75),rgba(0,0,0,.75)),
    url('assets/img/lapangan_futsal.jpg');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
}

/* NAVBAR */

nav{
    position:sticky;
    top:0;
    z-index:999;

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:20px 60px;

    background:rgba(0,0,0,.5);
    backdrop-filter:blur(10px);

    border-bottom:1px solid rgba(255,255,255,.1);
}

.logo a{
    text-decoration:none;
    font-family:'Anton',sans-serif;
    color:#f39c12;
    font-size:35px;
    letter-spacing:2px;
}

.nav-links{
    display:flex;
    gap:35px;
}

.nav-links a{
    color:white;
    text-decoration:none;
    transition:.3s;
    position:relative;
}

.nav-links a:hover{
    color:#f39c12;
}

.nav-links a::after{
    content:'';
    position:absolute;
    width:0;
    height:2px;
    background:#f39c12;
    left:0;
    bottom:-5px;
    transition:.3s;
}

.nav-links a:hover::after{
    width:100%;
}

/* TITLE */

h1{
    font-family:'Anton',sans-serif;
    text-align:center;
    letter-spacing:5px;
    font-size:60px;
    color:#fff;
    margin-bottom:60px;
}

h1::after{
    content:'';
    display:block;
    width:120px;
    height:5px;
    background:#f39c12;
    margin:15px auto;
    border-radius:10px;
}

/* CARD */

.card-lapangan{
    background:rgba(28,31,36,.9);
    border:1px solid rgba(255,255,255,.1);

    border-radius:20px;

    padding:30px;

    margin-bottom:35px;

    transition:.4s;

    overflow:hidden;

    animation:fadeUp .8s ease;
}

.card-lapangan:hover{
    transform:translateY(-8px);

    border-color:#f39c12;

    box-shadow:0 15px 40px rgba(0,0,0,.4);
}

/* IMAGE */

.card-lapangan img{
    border-radius:15px;

    width:100%;
    height:220px;

    object-fit:cover;

    transition:.5s;
}

.card-lapangan:hover img{
    transform:scale(1.05);
}

/* TITLE LAPANGAN */

.title-lapangan{
    font-family:'Anton',sans-serif;

    color:#f39c12;

    font-size:40px;

    margin-bottom:20px;
}

/* FASILITAS */

.info-item{
    color:#ddd;

    margin-bottom:12px;

    display:flex;

    align-items:center;
}

.info-item::before{
    content:'✓';

    color:#f39c12;

    font-weight:bold;

    margin-right:10px;
}

/* DIVIDER */

.divider{
    border-top:1px solid rgba(255,255,255,.1);

    margin:25px 0;
}

/* PRICE */

.price-label{
    color:#888;

    font-size:12px;

    text-transform:uppercase;
}

.price-text{
    font-family:'Anton',sans-serif;

    font-size:35px;

    color:#f39c12;
}

/* BUTTON */

.btn-cek{
    width:100%;

    background:#f39c12;

    border:none;

    color:black;

    font-family:'Anton',sans-serif;

    padding:15px;

    border-radius:12px;

    transition:.3s;
}

.btn-cek:hover{
    background:#ffb62e;

    transform:translateY(-3px);

    box-shadow:0 10px 25px rgba(243,156,18,.4);

    color:black;
}

/* ANIMATION */

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(40px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* RESPONSIVE */

@media(max-width:768px){

    nav{
        flex-direction:column;
        gap:20px;
    }

    h1{
        font-size:40px;
    }

    .title-lapangan{
        font-size:28px;
        margin-top:20px;
    }

    .price-text{
        font-size:28px;
    }
}

</style>
</head>
<body>

<nav>
    <div class="logo">
        <a href="index.php" style="color: #f39c12;">SPORT ACADEMY</a>
    </div>
    <div class="nav-links">
        <a href="index.php">Home</a> 
        <a href="home.php" style="color: #f39c12; font-weight:bold;">Pemesanan</a> 
        <a href="riwayat_pesanan.php">Pesanan Saya</a>
    </div>
</nav>

<div class="container py-5">
    <h1>PILIH LAPANGAN</h1>

    <?php
    $query = mysqli_query($conn, "SELECT * FROM lapangan");
    
    if (mysqli_num_rows($query) > 0) {
        while($data = mysqli_fetch_assoc($query)) {
            $img = !empty($data['foto']) ? $data['foto'] : 'default.jpg';
            $fasilitas = explode(',', $data['tujuan_pemakaian']);
    ?>
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-lapangan">
                <div class="row align-items-center">
                    <div class="col-md-4">
                <?php 
    
                $nama = strtolower($data['nama_lapangan']);
                if (strpos($nama, 'futsal') !== false) {
                    $gambar = 'futsal.png';
                } elseif (strpos($nama, 'badminton') !== false) {
                    $gambar = 'badminton.png';
                } elseif (strpos($nama, 'basketball') !== false) {
                    $gambar = 'baskteball.png';
            
            }
    ?>
    <img src="assets/img/<?php echo $gambar; ?>" class="img-fluid rounded" style="width:100%; height:200px; object-fit:cover;">
</div>
                    
                    <div class="col-md-8 ps-md-4">
                        <div class="title-lapangan"><?php echo htmlspecialchars($data['nama_lapangan']); ?></div>
                        
                        <?php foreach($fasilitas as $item): ?>
                            <div class="info-item"><?php echo trim($item); ?></div>
                        <?php endforeach; ?>
                        
                        <div class="divider"></div>
                        
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="price-label">Harga Mulai Dari</div>
                                <div class="price-text">RP <?php echo number_format($data['harga_per_jam'], 0, ',', '.'); ?> / SESI</div>
                            </div>
                            <div class="col-md-5">
                                <a href="booking.php?id=<?php echo $data['id_lapangan']; ?>" class="btn btn-cek">CEK KETERSEDIAAN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        } 
    } else {
        echo "<div class='text-center mt-5 text-muted'><h3>Belum ada lapangan yang tersedia saat ini.</h3></div>";
    }
    ?>
</div>

</body>
</html>