<?php
session_start();
// echo "test";
// exit;

if (!isset($_SESSION['username'])) {
    header("location:../../index.html");
}
include("../../function/WMSclass.php");
$dbo = new WMSClass();
$dbo->dbServer = $dbServer;
$dbo->dbUser = $dbUser;
$dbo->dbPass = $dbPass;
$dbo->dbName = $dbName;
$dbo->dbConnect();

// echo "test";
// exit;


if (!function_exists('json_decode')) {
    function json_decode($content, $assoc = false)
    {
        require_once 'JSON.php';
        if ($assoc) {
            $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        } else {
            $json = new Services_JSON;
        }
        return $json->decode($content);
    }
}

if (!function_exists('json_encode')) {
    function json_encode($content)
    {
        require_once 'JSON.php';
        $json = new Services_JSON;
        return $json->encode($content);
    }
}


$json_string = file_get_contents("php://input");
$array_data = json_decode($json_string, true);

if (isset($_POST['get_do'])) {

    // print_r($_POST);
    // exit;

    // $location = $_GET['location'];

    $flag = array();
    $sql = "select * from order_h";
    // if ($location != '') {
    //     $sql .= " AND b.loc_id LIKE '%$location%'";
    // }

    $query = mysql_query($sql);

    $no = 1;
    $row_data = array();
    while ($rows = mysql_fetch_assoc($query)) {
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
