<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->getBinanceUserHistory();
    
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = count($row);

    if($num > 0){
        echo json_encode($row);
    }

    // $sql = $stmt->rowCount();
    // if($sql > 0){
    //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    //         extract($row);
    //         $array[] = [
    //             "time" => $row["b_time"],
    //             "betamount" => $row["b_betAmount"],
    //             "trend" => ($row["b_Trend"] == '매수') ? '<span style="color: #ED5659;">매수</span>' : '<span style="color: #1072BA;">매도</span>',
    //             "result" => floatval($row["b_Result"])
    //         ];
    //     }
    //     echo json_encode( $array);
    // }