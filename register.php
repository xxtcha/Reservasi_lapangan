<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Academy - Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/img/lapangan.png');
            background-size: cover; background-position: center;
            background-attachment: fixed; min-height: 100vh;
            display: flex; flex-direction: column; align-items: center;
            font-family: 'Poppins', sans-serif; color: white;
        }
        nav { width: 100%; padding: 20px 80px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-family: 'Anton', sans-serif; color: #f39c12; font-size: 24px; letter-spacing: 1px; }
        .nav-links a { color: white; text-decoration: none; margin-left: 30px; font-size: 13px; letter-spacing: 1px; opacity: 0.8; }
        .nav-links a.active { border: 1px solid white; padding: 8px 15px; border-radius: 5px; opacity: 1; }
        .register-card {
            background: rgba(25, 25, 25, 0.9); padding: 40px; border-radius: 20px;
            width: 550px; text-align: center; margin-top: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        h2 { font-family: 'Anton', sans-serif; font-size: 30px; letter-spacing: 2px; margin-bottom: 25px; }
        .form-group { text-align: left; margin-bottom: 15px; }
        .form-group label { display: block; font-size: 11px; font-weight: 600; margin-bottom: 8px; color: #bbb; }
        .input-wrapper { position: relative; }
        .input-wrapper i { position: absolute; right: 15px; top: 12px; color: #666; cursor: pointer; }
        input { width: 100%; padding: 12px 15px; border: none; border-radius: 8px; color: #333; font-size: 13px; }
        .grid-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .btn-submit {
            width: 100%; padding: 15px; background: #f39c12; border: none; border-radius: 10px;
            color: #000; font-family: 'Anton', sans-serif; font-size: 18px; cursor: pointer;
            margin-top: 20px; display: flex; justify-content: center; gap: 10px; transition: 0.3s;
        }
        .btn-submit:hover { background: #e68a00; }
        .login-link { margin-top: 25px; font-size: 12px; color: #888; }
        .login-link a { color: #f39c12; text-decoration: none; font-weight: bold; }
        .bottom-icons { margin-top: 40px; display: flex; gap: 25px; opacity: 0.4; font-size: 20px; }
    </style>
</head>
<body>

    <nav>
        <div class="logo">SPORT ACADEMY</div>
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <a href="register.php" class="active">MASUK/DAFTAR</a>
        </div>
    </nav>

    <div class="register-card">
        <h2>PENDAFTARAN</h2>
        <form action="proses_register.php" method="POST">
            <div class="form-group">
                <label>NAMA LENGKAP</label>
                <input type="text" name="nama_pelanggan" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label>EMAIL</label>
                <input type="email" name="email" placeholder="contoh@email.com" required>
            </div>

            <div class="grid-row">
                <div class="form-group">
                    <label>NOMOR TELEPON</label>
                    <input type="text" name="no_hp" placeholder="0812xxxx" required>
                </div>
                <div class="form-group">
                    <label>KATA SANDI</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" placeholder="Min. 8 karakter" required>
                        <i class="fa-regular fa-eye-slash"></i>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                DAFTAR SEKARANG <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <div class="login-link">
            Sudah memiliki akun? <a href="index.php">MASUK SEKARANG</a>
        </div>
    </div>

</body>
</html>