<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Lapangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121417; color: white; font-family: 'Poppins', sans-serif; }
        h2 { font-family: 'Anton', sans-serif; letter-spacing: 3px; margin: 50px 0; color: #fff; }

        .card-lapangan { 
            background: #1c1f24; 
            border: 1px solid #333; 
            border-radius: 15px; 
            padding: 25px; 
            margin-bottom: 30px; 
        }

        .title-lapangan { 
            font-family: 'Anton', sans-serif; 
            color: #f39c12; 
            font-size: 32px; 
            margin-bottom: 10px; 
        }

        .info-item { font-size: 14px; margin-bottom: 5px; color: #ccc; }
        .divider { border-top: 1px solid #333; margin: 15px 0; }
        .price-label { font-size: 11px; color: #888; text-transform: uppercase; margin-bottom: 2px; }
        .price-text { font-family: 'Anton', sans-serif; font-size: 20px; color: #f39c12; }
        
        .btn-cek { 
            background: #f39c12; 
            color: #000; 
            font-family: 'Anton', sans-serif; 
            border: none; 
            padding: 12px 25px; 
            border-radius: 5px;
            font-size: 16px;
            text-transform: uppercase;
        }
        .btn-cek:hover { background: #e68a00; color: #000; }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="text-center">PILIH LAPANGAN</h2>

    <?php
    /
    $gambar_lapangan = [
        'FUTSAL' => 'futsal.jpg',
        'BADMINTON' => 'badminton.jpg',
        'BASKETBALL' => 'basketball.jpg'
    ];

    $query = mysqli_query($conn, "SELECT * FROM lapangan");
    while ($data = mysqli_fetch_assoc($query)) {
        // Ambil gambar berdasarkan nama lapangan, jika tidak ada pakai default
        $nama = strtoupper($data['nama_lapangan']);
        $img = isset($gambar_lapangan[$nama]) ? $gambar_lapangan[$nama] : 'default.jpg';
    ?>
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-lapangan">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="assets/img/<?php echo $img; ?>" class="img-fluid rounded" style="width:100%; height:180px; object-fit:cover;">
                    </div>
                    
                    <div class="col-md-8">
                        <div class="title-lapangan"><?php echo $nama; ?></div>
                        <div class="info-item">✓ <?php echo $data['tujuan_pemakaian']; ?></div>
                        
                        <div class="divider"></div>
                        
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="price-label">Harga Mulai Dari</div>
                                <div class="price-text">RP <?php echo number_format($data['harga_per_jam'], 0, ',', '.'); ?> / SESI (60 MENIT)</div>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="booking.php?id=<?php echo $data['id_lapangan']; ?>" class="btn btn-cek">CEK KETERSEDIAAN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

</body>
</html>