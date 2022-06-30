<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->checkTimeDeposit();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($data);

    if($data > 0){
        echo json_encode($data);
    }