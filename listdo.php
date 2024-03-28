<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$DO = $_POST["do"];




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list DO</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .timeline {
            list-style: none;
            padding: 0;
            margin: 40px 0 20px 0;
            position: relative;
        }

        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #007bff;
            left: 20px;
            margin-left: -2px;
        }

        .timeline-item {
            margin-bottom: 20px;
            position: relative;
        }

        .timeline-item:before,
        .timeline-item:after {
            content: '';
            display: table;
        }

        .timeline-item:after {
            clear: both;
        }

        .timeline-item .timeline-badge {
            color: #FFA500;
            width: 40px;
            height: 40px;
            line-height: 40px;
            font-size: 18px;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 15px;
            margin-top: -20px;
            margin-left: -20px;
            background-color: #007bff;
            border: 3px solid #ffffff;
            border-radius: 100%;
            z-index: 100;
        }

        .timeline-item .timeline-panel {
            margin-left: 40px;
            width: calc(100% - 90px);
            float: left;
            border: 1px solid #d4d4d4;
            border-radius: 5px;
            padding: 20px;
            position: relative;
            background-color: #f0f0f0;
        }

        .timeline-item .timeline-panel:before {
            content: '';
            position: absolute;
            top: 26px;
            right: -6px;
            border-top: 8px solid transparent;
            border-left: 8px solid #f0f0f0;
            border-right: 8px solid transparent;
            border-bottom: 8px solid transparent;
        }

        /* .timeline-item .timeline-panel:after {
        content: '';
        position: absolute;
        top: 27px;
        right: -5px;
        border-top: 7px solid transparent;
        border-left: 7px solid #d4d4d4;
        border-right: 7px solid transparent;
        border-bottom: 7px solid transparent;
    } */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="cekdo.php">KEMBALI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" onclick="goBack()">KELUAR</a>
                </li>
            </ul>
        </div>
    </nav>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <div class="container">

        <div class="row">
            <div class="col col-md-12">
                <h2 class="mt-2">Trace DO </h2> 
                <ul id="timeline" class="timeline">
                    <!-- Timeline items will be appended here -->
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, jika Anda ingin menggunakan fitur JavaScript Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery (Diperlukan untuk beberapa komponen Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- JavaScript Anda -->
    <script>
        document.addEventListener("DOMContentLoaded", async function() {


            let data = await $.post('tracingController.php', {
                get_do: true,
                do: "<?php echo $DO ?>"
            }, function(response) {}, 'json');
            // console.log(data);
            let order = data.data;
            console.log(order);
            // return

            let arrayDo = [];
            let arrayDo2 = [];
            order.forEach(function(item) {
                console.log(item)
                var unloading = {};
                var balikan = {};
                var hodate = {};
                var spkotw = {};
                var plan = {};
                unloading.tanggal = item.date_unloading;
                
                balikan.tanggal = item.return_doc_date;
                hodate.tanggal = item.ho_date_tosony;
                spkotw.tanggal = item.spk_date;
                spkotw.hp = item.driver_tlpn;
                plan.tanggal = item.order_date;

                unloading.status = "Proses UnLoading";
                spkotw.status = "DRIVER ON THE WAY";
                balikan.status = "Proses POD Ke YUSEN";
                hodate.status = "Proses POD Ke Asics";
                plan.status = "Planning Truck Order";

                unloading.spk = item.order_id;
                spkotw.spk = item.order_id;
                balikan.spk = item.order_id;
                hodate.spk = item.order_id;
                plan.spk = item.order_id;

                if (hodate.tanggal != "0000-00-00") arrayDo.push(hodate);
                if (balikan.tanggal != "0000-00-00") arrayDo.push(balikan);
                if (unloading.tanggal != "0000-00-00") arrayDo.push(unloading);
                if (spkotw.tanggal != "0000-00-00") arrayDo.push(spkotw);
                if (plan.tanggal != "0000-00-00") arrayDo.push(plan);
                
                // if(hodate.tanggal ="0000-00-00"){arrayDo.push(hodate)} else {hodate.status="belum POD ke asics";}
                // if(balikan.tanggal ="0000-00-00"){arrayDo.push(balikan)} else {balikan.status="belum POD ke yusen";}
                // if(spkotw.tanggal ="0000-00-00"){arrayDo.push(spkotw)} else {spkotw.status="belum terima";}
                // if(unloading.tanggal ="0000-00-00"){arrayDo.push(unloading)} else {unloading.status="belum UNLoading";}

                // arrayDo.push(hodate);
                // arrayDo.push(balikan);
                // arrayDo.push(spkotw);
                // arrayDo.push(unloading);



            });

            console.log(arrayDo);

            // Data status pemesanan
            // var status_pemesanan = [{
            //         tanggal: "2024-03-20",
            //         status: "Pemesanan diterima"
            //     },
            //     {
            //         tanggal: "2024-03-22",
            //         status: "Sedang diproses"
            //     },
            //     {
            //         tanggal: "2024-03-25",
            //         status: "Sedang dikirim"
            //     },
            //     {
            //         tanggal: "2024-03-28",
            //         status: "Telah diterima"
            //     },
            //     {
            //         tanggal: "2024-03-28",
            //         status: "Telah diterima"
            //     },
            //     {
            //         tanggal: "2024-03-28",
            //         status: "Telah diterima"
            //     },
            //     {
            //         tanggal: "2024-03-28",
            //         status: "Telah diterima"
            //     }
            // ];

            // Function to create timeline item
            function createTimelineItem(status) {
                var timelineItem = document.createElement("li");
                timelineItem.classList.add("timeline-item");

                var timelineBadge = document.createElement("div");
                timelineBadge.classList.add("timeline-badge");
                timelineBadge.textContent = new Date(status.tanggal).getDate() + "\n" + new Date(status.tanggal).toLocaleString('default', {
                    month: 'short'
                });
                timelineItem.appendChild(timelineBadge);

                var timelinePanel = document.createElement("div");
                timelinePanel.classList.add("timeline-panel");

                var timelineHeading = document.createElement("div");
                timelineHeading.classList.add("timeline-heading");
                var timelineTitle = document.createElement("h4");
                timelineTitle.classList.add("timeline-title");
                timelineTitle.textContent = status.status;
                timelineHeading.appendChild(timelineTitle);
                timelinePanel.appendChild(timelineHeading);

                var timelineBody = document.createElement("div");
                timelineBody.classList.add("timeline-body");
                var timelineDate = document.createElement("p");
                timelineDate.textContent = "Tanggalnya: " + new Date(status.tanggal).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                var timelineSPK = document.createElement("p");
                timelineSPK.textContent = status.spk;

                var timelinehp = document.createElement("p");
                timelinehp.textContent = status.hp;
                timelineBody.appendChild(timelineDate);
                timelineBody.appendChild(timelineSPK);
                timelineBody.appendChild(timelinehp);
                timelinePanel.appendChild(timelineBody);

                timelineItem.appendChild(timelinePanel);

                return timelineItem;
            }

            // Populate timeline with data
            var timeline = document.getElementById("timeline");
            arrayDo.forEach(function(status) {
                timeline.appendChild(createTimelineItem(status));
            });
        });
    </script>
</body>

</html>