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
    $data = json_decode(file_get_contents("php://input"));
    $item->customername = $data->customername;
    $item->customeremail = $data->customeremail;
    $item->contactNumber = $data->contactNumber;
    
    if($item->createCustomer()){
        echo 'Customer created successfully.';
    } else{
        echo 'Customer could not be created.';
    }
?>