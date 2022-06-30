<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $auth = new Authentication($db);

    parse_str($_POST['formData'], $_POST);
    $password = $auth->encrypt_decrypt('encrypt', $_POST["s_password"]);

    $array = array(
        "password" => $password,
    );
    $change = $query->postChangePassword($array);
    echo json_encode($change);