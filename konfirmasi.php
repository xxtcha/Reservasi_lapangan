<?php
include 'koneksi.php';

// Debug: Cek apa yang dikirim
$id_lap = isset($_GET['id']) ? $_GET['id'] : 'TIDAK ADA ID';
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : 'TIDAK ADA TANGGAL';
$jam_string = isset($_GET['jam']) ? $_GET['jam'] : '';
$tujuan = isset($_GET['tujuan']) ? $_GET['tujuan'] : '-';
// Jika Anda melihat tulisan 'TIDAK ADA' di halaman, berarti pengiriman dari booking.php salah
if (empty($jam_string)) {
    echo "DEBUG: Data jam kosong. URL saat ini: " . $_SERVER['REQUEST_URI'];
    exit;
}

$jam_list = explode(',', $jam_string);
$total_jam = count($jam_list);
$total_harga = $total_jam * 100000;

// Ambil Nama Lapangan
$query = mysqli_query($conn, "SELECT nama_lapangan FROM lapangan WHERE id_lapangan='$id_lap'");
$lap = mysqli_fetch_assoc($query);
$nama_lapangan = $lap ? $lap['nama_lapangan'] : "Lapangan Tidak Ditemukan";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sport Academy - Buat Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
    background:
    radial-gradient(circle at top left,#f39c1220,transparent 30%),
    radial-gradient(circle at bottom right,#f39c1220,transparent 30%),
    #0d1117;
    color:#fff;
    font-family:'Poppins',sans-serif;
    min-height:100vh;
}

.container{
    max-width:1100px;
    margin-top:40px;
}

h1{
    font-family:'Anton',sans-serif;
    font-size:60px;
    letter-spacing:2px;
    color:white;
}

.card-custom{
    background:rgba(255,255,255,.03);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    padding:30px;

    animation:floating 4s ease-in-out infinite;
}

@keyframes floating{
    0%{
        transform:translateY(0px);
    }

    50%{
        transform:translateY(-10px);
    }

    100%{
        transform:translateY(0px);
    }
}

.card-custom:hover{
    transform:translateY(-5px);
    border-color:#f39c12;
    box-shadow:
    0 0 25px rgba(243,156,18,.25);
}

.section-title{
    color:#f39c12;
    font-family:'Anton',sans-serif;
    letter-spacing:1px;
    margin-bottom:20px;
    display:flex;
    align-items:center;
    gap:10px;
}

.section-title::before{
    content:'';
    width:4px;
    height:25px;
    background:#f39c12;
    border-radius:20px;
}

.form-check-custom{
    border:1px solid rgba(255,255,255,.1);
    background:#181c22;
    padding:18px;
    border-radius:12px;
    transition:.3s;
}

.form-check-custom:hover{
    border-color:#f39c12;
    background:#20252d;
}

.form-control{
    background:#171b21 !important;
    border:1px solid #333;
    color:white !important;
}

.form-control:focus{
    border-color:#f39c12;
    box-shadow:0 0 10px rgba(243,156,18,.3);
}

.btn-pesan{
    background:linear-gradient(
    135deg,
    #f39c12,
    #ffb830
    );
    border:none;
    color:#000;
    font-family:'Anton',sans-serif;
    letter-spacing:1px;
    font-size:20px;
    border-radius:12px;
    padding:16px;
    width:100%;
    transition:.3s;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:center;
}

.btn-pesan:hover{
    transform:translateY(-3px);
    box-shadow:
    0 0 25px rgba(243,156,18,.5);
}

.total-box{
    background:rgba(255,255,255,.03);
    border-radius:15px;
    padding:15px 25px;
}

.total-box p{
    color:#888;
    margin-bottom:5px;
}

.total-box h2{
    color:#f39c12;
    font-family:'Anton',sans-serif;
    font-size:45px;
}

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

<div class="container">
    <a href="booking.php?id=<?php echo $id_lap; ?>&tanggal=<?php echo $tanggal; ?>" class="btn-kembali">
    KEMBALI
</a>
    <h1 class="mt-3">BUAT PESANAN</h1>
    <p class="text-secondary">Sport Academy - Konfirmasi Jadwal Lapangan</p>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="section-title">PESANAN LAPANGAN</div>
            <div class="card-custom">
                <p class="text-secondary mb-1">JENIS LAPANGAN</p>
                <h6><?php echo htmlspecialchars($nama_lapangan); ?></h6>
                <hr class="border-secondary">
                <p class="text-secondary mb-1">WAKTU PAKAI</p>
                <h6><?php echo !empty($tanggal) ? date('l, d F Y', strtotime($tanggal)) : "-"; ?></h6>
                <hr class="border-secondary">
              <p class="text-secondary mb-1">JAM PEMAKAIAN</p>
              
<?php 
    foreach($jam_list as $jam) {
        // htmlspecialchars menjaga data agar tidak error
        echo "<h6>● " . htmlspecialchars($jam) . " WIB</h6>";
    }
?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="section-title">JENIS PEMAKAIAN</div>
            <div class="card-custom">
                <div class="form-check-custom">
                    <input class="form-check-input" type="radio" name="pemakaian" id="sekali" checked>
                    <label class="form-check-label" for="sekali"><strong>Sekali Pakai</strong></label>
                </div>
                <div class="form-check-custom">
                    <input class="form-check-input" type="radio" name="pemakaian" id="periodik">
                    <label class="form-check-label" for="periodik"><strong>Periodik</strong></label>

                </div>
                <p class="mt-3">TUJUAN PEMAKAIAN :</p>
<textarea
    id="tujuan"
    class="form-control bg-dark text-white border-secondary"
    rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-5">
        <div>
            <p class="text-secondary mb-0">ESTIMASI TOTAL PEMBAYARAN</p>
            <h3>Rp. <?php echo number_format($total_harga, 0, ',', '.'); ?></h3>
        </div>
        <a href="#"
   id="btnPesan"
   class="btn btn-pesan">
   BUAT PESANAN
</a>
    </div>
</div>

</body>

<script>
document.getElementById('btnPesan').addEventListener('click', function(e){

    let tujuan = document.getElementById('tujuan').value.trim();

    // Jika Periodik dipilih dan tujuan kosong
    if(document.getElementById('periodik').checked && tujuan === ''){
        alert('Tujuan pemakaian wajib diisi untuk pemakaian periodik!');
        return false;
    }

    // lanjut ke pembayaran
    window.location.href =
        'pembayaran.php?id=<?php echo $id_lap; ?>' +
        '&tanggal=<?php echo $tanggal; ?>' +
        '&jam=<?php echo urlencode($jam_string); ?>' +
        '&tujuan=' + encodeURIComponent(tujuan);

});
</script>
</html>