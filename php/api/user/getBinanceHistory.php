<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $stmt = $query->getBinanceHistory();

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
    //             "time" => floatval($row["r_Time_Unix"]),
    //             "open" => $row["r_Open"],
    //             "result" => ($row["r_Game_Result"] == '매도') ? '<span style="color: #1072BA;">매도</span>' : '<span style="color: #ED5659;">매수</span>',
    //             "status" => $row["r_StatusId"]
    //         ];
    //     }
    //     echo json_encode( $array);
    // }