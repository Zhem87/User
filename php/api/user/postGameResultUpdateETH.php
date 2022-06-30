<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $userUpdate = $query->postGameResultUserETH();

    $rows = $userUpdate->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);


    if($num > 0)
        echo json_encode($rows);
