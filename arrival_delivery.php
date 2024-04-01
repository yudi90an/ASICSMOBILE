<?php
// Konfigurasi koneksi database
require("koneksi.php");

// Tangkap ID yang dikirim dari AJAX
$id = $_POST['id'];
$rec_date = $_POST['rec_date'];
$spkid = $_POST['nomorspk'];

// Buat query SQL untuk perbaharui arrival date dari database
$sql = "update order_d set rec_date='$rec_date' WHERE ship_to = '$id' and order_id='$spkid'"; // Ganti "nama_tabel" dengan nama tabel Anda

// echo "cek: " . $sql . "<br>";
// Jalankan query SQL
if ($conn->query($sql) === TRUE) {
    echo "rec date berhasil diperbaharui dari database.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi database
$conn->close();
?>
