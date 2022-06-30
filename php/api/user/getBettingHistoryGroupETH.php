<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->getBettingHistoryGroupETH();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);

    if($num > 0){
        echo json_encode($rows);
    }


