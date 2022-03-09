<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/theaters.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Theater($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getTheatersOfSingleMovie();
    echo print_r($item->getTheatersOfSingleMovie(),true);
    if($item->theatername != null){
        // create array
        $cust_arr = array(
            "moviename" =>  $item->moviename,
            "theatername" => $item->theatername
        );
      
        http_response_code(200);
        echo json_encode($cust_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("theater not found.");
    }
?>