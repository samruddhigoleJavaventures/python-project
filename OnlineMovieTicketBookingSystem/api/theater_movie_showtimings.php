<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/showtimings.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Showtimings($db);
    $stmt = $items->getShowtimingsForMovie();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $showtimeArr = array();
        $showtimeArr["body"] = array();
        $showtimeArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                
                "starttime" => $starttime,
                "endtime" => $endtime,
                "moviename" => $moviename,
                "theaterid" => $theaterid
                
            );
            array_push($showtimeArr["body"], $e);
        }
        echo json_encode($showtimeArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>