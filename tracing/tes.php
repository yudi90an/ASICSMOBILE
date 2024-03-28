<!DOCTYPE html>
<html>
<head>
    <title>Status Pemesanan</title>
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
        left: 50%;
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
        left: 50%;
        margin-top: -20px;
        margin-left: -20px;
        background-color: #007bff;
        border: 3px solid #ffffff;
        border-radius: 100%;
        z-index: 100;
    }
    .timeline-item .timeline-panel {
        width: calc(50% - 90px);
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
    .timeline-item .timeline-panel:after {
        content: '';
        position: absolute;
        top: 27px;
        right: -5px;
        border-top: 7px solid transparent;
        border-left: 7px solid #d4d4d4;
        border-right: 7px solid transparent;
        border-bottom: 7px solid transparent;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Status Pemesanan</h2>
        <ul class="timeline">
            <?php
            // Data status pemesanan
            $status_pemesanan = array(
                array("tanggal" => "2024-03-20", "status" => "Pemesanan diterima"),
                array("tanggal" => "2024-03-22", "status" => "Sedang diproses"),
                array("tanggal" => "2024-03-25", "status" => "Sedang dikirim"),
                array("tanggal" => "2024-03-28", "status" => "Telah diterima")
            );

            // Loop untuk menampilkan status pemesanan dalam timeline
            foreach ($status_pemesanan as $status) {
                echo '<li class="timeline-item">
                        <div class="timeline-badge">' . date('d', strtotime($status["tanggal"])) . '<br>' . date('M', strtotime($status["tanggal"])) . '</div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">' . $status["status"] . '</h4>
                            </div>
                            <div class="timeline-body">
                                <p>Tanggal: ' . date('d F Y', strtotime($status["tanggal"])) . '</p>
                            </div>
                        </div>
                    </li>';
            }
            ?>
        </ul>
    </div>
</body>
</html>
