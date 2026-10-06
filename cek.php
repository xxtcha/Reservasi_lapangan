<?php
// 1. Tes koneksi database
$conn = mysqli_connect("localhost", "root", "", "reservasi_lapangan");

if (!$conn) {
    die("Error Database: " . mysqli_connect_error());
} else {
    echo "Database Terkoneksi!<br>";
}

// 2. Tes apakah folder bisa diakses
echo "Folder Berhasil Diakses!";
?>