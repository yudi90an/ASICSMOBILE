<?php
require_once('../../../config/url.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>List Order Today</title>
    <link rel="stylesheet" href="css/mycss.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">


    <script type="text/javascript" src="js/myjs.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2@11.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/exceljs.min.js"></script>
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
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Status Pemesanan</h2>
                <ul id="timeline" class="timeline">
                    <!-- Timeline items will be appended here -->
                </ul>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async function() {


            let data = await $.post('tracingController.php', {
                get_do: true
            }, function(response) {}, 'json');
            // console.log(data);
            let order = data.data;
            // console.log(order);
            // return

            let arrayDo = [];
            order.forEach(function(item) {
                // console.log(item)
                var dataDo = {};
                dataDo.tanggal = item.order_date;
                // console.log(dataDo);
                dataDo.status = item.order_status;
                arrayDo.push(dataDo);
            });

            // console.log(arrayDo);

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
                timelineDate.textContent = "Tanggal: " + new Date(status.tanggal).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                timelineBody.appendChild(timelineDate);
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



    <!-- <script>
        $(document).ready(function() {

            let table = null;

            showDataOrder();

            function getDataFromServer() {
                return $.ajax({
                    url: "<?= api_url('order/deliveryOrder') ?>",
                    method: 'GET',
                    data: {},
                    dataType: 'json'
                });
            }

            async function displayDataInTable(data) {

                if (table !== null) {
                    table.destroy();
                }

                let order = await data;

                table = await $('#example').DataTable({
                    searching: true,
                    data: data,
                    columns: [{
                            data: null,
                            title: 'No.',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: 'SHIPMENT_ID',
                            title: 'Shipment ID'
                        },
                        {
                            data: 'CUSTOMER_NAME',
                            title: 'Customer Name'
                        },
                        {
                            data: 'SETATUS',
                            title: 'Status'
                        },
                        {
                            data: 'REQUEST_DATE',
                            title: 'REQUEST DATE'
                        },
                        {
                            data: 'ITEM',
                            title: 'ITEM'
                        },
                        {
                            data: 'Total_Requested_Qty',
                            title: 'SUM_Qty'
                        },
                        {
                            data: 'Total_Requested_Qty',
                            title: 'SUM_Qty'
                        },
                        {
                            data: null,
                            title: 'Action',
                            render: function(data, type, row) {
                                // Membuat tombol dengan menggunakan data dalam baris saat ini
                                // return `<button class="btn btn-info btn-xs" data-id="${data.internal_shipment_num}" id="btnDetail">Detail</button>`;
                                return `<input type="CHECKBOX"></input>`;
                            }
                        }
                    ]
                });
            }

            $('#example').on('click', '#btnDetail', function() {
                showLoading();
                let id = $(this).data('id');
                $.post("<?= api_url('order/deliveryDetail') ?>", {
                    id: id
                }, function(response) {
                    hideLoading();
                    let modalBody = $('#bodyDetail');
                    modalBody.empty();
                    let tblDetail = `<table style="width:100%; white-space:nowrap" class="table table-responsive table-bordered" id="tblDetail"></table>`;
                    modalBody.append(tblDetail);
                    var jsonData1 = response.detail
                    $('#tblDetail').DataTable({
                        searching: true,
                        data: jsonData1,
                        columns: [{
                                data: null,
                                title: 'No.',
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row, meta) {
                                    return meta.row + 1;
                                }
                            },
                            {
                                data: 'shipment_id',
                                title: 'Shipment ID',
                            },
                            {
                                data: 'item',
                                title: 'Item'
                            },
                            {
                                data: 'item_desc',
                                title: 'Item Desc'
                            },
                            {
                                data: 'requested_qty',
                                title: 'Req Qty'
                            },
                        ],
                    });
                    $('#modalDetail').modal('show');
                }, 'json');
            })



            // $('#btnFilter').on('click', function() {
            //     showLoading();
            //     getDataFromServer()
            //         .done(function(data) {

            //             displayDataInTable(data.location);
            //             hideLoading();
            //         })
            //         .fail(function(jqXHR, textStatus, errorThrown) {
            //             console.error('Error fetching data:', errorThrown);
            //             hideLoading();
            //         });
            // })

            function showDataOrder() {
                showLoading();
                getDataFromServer()
                    .done(async function(data) {
                        await displayDataInTable(data.order);
                        hideLoading();
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching data:', errorThrown);
                        hideLoading();
                    });
            }

            // $('#downloadBtn').on('click', downloadExcel)


            function downloadExcel() {
                var downloadBtn = document.getElementById("downloadBtn");

                // Tampilkan loading saat proses unduhan dimulai
                showLoading();

                // Simulasi proses unduhan
                setTimeout(async function() {
                    // Sembunyikan loading setelah 3 detik (misalnya)
                    hideLoading();

                    // var jsonData1 = [{
                    //         Name: "John",
                    //         Age: 30,
                    //         City: "New York"
                    //     },
                    //     {
                    //         Name: "Alice",
                    //         Age: 25,
                    //         City: "Los Angeles"
                    //     },
                    //     {
                    //         Name: "Bob",
                    //         Age: 35,
                    //         City: "Chicago"
                    //     }
                    // ];

                    var jsonData1 = await getDataFromServer().done(function(data) {
                            return data;
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            console.error('Error fetching data:', errorThrown);
                        });
                    var location = jsonData1.location;

                    // console.log(jsonData1)
                    // console.log(Object.keys(location[0]));
                    // return;

                    var headers = Object.keys(location[0]);

                    // Buat file Excel
                    var workbook = new ExcelJS.Workbook();
                    // Tambahkan sheet pertama
                    var sheet1 = workbook.addWorksheet('Location');
                    sheet1.addRow(headers);
                    location.forEach(function(row, ) {
                        var rowData = headers.map(function(header) {
                            return row[header];
                        });
                        sheet1.addRow(rowData);
                    });


                    // Tambahkan sheet kedua
                    // var sheet2 = workbook.addWorksheet('Inbound');
                    // sheet2.addRow(["Product", "Price", "Quantity"]);
                    // var jsonData2 = [{
                    //         Product: "Laptop",
                    //         Price: 1000,
                    //         Quantity: 5
                    //     },
                    //     {
                    //         Product: "Phone",
                    //         Price: 500,
                    //         Quantity: 10
                    //     },
                    //     {
                    //         Product: "Tablet",
                    //         Price: 300,
                    //         Quantity: 8
                    //     }
                    // ];
                    // jsonData2.forEach(function(row) {
                    //     sheet2.addRow([row.Product, row.Price, row.Quantity]);
                    // });

                    // Simpan file Excel
                    workbook.xlsx.writeBuffer().then(function(buffer) {
                        var blob = new Blob([buffer], {
                            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        });
                        var url = window.URL.createObjectURL(blob);
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'Transaction History.xlsx';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                    });
                }, 3000); // Ganti 3000 dengan durasi unduhan yang sesuai dengan kebutuhan Anda
            }
        });
    </script> -->
</body>

</html>