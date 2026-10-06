<?php
// Pastikan koneksi dan session sudah berjalan
include 'koneksi.php';

// Menangkap data dari URL (dari konfirmasi.php)
$id_lap = isset($_GET['id']) ? $_GET['id'] : '';
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
$jam_string = isset($_GET['jam']) ? $_GET['jam'] : '';
$jam_list = !empty($jam_string) ? explode(',', $jam_string) : [];
$jumlah_jam = count($jam_list);
$tujuan = isset($_GET['tujuan']) ? $_GET['tujuan'] : '-';
// Simulasi harga (bisa diubah sesuai logika database Anda)
$harga_per_jam = 100000;
$total_biaya = $jumlah_jam * $harga_per_jam;
$dp = $total_biaya * 0.5;

// Ambil Nama Lapangan (contoh query)
$nama_lap = "LAPANGAN FUTSAL"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - Sport Academy</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:
    radial-gradient(circle at top left,#1d2530,#0b0f14 55%),
    linear-gradient(135deg,#0f141a,#090c11);
    min-height:100vh;
    font-family:'Poppins',sans-serif;
    color:white;
    overflow-x:hidden;
}

/* SCROLL */

::-webkit-scrollbar{
    width:8px;
}

::-webkit-scrollbar-thumb{
    background:#f39c12;
    border-radius:20px;
}

/* CONTAINER */

.container{
    max-width:1300px;
    margin:auto;
    padding:40px;
}

/* KEMBALI */

.back-link{
    color:#fff;
    text-decoration:none;
    font-size:15px;
    transition:.3s;
}

.back-link:hover{
    color:#f39c12;
    transform:translateX(-5px);
}

/* TITLE */

h1{
    font-family:'Anton',sans-serif;
    font-size:65px;
    color:#fff;
    letter-spacing:3px;
    margin:20px 0 40px;
    text-transform:uppercase;
    position:relative;
}

h1::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-10px;
    width:120px;
    height:5px;
    background:#f39c12;
    border-radius:20px;
}

/* GRID */

.wrapper{
    display:grid;
    grid-template-columns:1.3fr .9fr;
    gap:25px;
}

/* CARD */

.card-custom{
    background:rgba(255,255,255,.04);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    padding:25px;
    transition:.4s;
    overflow:hidden;
    position:relative;
}

.card-custom:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 40px rgba(243,156,18,.15);
}

.card-custom::before{
    content:'';
    position:absolute;
    width:300px;
    height:300px;
    background:rgba(243,156,18,.05);
    border-radius:50%;
    top:-150px;
    right:-150px;
}

/* SUB TITLE */

.section-title{
    font-family:'Anton',sans-serif;
    color:#f39c12;
    font-size:28px;
    letter-spacing:1px;
    margin-bottom:25px;
}

/* DETAIL */

.info-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:25px;
}

.label{
    color:#7f8c8d;
    text-transform:uppercase;
    font-size:13px;
    margin-bottom:5px;
}

.value{
    font-size:18px;
    font-weight:600;
}

/* RINCIAN */

.biaya-item{
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
    padding-bottom:15px;
    border-bottom:1px solid rgba(255,255,255,.08);
}

.total-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:20px;
}

.total-row h2{
    color:#f39c12;
    font-family:'Anton',sans-serif;
    font-size:40px;
    animation:pulse 2s infinite;
}

@keyframes pulse{
    0%{
        transform:scale(1);
    }
    50%{
        transform:scale(1.05);
    }
    100%{
        transform:scale(1);
    }
}

/* PAYMENT */

.payment-option{
    border:1px solid rgba(255,255,255,.12);
    padding:18px;
    border-radius:15px;
    margin-bottom:15px;
    cursor:pointer;
    transition:.3s;
    background:rgba(255,255,255,.02);
}

.payment-option:hover{
    border-color:#f39c12;
    transform:translateX(8px);
}

.payment-option.active{
    border:2px solid #f39c12;
    box-shadow:0 0 20px rgba(243,156,18,.25);
}

.payment-option input{
    margin-right:10px;
}

/* TOTAL BAYAR */

.total-bayar{
    margin-top:25px;
}

.total-bayar small{
    color:#888;
}

.total-bayar h1{
    color:#f39c12;
    font-size:55px;
    margin-top:10px;
}

/* BUTTON */

.btn-bayar{
    width:100%;
    background:linear-gradient(
    90deg,
    #f39c12,
    #ffb22c
    );
    color:black;
    font-family:'Anton',sans-serif;
    border:none;
    padding:18px;
    font-size:22px;
    border-radius:15px;
    margin-top:25px;
    transition:.4s;
    letter-spacing:1px;
}

.btn-bayar:hover{
    transform:translateY(-4px);
    box-shadow:0 10px 30px rgba(243,156,18,.4);
}

.btn-bayar:active{
    transform:scale(.98);
}

/* GLOW EFFECT */

.glow{
    position:fixed;
    width:500px;
    height:500px;
    background:#f39c12;
    filter:blur(250px);
    opacity:.12;
    top:-150px;
    right:-100px;
    pointer-events:none;
}

/* RESPONSIVE */

@media(max-width:992px){

.wrapper{
    grid-template-columns:1fr;
}

h1{
    font-size:45px;
}

.info-grid{
    grid-template-columns:1fr;
}

}

        body { background-color: #121417; color: #fff; font-family: 'Poppins', sans-serif; }
        h1, h2, h3, h5 { font-family: 'Anton', sans-serif; text-transform: uppercase; letter-spacing: 1px; }
        .card-custom { background: #1c1f24; border: 1px solid #333; border-radius: 12px; padding: 25px; margin-bottom: 20px; }
.pilih-pembayaran {
    border: 1px solid #333;
    background: #1c1f24;
    padding: 15px;
    border-radius: 8px;
    cursor: pointer;
    margin-bottom: 15px;
    transition: all 0.3s ease;
    color: #fff;
}

.pilih-pembayaran.active {
    border: 1px solid #f39c12;
    box-shadow: 0 0 10px rgba(243, 156, 18, 0.5);
}
        .btn-lanjut { background: #f39c12; color: #000; font-family: 'Anton', sans-serif; padding: 15px; width: 100%; border: none; font-size: 1.2rem; }
   
   .btn-kembali{
    display:inline-flex;
    align-items:center;
    gap:10px;

    padding:12px 24px;

    background:rgba(255,255,255,.05);
    border:1px solid rgba(243,156,18,.4);

    border-radius:14px;

    color:white;
    text-decoration:none;

    font-weight:600;
    letter-spacing:.5px;

    transition:.3s;
}

.btn-kembali:hover{

    background:#f39c12;
    color:#000;

    transform:translateX(-5px);

    box-shadow:
    0 0 20px rgba(243,156,18,.5);
}

   </style>
</head>
<body>

<div class="container py-5">
   <a href="booking.php?id=<?php echo $id_lap; ?>&tanggal=<?php echo $tanggal; ?>" class="btn-kembali">
    KEMBALI
</a>
    <h1>BUAT PESANAN</h1>

    <div class="row">
        <div class="col-md-7">
            <div class="card-custom">
                <h5><i class="bi bi-file-text"></i> REVIEW</h5>
                <div class="row mt-3">
                    <div class="col-6">
                        <p class="text-secondary mb-0">JENIS LAPANGAN</p>
                        <h6><?php echo $nama_lap; ?></h6>
                    </div>
                    <div class="col-6">
                        <p class="text-secondary mb-0">HARI / TANGGAL</p>
                        <h6><?php echo date('l, d F Y', strtotime($tanggal)); ?></h6>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6 mb-3">
                        <p class="text-secondary mb-0">WAKTU PAKAI</p>
                        <h6><?php echo $jam_string; ?></h6>
                    </div>
                    <div class="col-6 mb-3">
                        <p class="text-secondary mb-0">JAM PEMAKAIAN</p>
                        <h6><?php echo $jumlah_jam; ?> Jam</h6>
                    </div>
                     <div class="col-12 mt-2">
                        <p class="text-secondary mb-0">TUJUAN PEMAKAIAN</p>
                        <h6><?php echo $tujuan; ?></h6>
                    </div>
                </div>
            </div>

            <div class="card-custom">
                <h5><i class="bi bi-wallet"></i> RINCIAN BIAYA</h5>
                <div class="d-flex justify-content-between mt-3">
                    <span>Sewa Lapangan (<?php echo $jumlah_jam; ?> Jam x Rp<?php echo number_format($harga_per_jam,0,',','.'); ?>)</span>
                    <span>Rp<?php echo number_format($total_biaya,0,',','.'); ?></span>
                </div>
                <hr class="border-secondary">
                <div class="d-flex justify-content-between">
                    <h5>TOTAL BIAYA</h5>
                    <h5 class="text-warning">Rp<?php echo number_format($total_biaya,0,',','.'); ?></h5>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card-custom">
    <h5><i class="bi bi-wallet"></i> PILIH PEMBAYARAN</h5>
    
    <div class="pilih-pembayaran" id="box-dp" onclick="updatePayment('dp', <?php echo $dp; ?>)">
        <input type="radio" name="bayar" id="radio-dp" style="display:none;">
        <i class="bi bi-circle-fill" id="icon-dp"></i> BAYAR SETENGAH (DP 50% - Rp<?php echo number_format($dp,0,',','.'); ?>)
    </div>

    <div class="pilih-pembayaran active" id="box-lunas" onclick="updatePayment('lunas', <?php echo $total_biaya; ?>)">
        <input type="radio" name="bayar" id="radio-lunas" style="display:none;" checked>
        <i class="bi bi-circle-fill" id="icon-lunas"></i> PEMBAYARAN PENUH (LUNAS - Rp<?php echo number_format($total_biaya,0,',','.'); ?>)
    </div>

    <p class="text-secondary mt-3">JUMLAH YANG HARUS DIBAYAR</p>
    <h2 class="text-warning" id="total-text">Rp<?php echo number_format($total_biaya,0,',','.'); ?></h2>
</div>

<script>
function updatePayment(type, amount) {
    // 1. Reset visual
    document.getElementById('box-dp').classList.remove('active');
    document.getElementById('box-lunas').classList.remove('active');
    
    // 2. Update Hidden Input agar dikirim ke proses_pembayaran.php
    const inputMetode = document.getElementById('input-metode');
    const inputTotal = document.getElementById('input-total-bayar');
    
    if(type === 'dp') {
        document.getElementById('box-dp').classList.add('active');
        document.getElementById('radio-dp').checked = true;
        inputMetode.value = 'DP'; // Mengirim string 'DP'
        inputTotal.value = amount;
    } else {
        document.getElementById('box-lunas').classList.add('active');
        document.getElementById('radio-lunas').checked = true;
        inputMetode.value = 'Lunas'; // Mengirim string 'Lunas'
        inputTotal.value = amount;
    }

    // 3. Update teks tampilan
    document.getElementById('total-text').innerText = 'Rp' + amount.toLocaleString('id-ID');
}
</script>
                
<form action="proses_pembayaran.php" method="POST">
    <input type="hidden" name="id_lapangan" value="<?php echo $id_lap; ?>">
    <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
    <input type="hidden" name="jam" value="<?php echo htmlspecialchars($jam_string); ?>">
    <input type="hidden" name="tujuan" value="<?php echo htmlspecialchars($tujuan); ?>">
    
    <input type="hidden" name="total_bayar" id="input-total-bayar" value="<?php echo $total_biaya; ?>">
    <input type="hidden" name="metode" id="input-metode" value="Lunas">

    <button type="submit" class="btn btn-lanjut mt-3">LANJUTKAN KE PEMBAYARAN »</button>
</form>
            </div>
        </div>
    </div>
</div>

</body>
</html>