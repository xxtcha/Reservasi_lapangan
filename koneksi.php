<?php
$conn = mysqli_connect("localhost", "root", "", "reservasi_lapangan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>