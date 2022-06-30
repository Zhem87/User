<?php

    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);

    $nickname = json_decode(file_get_contents("php://input"));

    $stmt = $query->checkNicknameIfExists($nickname);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);
 
    print $num;


    // echo json_encode($stmt->rowCount());


