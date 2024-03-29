<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new User($db);
    $auth = new Authentication($db);
    $get_country_info = new Getcountryinfo($db);

    parse_str($_POST['formData'], $_POST);


    // $stmt = $cgdata->getBankNamePerId($rbankname);
    // $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

    $account_code = $_POST["s_account_code"];
    $nickname = $_POST["nickname"];
    $mobile_number = $_POST["mobile_number"];
    $account_holder = $_POST["account_holder"];
    $account_number = $_POST["account_number"];
    $bank_code = $_POST["bank_code"];
    $rec_point = $_POST["rec_point"];
    $full_consent = $_POST["chk1"];
    $term_cond1 = $_POST["chk2"];
    $term_cond2 = $_POST["chk3"];
    $domain = $_POST["domain"];
    $userip = $_POST["userip"];
    
    $password = $auth->encrypt_decrypt('encrypt', $_POST["s_password"]);



//  print ("$account_code $nickname $password $mobile_number $account_holder $account_number $bank_code $rec_point $rec_point $full_consent $term_cond1 $term_cond2 $domain $userip ");

    $array = array(
        "account_code" => $account_code,
        "nickname" => $nickname,
        "password" => $password,
        "mobile_number" => $mobile_number,
        "account_holder" => $account_holder,
        "account_number" => $account_number,
        "bank_code" => $bank_code,
        "rec_point" => $rec_point,
        "full_consent" => $full_consent,
        "term_cond1" => $term_cond1,
        "term_cond2" => $term_cond2,
        "ip_address" => $userip,
        "domain" => $domain,
        "entry_date" => date('Y-m-d h:i')
    );
    $register = $query->postRegistration($array);
    echo json_encode($register);