<?php

    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);

    $code = json_decode(file_get_contents("php://input"));

    $stmt = $query->checkCodeIfExists($code);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);

    print $num;


    ?>
