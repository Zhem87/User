<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->getBinanceUserHistoryETH();
    
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($row);

    if($num > 0){
        echo json_encode($row);
    }
