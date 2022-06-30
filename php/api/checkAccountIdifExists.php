<?php
    
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);

    $account_code = json_decode(file_get_contents("php://input"));

    $stmt = $query->checkUserAccountId($account_code);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($rows);

    print $num;

    // if($num > 0){
    //     echo json_encode($rows);
    // }

    ?>