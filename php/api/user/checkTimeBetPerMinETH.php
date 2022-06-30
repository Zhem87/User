<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $timeunix = json_decode(file_get_contents("php://input"));
    $stmt = $query->checkTimeBetPerMinETH($timeunix[0]->time);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($data);

    if($data > 0){
        echo json_encode($data);
    }