<?php
include 'koneksi.php';

// Pastikan method-nya POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form (Pastikan 'name' di form register.php sama persis dengan ini)
    $nama = $_POST['nama_pelanggan']; 
    $email = $_POST['email'];
    $hp = $_POST['no_hp'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mengamankan password

    // Masukkan ke database
    $query = "INSERT INTO pelanggan (nama_pelanggan, email, no_hp, password, tanggal_daftar) 
              VALUES ('$nama', '$email', '$hp', '$pass', NOW())";

    if (mysqli_query($conn, $query)) {
        // Berhasil, arahkan ke halaman login
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>