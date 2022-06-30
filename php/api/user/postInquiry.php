<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    parse_str($_POST['formData'], $_POST);

    $stmt = $query->postInquiry($_POST);
    echo json_encode($stmt);



