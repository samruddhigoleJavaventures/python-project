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
    $data = json_decode(file_get_contents("php://input"));
    $item->theaterid = $data->theaterid;
    $item->theatername = $data->theatername;
    $item->cityid = $data->cityid;
    $item->movieid = $data->movieid;


    
    if($item->createtheater()){
        echo 'theater created successfully.';
    } else{
        echo 'theater could not be created.';
    }
?>