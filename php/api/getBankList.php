<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);
    $stmt = $query->getBankList();
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);

    if($num > 0){
        echo json_encode($rows);
    }


    // $sql = $stmt->rowCount();
    // if($sql > 0){
    //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     echo json_encode($data);
    // }