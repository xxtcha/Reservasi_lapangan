<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query(
$conn,
"SELECT * FROM admin
WHERE username='$username'"
);

$data = mysqli_fetch_assoc($query);

if($data)
{
    if(password_verify($password,$data['password']))
    {
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['nama_admin'] = $data['nama_admin'];

        header("Location: dashboard_admin.php");
        exit;
    }
    else
    {
        echo "<script>
        alert('Password Salah');
        window.location='index.php';
        </script>";
    }
}
else
{
    echo "<script>
    alert('Username Tidak Ditemukan');
    window.location='index.php';
    </script>";
}
?>