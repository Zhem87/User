<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    $results = json_decode(file_get_contents("php://input"));
    $userAmount = $query->postbettingTransaction($results);

    echo json_encode($userAmount);