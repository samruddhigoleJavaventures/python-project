<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/customers.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Customers($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleCustomer();
    if($item->customername != null){
        // create array
        $cust_arr = array(
            "customerid" =>  $item->customerid,
            "customername" => $item->customername,
            "customeremail" => $item->customeremail,
            "contactNumber" => $item->contactNumber
        );
      
        http_response_code(200);
        echo json_encode($cust_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Customer not found.");
    }
?>