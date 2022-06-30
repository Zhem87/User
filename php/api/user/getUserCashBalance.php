<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->getUserCashBalance();

    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $num = count($rows);

    if($num > 0){
        echo json_encode($rows);
    }
    else{
        $data[] = array("t_Amount_in_Total" => 0);
        echo json_encode($rows);
    }

   