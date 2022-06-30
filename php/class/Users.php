<?php
    class User {
        // DB stuff
        private $conn;
        private $tbl_bit_users = "tbl_bit_users";
        private $tbl_bit_access = "tbl_bit_access";
        private $tbl_bit_trans_headers = "tbl_bit_transaction_headers";
        private $tbl_bit_bank = "tbl_bit_banklists";
        private $tbl_bit_user_log = "tbl_bit_user_logs";
        private $tbl_bit_user_log_header = "tbl_bit_user_log_headers";
        private $tbl_bit_Money_transaction = "tbl_bit_transaction_headers";
        private $tbl_bit_trans_history = "tbl_bit_transaction_histories";
        private $tbl_bit_sound = "tbl_bit_sounds";
        private $tbl_bit_note = "tbl_bit_notes";
        private $tbl_bit_code = "tbl_bit_code";
        private $tbl_bit_user = "tbl_bit_users";


        

        //properties  
		public function __construct($db){
			$this->conn = $db;
		}

        // check if account exists
        public function checkUserAccountId($acctcode){
            $query = "SELECT u_Account_Code FROM ".$this->tbl_bit_users. " WHERE u_Account_Code = '$acctcode'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function checkCodeIfExists($code){
            $query = "SELECT c_Code, c_Deleted_Date FROM ".$this->tbl_bit_code. " WHERE c_Code = '$code' AND c_Deleted_Date IS NULL";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        // check if nickname exists
        public function checkNicknameIfExists($nickname){
            $query = "SELECT * FROM ".$this->tbl_bit_users. " WHERE u_Nickname = '$nickname'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBankList(){
            $query = "SELECT m_BankId, m_Bank_Name FROM ".$this->tbl_bit_bank." ORDER BY m_BankId ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        //user registration
		public function postRegistration($arr){
			$query = "UPDATE tbl_bit_sounds SET s_TypeName = :Sound, s_TypeId = :soundStatus WHERE s_Notif_Type = :notifType ;
                        INSERT INTO ". $this->tbl_bit_users ." (u_Account_Code,u_Language,u_Nickname,u_Password,u_Mobile_Number,u_Bank_Holder_Name,u_Bank_Code,u_Account_Number,u_Recommended_Point,u_Ip_Address,u_Full_consent,u_Terms_Condition1,u_Terms_Condition2,u_Entry_Date,u_Access_Domain, u_Status_Id, u_Access_Code, u_UseNoUse, u_isAdminUser, u_State)
                         VALUES (:account_code,:language,:nickname,:password,:mobile_number,:account_holder,:bank_code,:account_number,:rec_point,:ip_address,:full_consent,:term_cond1,:term_cond2,:entry_date,:domain,:status_id,:access_code, :useNoUse, :is_admin_user, :state);
                          INSERT INTO ".$this->tbl_bit_Money_transaction." (t_Account_Code, t_Amount_in_Total, t_Currency, t_Entry_Date) VALUES (:header_code, :money, :currency, :entry_date_headers)";
                          
			$stmt = $this->conn->prepare($query);

			$account_code = $arr["account_code"];
            $language = 'kr';
            $nickname = $arr["nickname"];
            $password = $arr["password"];
            $mobile_number = $arr["mobile_number"];
            $account_holder = $arr["account_holder"];
            $bank_code = $arr['bank_code'];
            $account_number = $arr["account_number"];
            $rec_point = $arr["rec_point"];
            $ip_address = $arr["ip_address"];
            $full_consent = $arr["full_consent"];
            $term_cond1 = $arr["term_cond1"];
            $term_cond2 = $arr["term_cond2"];

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $entry_date = $s1->format('Y-m-d H:i:s');
            $entry_date_headers = $s1->format('Y-m-d H:i:s');

            $domain = $arr["domain"];
            $status_id = 0;
            $access_code = 1;
            $useNoUse = 1;
            $is_admin_user = 0;
            $state = 1;
            $header_code = $arr["account_code"];
            $money = 0;
            $currency = 'Won';
            $sound = 'on';
            $soundStatus = 1;
            $notifType = 'UserApplication';


            //  print ("$account_code $nickname $output $mobile_number $account_holder $bank_code $account_number $rec_point $ip_address $full_consent $term_cond1 $term_cond2 $domain $userip $entry_date");

            // u_Ip_Address

			$stmt->bindParam(":account_code", $account_code, PDO::PARAM_STR);
			$stmt->bindParam(":language", $language, PDO::PARAM_STR);
			$stmt->bindParam(":nickname", $nickname, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":mobile_number", $mobile_number, PDO::PARAM_STR);
			$stmt->bindParam(":account_holder", $account_holder, PDO::PARAM_STR);
			$stmt->bindParam(":bank_code", $bank_code, PDO::PARAM_STR);
			$stmt->bindParam(":account_number", $account_number, PDO::PARAM_STR);
			$stmt->bindParam(":rec_point", $rec_point, PDO::PARAM_STR);
			$stmt->bindParam(":ip_address", $ip_address, PDO::PARAM_STR);
			$stmt->bindParam(":full_consent", $full_consent, PDO::PARAM_STR);
			$stmt->bindParam(":term_cond1", $term_cond1, PDO::PARAM_STR);
			$stmt->bindParam(":term_cond2", $term_cond2, PDO::PARAM_STR);
			$stmt->bindParam(":entry_date", $entry_date, PDO::PARAM_STR);
			$stmt->bindParam(":domain", $domain, PDO::PARAM_STR);
            $stmt->bindParam(":status_id", $status_id, PDO::PARAM_STR);
            $stmt->bindParam(":access_code", $access_code, PDO::PARAM_STR);
            $stmt->bindParam(":useNoUse", $useNoUse, PDO::PARAM_STR);
            $stmt->bindParam(":is_admin_user", $is_admin_user, PDO::PARAM_STR);
            $stmt->bindParam(":state", $state, PDO::PARAM_STR);
            $stmt->bindParam(":header_code", $header_code, PDO::PARAM_STR);
            $stmt->bindParam(":money", $money, PDO::PARAM_STR);
            $stmt->bindParam(":currency", $currency, PDO::PARAM_STR);
            $stmt->bindParam(':Sound', $sound, PDO::PARAM_STR);
            $stmt->bindParam(':soundStatus', $soundStatus, PDO::PARAM_STR);
            $stmt->bindParam(':notifType', $notifType, PDO::PARAM_STR);
			$stmt->bindParam(":entry_date_headers", $entry_date_headers, PDO::PARAM_STR);



			if($stmt->execute()){
                return true;
            }
            return false;
		}

        public function login($account_code,$password){

            $query = "SELECT TOP 1
            tbl_bit_users.u_Account_Code,
            tbl_bit_users.u_Language,
            tbl_bit_users.u_Nickname,
            tbl_bit_users.u_Password,
            tbl_bit_users.u_Mobile_Number,
            tbl_bit_users.u_Ip_Address,
            tbl_bit_users.u_Bank_Holder_Name,
            tbl_bit_users.u_Recommended_Point,
            tbl_bit_users.u_Account_Number,
            tbl_bit_users.u_UseNoUse,
            tbl_bit_users.u_State,
            tbl_bit_users.u_isAdminUser,
            tbl_bit_users.u_Last_Login,
            tbl_bit_transaction_headers.t_Amount_in_Total,
            tbl_bit_transaction_headers.t_Currency
            FROM ".$this->tbl_bit_users."
            LEFT JOIN ".$this->tbl_bit_trans_headers." ON tbl_bit_users.u_Account_Code = tbl_bit_transaction_headers.t_Account_Code
            WHERE tbl_bit_users.u_Account_Code = '$account_code' AND tbl_bit_users.u_Language = 'kr' AND tbl_bit_users.u_Password = '$password'
            AND tbl_bit_users.u_Status_Id IN(1) AND tbl_bit_users.u_UseNoUse IN(1) AND tbl_bit_users.u_isAdminUser IN(0);
            UPDATE ".$this->tbl_bit_users." SET u_State = :usenoneuse, u_Last_Login = :last_login WHERE u_Account_Code = '$account_code'";

            $stmt = $this->conn->prepare($query);
            $usenoneuse = "1";

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $last_login = $s1->format('Y-m-d H:i:s');

            $stmt->bindParam(':usenoneuse', $usenoneuse, PDO::PARAM_STR);
            $stmt->bindParam(':last_login', $last_login, PDO::PARAM_STR);
            $stmt->execute();
            
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            $num = count($rows);

            if($rows['u_Account_Code'] == $account_code && $rows['u_Password'] == $password){
                $_SESSION['user_session'] = $rows;
                return true;
            }else{
                return false;
            }

        }

        public function userLogs($isType,$account_code,$get_ip){
            $query = "INSERT INTO ".$this->tbl_bit_user_log." (l_Account_Code,l_LogInDateTime,l_Current_Ip,l_Access_Domain,l_Device_Use,l_Browser_Use) VALUES (:AccountCode,:LogInDateTime,:CurrentIp,:AccessDomain,:DeviceUse,:BrowserUse)";
            $stmt = $this->conn->prepare($query);

            $code = $account_code;
            $device = $isType;

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $logindtime = $s1->format('Y-m-d H:i:s');

            $browser = 'Chrome';
            $domain = $_SERVER['SERVER_NAME'];
            $ip = $get_ip;

            $stmt->bindParam(':AccountCode', $code, PDO::PARAM_STR);
            $stmt->bindParam(':LogInDateTime', $logindtime, PDO::PARAM_STR);
            $stmt->bindParam(':CurrentIp', $ip, PDO::PARAM_STR);
            $stmt->bindParam(':AccessDomain', $domain, PDO::PARAM_STR);
            $stmt->bindParam(':DeviceUse', $device, PDO::PARAM_STR);
            $stmt->bindParam(':BrowserUse', $browser, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function destroyUserSession($code){

            $query = "UPDATE ".$this->tbl_bit_user_log." SET l_LogOutDateTime = :logoutdtime WHERE l_Account_Code = :code ;
             UPDATE ".$this->$tbl_bit_user." SET u_State = :state WHERE u_Account_Code = ".$_SESSION["user_session"]["u_Account_Code"]."";
            $stmt = $this->conn->prepare($query);

            $acode = $code;

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $logoutdtime = $s1->format('Y-m-d H:i:s');

            $state = 3;
            

            $stmt->bindParam(':code', $acode, PDO::PARAM_STR);
            $stmt->bindParam(':logoutdtime', $logoutdtime, PDO::PARAM_STR);
            $stmt->bindParam(':state', $state, PDO::PARAM_STR);

            $stmt->execute();
        }

        public function postDeposit($data){

            $query = "UPDATE tbl_bit_sounds SET s_TypeName = :Sound, s_TypeId = :soundStatus WHERE s_Notif_Type = :notifType ;
             INSERT INTO tbl_bit_transaction_histories 
             (h_Language,h_Transaction_Type, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance, h_Status) VALUES 
             (:Language,:Transaction_Type, :code, :Event, :Contract_Time, :Plus, :Minus, :Current_Balance,  :Status)";

            $stmt = $this->conn->prepare($query);

            $balance = $this->getUserCashBalance();

            $depamount = $data[0]->depositamount;
            $deptime = $data[0]->deposittime;

            $language = 'kr';
            $transtype = 'Deposit';
            $code = $_SESSION["user_session"]["u_Account_Code"];
            $event = '입금';
            $depamount = $data[0]->depositamount;
            $plus = $depamount;
            $minus = 0;
            $cbalance = $balance["t_Amount_in_Total"];
            $status = 0;
            $sound = 'on';
            $soundStatus = 1;
            $notifType = 'DepositApplication';

            $stmt->bindParam(':Language', $language, PDO::PARAM_STR);
            $stmt->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->bindParam(':Event', $event, PDO::PARAM_STR);
            $stmt->bindParam(':Contract_Time', $deptime, PDO::PARAM_STR);
            $stmt->bindParam(':Plus', $plus, PDO::PARAM_STR);
            $stmt->bindParam(':Minus', $minus, PDO::PARAM_STR);
            $stmt->bindParam(':Current_Balance', $cbalance, PDO::PARAM_STR);
            $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':Sound', $sound, PDO::PARAM_STR);
            $stmt->bindParam(':soundStatus', $soundStatus, PDO::PARAM_STR);
            $stmt->bindParam(':notifType', $notifType, PDO::PARAM_STR);

            // print ("$sound $soundStatus $notifType ");
   
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function checkTimeDeposit(){
            $query = "SELECT TOP 1 h_Contract_Time FROM tbl_bit_transaction_histories WHERE h_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' ORDER BY h_Contract_Time DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }

        public function postNoteUpdate($get){

            $query = "UPDATE ".$this->tbl_bit_note." 
            SET e_State = :State, e_Updated_Time = :Date WHERE e_Id = :Id";

            $stmt = $this->conn->prepare($query);

            $id = $get["id"];
            $state = 1;

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $time = $s1->format('Y-m-d H:i:s');

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':State', $state, PDO::PARAM_STR);
            $stmt->bindParam(':Date', $time, PDO::PARAM_STR);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function getUserCashBalance(){
            $query = "SELECT TOP 1 * FROM ".$this->tbl_bit_trans_headers." WHERE t_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        public function postWithdraw($data){
            $query = "UPDATE tbl_bit_transaction_headers SET t_Amount_in_Total = :Remaining_Balance WHERE t_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' ; 
            UPDATE ".$this->tbl_bit_sound." SET s_TypeName = :Sound, s_TypeId = :soundStatus WHERE s_Notif_Type = :notifType ;
            INSERT INTO tbl_bit_transaction_histories 
            (h_Language,h_Transaction_Type, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance,h_Processing_Time, h_Status) VALUES 
            (:Language,:Transaction_Type, :code, :Event, :Contract_Time, :Plus, :Minus, :Current_Balance, :Processing_Time, :Status)";
           $stmt = $this->conn->prepare($query);

           $balance = $this->getUserCashBalance();

           $withamount = $data[0]->withdrawtamount;
           $withtime = $data[0]->withdrawtime;

           $language = 'kr';
           $transtype = 'Withdraw';
           $code = $_SESSION["user_session"]["u_Account_Code"];
           $event = '출금';

           $t1 = date_default_timezone_get();
           $s1 = new DateTime($t1);
           $ctime = $s1->format('Y-m-d H:i:s');
           $ptime = $s1->format('Y-m-d H:i:s');

           $plus = 0;
           $minus = $withamount;
           $cbalance = $balance["t_Amount_in_Total"] - $withamount;
           $rem_balance = $cbalance;
           $status = 0;
           $sound = 'on';
           $soundStatus = 1;
           $notifType = 'WithdrawApplication';

           // print ("$cbalance $transtype $code $ctime $plus $minus $processingTime $status $sound $soundStatus $notifType");


           $stmt->bindParam(':Language', $language, PDO::PARAM_STR);
           $stmt->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
           $stmt->bindParam(':code', $code, PDO::PARAM_STR);
           $stmt->bindParam(':Event', $event, PDO::PARAM_STR);
           $stmt->bindParam(':Contract_Time', $withtime, PDO::PARAM_STR);
           $stmt->bindParam(':Plus', $plus, PDO::PARAM_STR);
           $stmt->bindParam(':Minus', $minus, PDO::PARAM_STR);
           $stmt->bindParam(':Current_Balance', $cbalance, PDO::PARAM_STR);
           $stmt->bindParam(':Processing_Time', $ptime, PDO::PARAM_STR);
           $stmt->bindParam(':Remaining_Balance', $rem_balance, PDO::PARAM_STR);
           $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
           $stmt->bindParam(':Sound', $sound, PDO::PARAM_STR);
           $stmt->bindParam(':soundStatus', $soundStatus, PDO::PARAM_STR);
           $stmt->bindParam(':notifType', $notifType, PDO::PARAM_STR);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
		
		 // Check if the user is already logged in
         public function is_logged_in() {
            if (isset($_SESSION['user_session'])) {
                return true;
            }
        }
    
        // Redirect user
        public function redirect($url) {
            ob_start();
            header("Location: $url");
            exit;
        }
    }