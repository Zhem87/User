<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $unixtime = json_decode(file_get_contents("php://input"));
    $gameupdate = $query->getReservedResultPerMinuteETH($unixtime);
    $rows = $gameupdate->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);

    if($num > 0){
        echo json_encode($rows);
    }
    // $gameupdate = $query->getGameResservedMinUpdate($unixtime);