<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/cities.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new City($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleCity();
    if($item->cityname != null){
        // create array
        $cust_arr = array(
            "cityid" =>  $item->cityid,
            "cityname" => $item->cityname
        );
      
        http_response_code(200);
        echo json_encode($cust_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("City not found.");
    }
?>