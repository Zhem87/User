<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->updateRefresh($_GET["setMute"]);




