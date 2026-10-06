<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        echo "<script>
                alert('Email dan Password wajib diisi!');
                window.location.href='index.php';
              </script>";
        exit;
    }

    /* =====================================
       CEK LOGIN ADMIN
    ===================================== */
    $stmtAdmin = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmtAdmin->bind_param("s", $email);
    $stmtAdmin->execute();

    $resultAdmin = $stmtAdmin->get_result();
    $admin = $resultAdmin->fetch_assoc();

    if ($admin) {

    if ($password == $admin['password']) {

        $_SESSION['id_admin'] = $admin['id_admin'];
        $_SESSION['nama_admin'] = $admin['nama_admin'];
        $_SESSION['role'] = 'admin';
        $_SESSION['login'] = true;

        header("Location: dashboard_admin.php");
        exit;

    } else {

        echo "<script>
                alert('Password Admin Salah!');
                window.location.href='index.php';
              </script>";
        exit;
    }
}

    /* =====================================
       CEK LOGIN PELANGGAN
    ===================================== */
    $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {

        if (password_verify($password, $data['password'])) {

            $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
            $_SESSION['nama_pelanggan'] = $data['nama_pelanggan'];
            $_SESSION['role'] = 'pelanggan';
            $_SESSION['login'] = true;

            header("Location: home.php");
            exit;

        } else {

            echo "<script>
                    alert('Password Salah!');
                    window.location.href='index.php';
                  </script>";
            exit;
        }
    }

    echo "<script>
            alert('Email tidak terdaftar!');
            window.location.href='index.php';
          </script>";
    exit;

} else {

    header("Location: index.php");
    exit;
}
?>