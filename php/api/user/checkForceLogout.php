<?php


    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);

    if(@$_SESSION["user_session"]){
        $stmt = $query->checkUserForceLogout();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt1 = $query->checkMaintenance();
        $data1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        $stmt2 = $query->checkBTCMaintenance();
        $data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
        $inqs = $query->getInfoCntNote();
        $inq = $inqs->fetchAll(PDO::FETCH_ASSOC);
    
        $balance = $query->getUserCashBalance();
        $balances = $balance->fetchAll(PDO::FETCH_ASSOC);
    
        $note = $query->getNoteList();
        $notes = $note ->fetchAll(PDO::FETCH_ASSOC);

        $message = $query->checkNewMessage();
        $new = $message->fetchAll(PDO::FETCH_ASSOC);

        $sound = $query->checkSound();
        $sounds = $sound->fetchAll(PDO::FETCH_ASSOC);

        $game = $query->getUserAvailableGame();
        $games = $game->fetchAll(PDO::FETCH_ASSOC);


        $array = array(
            "noteCnt" => ($inq[0]["Cnt"] > 0) ? $inq[0]["Cnt"] : 0,
            "check" => $data,
            "checkMaintenance" => $data1,
            "checkBTCMaintenance" => $data2,
            "balance" => $balances,
            "note" => $notes,
            "sounds" => $sounds,
            "games" => $games,
            "messageCnt" => ($new[0]["CntChck"] > 0) ? $new[0]["CntChck"] : 0,
        );
    
        echo json_encode($array);
    }else{
        $stmt1 = $query->checkMaintenance();
        $data1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data1);
    }

   


    // $sql = $stmt->rowCount();
    // if($sql > 0){
    //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    //     if($data[0]['u_State'] == 3){
    //         echo '<script>window.location.href="./logout.php?code="+'.$data[0]['u_State'].'</script>';
    //     }
    // }else{
    //     $data[] = array("t_Amount_in_Total" => 0);
    //     echo json_encode($data);
    //     echo json_encode($inq);
    // }