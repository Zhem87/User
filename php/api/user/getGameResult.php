<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $unix = json_decode(file_get_contents("php://input"));
    $stmt = $query->getGameresult($unix);
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);

    if($num > 0){
        echo json_encode($rows);
    }
