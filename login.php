<?php
session_start();
// Koneksi ke database MySQL
require("koneksi.php");

// Ambil data login dari body POST
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;

// Periksa kredensial pengguna di database
$sql = "SELECT * FROM users WHERE username='$username' AND pass='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    // Login berhasil
    $response = array("success" => true);
} else {
    // Login gagal
    $response = array("success" => false, "message" => "Username atau password salah.");
}

echo json_encode($response);

$conn->close();
?>
