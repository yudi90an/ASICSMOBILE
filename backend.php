<?php
// Konfigurasi koneksi database
require("koneksi.php");

// Menerima data dari permintaan AJAX

$spk = $_POST['data'];


// Menyiapkan query SQL untuk menyimpan data ke dalam tabel
$sql = "SELECT o.order_id as spkid ,p.ship_to AS shipto ,p.ship_to_party AS alamat FROM order_d o LEFT JOIN list_do_part p ON o . delivery_no = p . delivery_no  WHERE o.order_id ='$spk' group by o.ship_to asc ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mengonversi hasil query menjadi array asosiatif
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Mengembalikan data dalam format JSON sebagai respon ke frontend
    echo json_encode($data);
} else {
    echo " query select berjalan ";
}


// Menutup koneksi database
$conn->close();
?>
