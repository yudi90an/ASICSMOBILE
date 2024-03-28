<?php
 
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit;

}

require("koneksi.php");
// session_start();
// echo "test";
// exit;

// if (!isset($_SESSION['username'])) {
//     header("location:../../index.html");
// }

// echo "test";
// exit;


// if (!function_exists('json_decode')) {
//     function json_decode($content, $assoc = false)
//     {
//         require_once 'JSON.php';
//         if ($assoc) {
//             $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
//         } else {
//             $json = new Services_JSON;
//         }
//         return $json->decode($content);
//     }
// }

// if (!function_exists('json_encode')) {
//     function json_encode($content)
//     {
//         require_once 'JSON.php';
//         $json = new Services_JSON;
//         return $json->encode($content);
//     }
// }


$json_string = file_get_contents("php://input");
$array_data = json_decode($json_string, true);


if (isset($_POST['get_do'])) {

    // print_r($_POST);
    // exit;
     $do = $_POST["do"];
    // $location = $_GET['location'];

    // print_r($do);
    // exit;

    $flag = array();
    $sql = "select d.*,h.spk_date,h.order_date,h.driver_tlpn from order_h h
    JOIN order_d d on h.order_id=d.order_id where d.delivery_no='$do'  ";
    // if ($location != '') {
    //     $sql .= " AND b.loc_id LIKE '%$location%'";
    // }

    $query = $conn->query($sql);
    
    $no = 1;
    $row_data = array();
    while ($rows = $query->fetch_assoc()) {
        $row_data[] = $rows;
        // $row_data['order_id'] = $rows['order_id'];
        // $row_data['order_date'] = $rows['order_date'];
        // $row_data['Process Status'] = $rows['proses'];
        // $row_data['Trans Date'] = $rows['trans_date'];
        // $row_data['Item Code'] = $rows['item_code'];
        // $row_data['Prod Date'] = $rows['expire'];
        // $row_data['Qty'] = $rows['fl'];
        // array_push($flag, $row_data);
    }

    $response = array(
        'success' => true,
        'data' => $row_data
    );

    echo json_encode($response);
}
