<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/cities.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new City($db);
    $stmt = $items->getCities();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $cityArr = array();
        $cityArr["body"] = array();
        $cityArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "cityid" => $cityid,
                "cityname" => $cityname
                
            );
            array_push($cityArr["body"], $e);
        }
        echo json_encode($cityArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>