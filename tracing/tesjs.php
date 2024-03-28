<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<div class="container">
    <h2>Status Pemesanan</h2>
    <ul id="timeline" class="timeline">
        <!-- Timeline items will be appended here -->
    </ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data status pemesanan
        var status_pemesanan = [
            { tanggal: "2024-03-20", status: "Pemesanan diterima" },
            { tanggal: "2024-03-22", status: "Sedang diproses" },
            { tanggal: "2024-03-25", status: "Sedang dikirim" },
            { tanggal: "2024-03-28", status: "Telah diterima" },
            { tanggal: "2024-03-28", status: "Telah diterima" },
            { tanggal: "2024-03-28", status: "Telah diterima" },
            { tanggal: "2024-03-28", status: "Telah diterima" }
        ];

        // Function to create timeline item
        function createTimelineItem(status) {
            var timelineItem = document.createElement("li");
            timelineItem.classList.add("timeline-item");

            var timelineBadge = document.createElement("div");
            timelineBadge.classList.add("timeline-badge");
            timelineBadge.textContent = new Date(status.tanggal).getDate() + "\n" + new Date(status.tanggal).toLocaleString('default', { month: 'short' });
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
            timelineDate.textContent = "Tanggal: " + new Date(status.tanggal).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
            timelineBody.appendChild(timelineDate);
            timelinePanel.appendChild(timelineBody);

            timelineItem.appendChild(timelinePanel);

            return timelineItem;
        }

        // Populate timeline with data
        var timeline = document.getElementById("timeline");
        status_pemesanan.forEach(function(status) {
            timeline.appendChild(createTimelineItem(status));
        });
    });
</script>
</body>
</html>
