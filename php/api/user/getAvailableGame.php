<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->getUserAvailableGame();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $num = count($data);

    if($num > 0){
        echo json_encode($data);
    }else{
        $data[] = array("t_Amount_in_Total" => 0);
        echo json_encode($data);
    }