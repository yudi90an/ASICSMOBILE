<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Status Pemesanan</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .timeline {
        list-style: none;
        padding: 20px 0 20px 0;
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
        color: #fff;
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
        width: calc(100% - 90px);
        float: left;
        border: 1px solid #d4d4d4;
        border-radius: 5px;
        padding: 20px;
        position: relative;
        background-color: #f0f0f0;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Status Pemesanan</h2>
    <ul class="timeline">
        <li class="timeline-item">
            <div class="timeline-badge">20<br>Mar</div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">Pemesanan diterima</h4>
                </div>
                <div class="timeline-body">
                    <p>Tanggal: 20 Maret 2024</p>
                </div>
            </div>
        </li>
        <li class="timeline-item">
            <div class="timeline-badge">22<br>Mar</div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">Sedang diproses</h4>
                </div>
                <div class="timeline-body">
                    <p>Tanggal: 22 Maret 2024</p>
                </div>
            </div>
        </li>
        <li class="timeline-item">
            <div class="timeline-badge">25<br>Mar</div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">Sedang dikirim</h4>
                </div>
                <div class="timeline-body">
                    <p>Tanggal: 25 Maret 2024</p>
                </div>
            </div>
        </li>
        <li class="timeline-item">
            <div class="timeline-badge">28<br>Mar</div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">Telah diterima</h4>
                </div>
                <div class="timeline-body">
                    <p>Tanggal: 28 Maret 2024</p>
                </div>
            </div>
        </li>
    </ul>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
