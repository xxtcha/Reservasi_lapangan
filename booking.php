<?php
session_start();
include 'koneksi.php';

// Ambil ID lapangan dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM lapangan WHERE id_lapangan = '$id'");
    $lapangan = mysqli_fetch_assoc($query);
} else {
    // Jika tidak ada ID, beri nilai default atau redirect
    $lapangan = null;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Jam Main - Sport Academy</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
    font-family:'Poppins',sans-serif;

    background:
    linear-gradient(rgba(0,0,0,.82),rgba(0,0,0,.88)),
    url('assets/img/lapangan.png');

    background-size:cover;
    background-position:center;
    background-attachment:fixed;

    color:white;
    min-height:100vh;
}

/* efek cahaya */
body::before{
    content:'';
    position:fixed;
    inset:0;

    background:
    radial-gradient(circle at 20% 20%,
    rgba(243,156,18,.12),
    transparent 30%),

    radial-gradient(circle at 80% 40%,
    rgba(255,255,255,.05),
    transparent 30%);

    animation:gerak 8s infinite alternate ease-in-out;

    pointer-events:none;
}

@keyframes gerak{
    from{
        transform:translateY(0);
    }

    to{
        transform:translateY(-25px);
    }
}

.container{
    max-width:1200px;
}

h2{
    font-family:'Anton',sans-serif;
    letter-spacing:2px;
    font-size:50px;
}

.text-warning{
    color:#f39c12 !important;
    font-weight:600;
}

/* form tanggal */

.form-control{
    background:rgba(255,255,255,.05)!important;
    border:1px solid rgba(255,255,255,.1)!important;
    color:white!important;
    border-radius:12px;
    padding:12px;
}

.form-control:focus{
    border-color:#f39c12!important;

    box-shadow:
    0 0 20px rgba(243,156,18,.25)!important;
}

/* grid */

.jam-grid{
    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-top:20px;
}

/* box jam */

.box-jam{

    background:
    rgba(255,255,255,.06);

    backdrop-filter:blur(15px);

    border:1px solid rgba(255,255,255,.08);

    border-radius:18px;

    padding:25px;

    text-align:center;

    cursor:pointer;

    transition:.35s;

    animation:muncul .6s ease;
}

@keyframes muncul{

    from{
        opacity:0;
        transform:translateY(25px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}

.box-jam:hover{

    transform:translateY(-8px);

    border-color:#f39c12;

    box-shadow:
    0 15px 35px rgba(243,156,18,.18);
}

.box-jam .durasi{

    font-size:11px;

    color:#ccc;

    margin-bottom:10px;
}

.box-jam .jam{

    font-size:23px;

    font-weight:700;

    margin-bottom:10px;
}

.box-jam .harga{

    color:#4aa3df;

    font-size:14px;
}

/* tersedia */

.box-jam.tersedia{
    color:white;
}

/* dipilih */

.box-jam.dipilih{

    background:
    linear-gradient(135deg,
    rgba(243,156,18,.18),
    rgba(243,156,18,.05));

    border:2px solid #f39c12;

    box-shadow:
    0 0 25px rgba(243,156,18,.4);
}

/* terisi */

.box-jam.terisi{

    opacity:.35;

    cursor:not-allowed;

    filter:grayscale(1);
}

/* panel bawah */

.panel-bawah{

    margin-top:50px;

    background:
    rgba(255,255,255,.05);

    backdrop-filter:blur(15px);

    border-radius:20px;

    padding:25px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    flex-wrap:wrap;

    gap:20px;
}

.legend{
    display:flex;
    gap:25px;
    flex-wrap:wrap;
}

.legend-item{

    display:flex;
    align-items:center;
    gap:8px;
}

.kotak{

    width:18px;
    height:18px;
    border-radius:5px;
}

.kotak.tersedia{
    border:1px solid #777;
}

.kotak.dipilih{
    background:#f39c12;
}

.kotak.terisi{
    background:#222;
}

/* tombol */

.btn-pesan{

    background:#f39c12;

    border:none;

    color:black;

    font-family:'Anton',sans-serif;

    letter-spacing:1px;

    padding:15px 35px;

    border-radius:15px;

    transition:.3s;
}

.btn-pesan:hover{

    background:#ffad2f;

    transform:translateY(-3px);

    box-shadow:
    0 12px 25px rgba(243,156,18,.35);
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

<div class="container py-5">
    <a href="booking.php?id=<?php echo $id_lap; ?>&tanggal=<?php echo $tanggal; ?>" class="btn-kembali">
    KEMBALI
</a>
    
    <h2 class="text-uppercase">PILIH JAM MAIN</h2>
    <p class="text-warning"><?php echo $lapangan['nama_lapangan']; ?></p>
    <div class="mt-4 mb-3">
    <form method="GET" action="booking.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label class="form-label">PILIH TANGGAL MAIN</label>
        <input type="date" name="tanggal" 
               value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>" 
               class="form-control bg-dark text-white border-secondary" 
               style="width: 200px;" 
               onchange="this.form.submit()">
    </form>
</div>
    <div class="jam-grid">
        <?php
        $jam_data = [
            ['jam' => '08.00 - 09.00', 'status' => 'tersedia'],
            ['jam' => '09.00 - 10.00', 'status' => 'tersedia'],
            ['jam' => '10.00 - 11.00', 'status' => 'terisi'],
            ['jam' => '11.00 - 12.00', 'status' => 'tersedia'],
        ];

        foreach ($jam_data as $item) {
            $class = "box-jam " . $item['status'];
            $onclick = ($item['status'] == 'terisi') ? '' : "onclick='pilihJam(this)'";
           
        ?>
            <div class="<?php echo $class; ?>" 
         data-jam="<?php echo $item['jam']; ?>" 
         <?php echo $onclick; ?>>
        <div style="font-size: 10px;">60 MENIT</div>
        <div style="font-weight: bold;"><?php echo $item['jam']; ?> WIB</div>
        <div style="font-size: 12px; color: #4aa3df;">Rp. 100.000</div>
    </div>
<?php } ?>
    </div>
    <div class="jam-grid">
        <?php
        $jam_data = [
            ['jam' => '12.00 - 13.00', 'status' => 'tersedia'],
            ['jam' => '13.00 - 14.00', 'status' => 'tersedia'],
            ['jam' => '14.00 - 15.00', 'status' => 'tersedia'],
            ['jam' => '15.00 - 16.00', 'status' => 'tersedia'],
        ];

        foreach ($jam_data as $item) {
            $class = "box-jam " . $item['status'];
            $onclick = ($item['status'] == 'terisi') ? '' : "onclick='pilihJam(this)'";
        
            ?>
            <div class="<?php echo $class; ?>" 
         data-jam="<?php echo $item['jam']; ?>" 
         <?php echo $onclick; ?>>
        <div style="font-size: 10px;">60 MENIT</div>
        <div style="font-weight: bold;"><?php echo $item['jam']; ?> WIB</div>
        <div style="font-size: 12px; color: #4aa3df;">Rp. 100.000</div>
    </div>
<?php } ?>
    </div>
    <div class="jam-grid">
        <?php
        $jam_data = [
            ['jam' => '16.00 - 17.00', 'status' => 'tersedia'],
            ['jam' => '17.00 - 18.00', 'status' => 'tersedia'],
            ['jam' => '18.00 - 19.00', 'status' => 'tersedia'],
            ['jam' => '19.00 - 20.00', 'status' => 'tersedia'],
        ];

        foreach ($jam_data as $item) {
            $class = "box-jam " . $item['status'];
            $onclick = ($item['status'] == 'terisi') ? '' : "onclick='pilihJam(this)'";
      
            ?>
            <div class="<?php echo $class; ?>" 
         data-jam="<?php echo $item['jam']; ?>" 
         <?php echo $onclick; ?>>
        <div style="font-size: 10px;">60 MENIT</div>
        <div style="font-weight: bold;"><?php echo $item['jam']; ?> WIB</div>
        <div style="font-size: 12px; color: #4aa3df;">Rp. 100.000</div>
    </div>
<?php } ?>
    </div>

    <div class="mt-5 p-3 bg-dark rounded d-flex justify-content-between align-items-center">
        <div>
            <span class="badge" style="background:#25282d; border:1px solid #555;">&nbsp;</span> Tersedia
            <span class="badge ms-3" style="background:#2c2514; border:1px solid #f39c12;">&nbsp;</span> Dipilih
            <span class="badge ms-3" style="background:#1a1a1a; border:1px solid #1a1a1a;">&nbsp;</span> Terisi
        </div>
       <button class="btn btn-warning btn-pesan text-uppercase" onclick="pesanSekarang()">
    Pesan Lapangan →
</button>
    </div>
</div>

<script>
    function pilihJam(el) {
        // Toggle class 'dipilih' agar bisa memilih lebih dari satu
        el.classList.toggle('dipilih');
    }

   function pesanSekarang() {
    let terpilih = [];
    // Pastikan class 'dipilih' ada pada div yang diklik
    document.querySelectorAll('.box-jam.dipilih').forEach(el => {
        terpilih.push(el.getAttribute('data-jam')); 
    });

    if (terpilih.length === 0) {
        alert("Pilih jam!");
        return;
    }

    let id = "<?php echo $id; ?>"; // Pastikan ID ini ada
    let tgl = document.querySelector('input[name="tanggal"]').value;
    
    // GABUNGKAN JAM
    let jam_string = terpilih.join(','); 
    
    // REDIRECT
    window.location.href = "konfirmasi.php?id=" + id + "&tanggal=" + tgl + "&jam=" + encodeURIComponent(jam_string);
}
</script>

</body>
</html>