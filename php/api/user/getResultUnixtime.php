<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $unix = json_decode(file_get_contents("php://input"));
    $stmt = $query->getResultUnixtime($unix);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $sql = count($data);

    if($sql > 0){
        echo json_encode($data);
    }else{
        echo json_encode(0);
    }