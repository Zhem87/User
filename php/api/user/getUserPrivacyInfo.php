<?php
    include_once 'includes.php';
    
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admin($db);
    $auth = new Authentication($db);

    $stmt = $query->getUserPrivacyInfo();

        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = $datas[0];
        $password = $auth->encrypt_decrypt('decrypt', $data["u_Password"]);

        $array = array(
            "Account_Id" => $data["u_Id"],
            "Account_Code" => $data["u_Account_Code"],
            "Nickname" => $data["u_Nickname"],
            "Password" => $password,
            "BankName" => $data["m_Bank_Name"],
            "Account_Number" => $data["u_Account_Number"],
            "Recommended_Point" => $data["u_Recommended_Point"],
            "Account_Holder" => $data["u_Bank_Holder_Name"]
        );
        echo json_encode($array);
?>

   
