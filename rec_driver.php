<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMING DRIVER</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
    include('navbar.php');
    $waktu = date("Y-m-d H:i:s");

    // Lokasi file ikon JPG
    $lokasi_ikon = "images/arrivaltruck.png";
    ?>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="dashboard.php">KEMBALI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php" onclick="goBack()">Back</a>
      </li>
    </ul>
  </div>
</nav> -->

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <div class="container">
        <h2 class="mt-5"></h2>
        <form id="data-form" class="mt-3" method="POST">
            <!-- Div untuk menampilkan waktu Indonesia -->
            <div id="waktuIndonesia"></div>
            <div class="form-group">
                <label for="name">SPK Number</label>
                <input type="text" id="spk" name="spk" class="form-control" placeholder="Enter SPK Number" required>

            </div>



            <!-- <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" class="form-control" rows="5" placeholder="Enter your message"></textarea>
                <button type="button" onclick="sendData()" class="btn btn-primary">Submit</button>
            </div> -->
            <button type="button" id="sendButton">Lihat Alamat</button>

            <!-- Div untuk menampilkan hasil -->
            <table class="table table-bordered table-responsive" ><tbody id="result"></tbody></table>


        </form>
    </div>
    <script>
        $(document).ready(function() {
            // Ketika tombol "Kirim Data" diklik
            $("#sendButton").click(function() {
                // Mendapatkan nilai dari input teks
                var dataToSend = $("#spk").val();


                var now = new Date();
                var year = now.getFullYear();
                var month = (now.getMonth() + 1).toString().padStart(2, '0'); // Mengonversi bulan menjadi string dengan 2 digit
                var day = now.getDate().toString().padStart(2, '0'); // Mengonversi tanggal menjadi string dengan 2 digit
                var currentDate = year + '-' + month + '-' + day;

                // Objek data yang akan dikirim ke backend
                var postData = {
                    data: dataToSend

                };

                // Mengirim data ke backend menggunakan metode AJAX
                $.ajax({
                    url: "backend.php", // Ganti dengan URL backend yang sesuai
                    type: "POST", // Metode HTTP untuk pengiriman
                    data: postData, // Data yang akan dikirim
                    dataType: "JSON",
                    success: function(response) {
                        // Handle respon dari backend jika pengiriman berhasil
                        console.log("Data berhasil dikirim ke backend:", response);
                        // Lakukan tindakan lain sesuai kebutuhan
                        $("#result").empty();
                        // Mengisi baris tabel dengan data JSON
                        $.each(response, function(index, item) { 
                            
                            var divShipTo = "<td>Ship To: " + item.shipto + "</td>";
                            var divAlamat = "<td>Alamat: " + item.alamat + "</td>";
                            var divOrderID = "<td>SPK NO: " + item.spkid + "</td>";
                            // Membuat tombol di setiap div untuk melakukan sesuatu (misalnya, hapus)
                            var deleteButton = "<td><button type='button' class='deleteButton' data-spkid='"+ item.spkid +"' data-date='"+ currentDate +"' data-id='" + item.shipto + "'>WAKTU KEDATANGAN</button></td>";

                            // Menggabungkan semua div ke dalam satu div untuk setiap baris
                            var divRow = "<tr>" + deleteButton +  divShipTo + divAlamat  + divOrderID + "</tr>";

                            $("#result").append(divRow);
                        });

                        



                    },
                    error: function(xhr, status, error) {
                        // Handle kesalahan jika pengiriman gagal
                        console.error("Gagal mengirim data ke backend:", error);
                        // Lakukan tindakan lain sesuai kebutuhan
                    }
                });
            });

            // Fungsi untuk menampilkan waktu Indonesia
            function displayWaktuIndonesia() {
                var options = {
                    timeZone: 'Asia/Jakarta', // Zona waktu Indonesia
                    hour12: false, // Format 24 jam
                    year: 'numeric', // Menampilkan tahun
                    month: '2-digit', // Menampilkan bulan dengan 2 digit
                    day: '2-digit' // Menampilkan tanggal dengan 2 digit
                };
                var waktu = new Date().toLocaleString('id-ID', options);
                $("#waktuIndonesia").html("<p>Waktu Indonesia: " + waktu + "</p>");
            }

            // Memanggil fungsi untuk menampilkan waktu Indonesia setiap detik
            setInterval(displayWaktuIndonesia, 1000);


            
                            // Menambahkan event listener untuk tombol hapus
                            $(document).on("click", ".deleteButton", function() {
                                // Mendapatkan ID unik dari atribut data
                                var id = $(this).data("id");
                                var date = $(this).data("date");
                                var spkid = $(this).data("spkid");

                                // Konfirmasi pengguna sebelum menghapus
                                if (confirm("Apakah anda sudah sampai tujuan?")) {
                                    // Kirim permintaan AJAX untuk memperbaharui waktu dari database
                                    $.ajax({
                                        url: "arrival_delivery.php", // Ganti dengan URL backend yang sesuai
                                        type: "POST",
                                        data: {
                                            id: id,
                                            rec_date :date,
                                            nomorspk  :spkid
                                        }, // Kirim ID unik sebagai data
                                        success: function(response) {
                                            // Handle respon dari backend jika  berhasil
                                            console.log("rec date berhasil diperbaharui:", response);
                                            // Lakukan tindakan lain sesuai kebutuhan, misalnya, hapus item dari DOM
                                           
                                        },
                                        error: function(xhr, status, error) {
                                            // Handle kesalahan jika  gagal
                                            console.error("Gagal update waktu:", error);
                                            // Lakukan tindakan lain sesuai kebutuhan
                                        }
                                    });
                                }
                            });
                    

        });
    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>