<?php
// CLI test script for login verification
if (php_sapi_name() !== 'cli') {
    echo "Run this script from CLI: php test_login.php <email> <password>\n";
    exit(1);
}

require __DIR__ . '/koneksi.php';

$email = $argv[1] ?? null;
$password = $argv[2] ?? null;

if (!$email || !$password) {
    echo "Usage: php test_login.php <email> <password>\n";
    exit(1);
}

function check_table($conn, $table, $email, $password) {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE email = ?");
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error . "\n";
        return null;
    }
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    if (!$row) return null;
    $ok = password_verify($password, $row['password']);
    return ['row' => $row, 'ok' => $ok];
}

// Check admin
$adminRes = check_table($conn, 'admin', $email, $password);
if ($adminRes) {
    echo "Found admin: " . ($adminRes['row']['nama_admin'] ?? $adminRes['row']['email']) . "\n";
    echo "Password verify: " . ($adminRes['ok'] ? 'OK' : 'FAIL') . "\n";
} else {
    echo "No admin with that email.\n";
}

// Check pelanggan
$userRes = check_table($conn, 'pelanggan', $email, $password);
if ($userRes) {
    echo "Found pelanggan: " . ($userRes['row']['nama_pelanggan'] ?? $userRes['row']['email']) . "\n";
    echo "Password verify: " . ($userRes['ok'] ? 'OK' : 'FAIL') . "\n";
} else {
    echo "No pelanggan with that email.\n";
}

mysqli_close($conn);
?>