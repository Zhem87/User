<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $time = json_decode(file_get_contents("php://input"));
    $stmt = $query->getWssResultPerMin($time);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);

    if($num > 0){
        $res = $rows[0]["JsonDataResult"];
        echo json_encode($res);
    }else{
        http_response_code(404);
        echo json_encode('No Record Found.');
    }
