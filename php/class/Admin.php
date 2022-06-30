<?php
    class Admin {
        // DB stuff
        private $conn;
        private $tbl_bit_api = "tbl_bi_apis";
        private $tbl_bit_users = "tbl_bit_users";
        private $tbl_bit_bank = "tbl_bit_banklists";
        private $tbl_bit_betting = "tbl_bit_betting_details";
        private $tbl_bit_wss_result = "tbl_bit_wss_results";
        private $tbl_bit_wss = "tbl_bit_wss";
        private $tbl_bit_wss_tmp = "tbl_bit_wss_tmp";
        private $tbl_bit_transaction_header = "tbl_bit_transaction_headers";
        private $tbl_bit_game_type = "tbl_bit_game_types";
        private $tbl_bit_reserved_result = "tbl_bit_reserved_results";
        private $tbl_bit_inquiry = "tbl_bit_inquiries";
        private $tbl_bit_sound = "tbl_bit_sounds";
        private $tbl_bit_note = "tbl_bit_notes";
        
        
        //properties  
		public function __construct($db){
			$this->conn = $db;
		}

        //select query
        public function selectBettingAmount($unixtime){
            $query = "SELECT * FROM ".$this->tbl_bit_betting." WHERE b_time = '".$unixtime."' AND b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        public function selectCurrentBalance($code){
            $query = "SELECT * FROM ".$this->tbl_bit_transaction_header." WHERE t_Account_Code = '".$code."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_balance = $user["t_Amount_in_Total"];
            return $user_balance;
        }

        public function selectCurrentResult($time){
            $query = "SELECT * FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '".$time."' AND r_Game_Type = 'BTC'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_balance = $user["r_Game_Result"];
            return $user_balance;
        }

        public function selectCurrentResultETH($time){
            $query = "SELECT * FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '".$time."' AND r_Game_Type = 'ETH'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_balance = $user["r_Game_Result"];
            return $user_balance;
        }

        public function getBinanceApiData($sort,$limit){
            $query = "SELECT * FROM (SELECT * FROM ".$this->tbl_bit_api." ORDER BY a_Id $sort LIMIT $limit) AS sub ORDER BY a_Id"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

         //post function
        public function postGameResultUser(){
            $query = "SELECT b_Trend AS BGameResult, b_time, b_betAmount, b_Total_BetAmount, b_UpdatedDate, b_Account_Code
            FROM ".$this->tbl_bit_betting." WHERE tbl_bit_betting_details.b_Status IN(0) AND b_Game_Type = 'BTCUSDT'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function postGameResultUserETH(){
            $query = "SELECT b_Trend AS BGameResult, b_time, b_betAmount, b_Total_BetAmount, b_UpdatedDate, b_Account_Code
            FROM ".$this->tbl_bit_betting." WHERE tbl_bit_betting_details.b_Status IN(0) AND b_Game_Type = 'ETHUSDT'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getTotalBinanceHistoryGroup(){
            $query = "SELECT * FROM ".$this->tbl_bit_wss_result." WHERE r_Game_Type = 'BTC' AND r_Deleted_Date IS NULL ORDER BY r_Id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getTotalBinanceHistoryGroupETH(){
            $query = "SELECT * FROM ".$this->tbl_bit_wss_result." WHERE r_Game_Type = 'ETH' AND r_Deleted_Date IS NULL ORDER BY r_Id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function postbettingTransaction($arr){

            $query = "UPDATE ".$this->tbl_bit_betting." SET b_Result = :status, b_Status = :status1 WHERE b_time = :time 
            AND b_Account_Code = :code1 AND b_Game_Type = 'BTCUSDT';
            UPDATE ".$this->tbl_bit_transaction_header." SET t_Amount_in_Total = :totalMoney  WHERE t_Account_Code = :code";

            $stmt = $this->conn->prepare($query);

            $cur_balance = $this->selectCurrentBalance($arr->code);
            $cur_result = $this->selectCurrentResult($arr->mytimeunix);

            print $cur_result;

            //betting
            $code = $arr->code;
            $code1 = $arr->code;
            $date = $arr->date;
            $t = $arr->mytimeunix;
            $w = $cur_result;
            $b = $arr->BetResult;
            $bet = $arr->bet;
            $totalBet = $arr->totalBet;
            $totalMoney;
            $status1 = 1;
            $win = 0;

            if($w == $b){
                $s = 1;
                $totalMoney = $cur_balance + $totalBet;
                $win = $totalMoney - $cur_balance;
            }else if($w == '무효'){
                $s = 3;
                $totalMoney = $cur_balance + $bet;
                $win =  $totalMoney - $cur_balance;
            }else{
                $s = 2;
                $totalMoney = $cur_balance;
            }

            
            if($s == 1 || $s == 3){

                $query1 = "INSERT INTO tbl_bit_transaction_histories 
                (h_Transaction_Type, h_Language, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance, h_Processing_Time, h_Status) VALUES 
                (:Transaction_Type, :Language, :code, :e, :Contract_Time, :Plus, :Minus, :Current_Balance, :Process_Time, :S)";

                $stmt1 = $this->conn->prepare($query1);

                $transtype = 'BTC';
                $language = 'kr';
                
                $code = $code1;
                $event = '-';

                $t1 = date_default_timezone_get();
                $s1 = new DateTime($t1);
                $htime = $s1->format('Y-m-d H:i:s');
                $processingTime = $date;

                $plus = $win;
                $minus = 0;
                $cbalance = $totalMoney;
                $status1 = 1;

                $stmt1->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
                $stmt1->bindParam(':Language', $language, PDO::PARAM_STR);
                $stmt1->bindParam(':code', $code, PDO::PARAM_STR);
                $stmt1->bindParam(':e', $event, PDO::PARAM_STR);
                $stmt1->bindParam(':Contract_Time', $htime, PDO::PARAM_STR);
                $stmt1->bindParam(':Plus', $plus, PDO::PARAM_STR);
                $stmt1->bindParam(':Minus', $minus, PDO::PARAM_STR);
                $stmt1->bindParam(':Current_Balance', $cbalance, PDO::PARAM_STR);
                $stmt1->bindParam(':Process_Time', $processingTime, PDO::PARAM_STR);
                $stmt1->bindParam(':S', $status1, PDO::PARAM_STR);
                
                $stmt1->execute();

            }

            $stmt->bindParam(':totalMoney', $totalMoney, PDO::PARAM_STR);
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->bindParam(':code1', $code1, PDO::PARAM_STR);
            $stmt->bindParam(':time', $t, PDO::PARAM_STR);
            $stmt->bindParam(':status', $s, PDO::PARAM_INT);
            $stmt->bindParam(':status1', $status1, PDO::PARAM_INT);
            
            if($stmt->execute()){
                return true;
            }
            return false;
            
            
        }

        public function postbettingTransactionETH($arr){

            $query = "UPDATE ".$this->tbl_bit_betting." SET b_Result = :status, b_Status = :status1 WHERE b_time = :time 
            AND b_Account_Code = :code1 AND b_Game_Type = 'ETHUSDT';
            UPDATE ".$this->tbl_bit_transaction_header." SET t_Amount_in_Total = :totalMoney  WHERE t_Account_Code = :code";

            $stmt = $this->conn->prepare($query);

            $cur_balance = $this->selectCurrentBalance($arr->code);
            $cur_result = $this->selectCurrentResultETH($arr->mytimeunix);

            print $cur_result;

            //betting
            $code = $arr->code;
            $code1 = $arr->code;
            $date = $arr->date;
            $t = $arr->mytimeunix;
            $w = $cur_result;
            $b = $arr->BetResult;
            $bet = $arr->bet;
            $totalBet = $arr->totalBet;
            $totalMoney;
            $status1 = 1;
            $win = 0;

            if($w == $b){
                $s = 1;
                $totalMoney = $cur_balance + $totalBet;
                $win = $totalMoney - $cur_balance;
            }else if($w == '무효'){
                $s = 3;
                $totalMoney = $cur_balance + $bet;
                $win =  $totalMoney - $cur_balance;
            }else{
                $s = 2;
                $totalMoney = $cur_balance;
            }

            
            if($s == 1 || $s == 3){

                $query1 = "INSERT INTO tbl_bit_transaction_histories 
                (h_Transaction_Type, h_Language, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance, h_Processing_Time, h_Status) VALUES 
                (:Transaction_Type, :Language, :code, :e, :Contract_Time, :Plus, :Minus, :Current_Balance, :Process_Time, :S)";

                $stmt1 = $this->conn->prepare($query1);

                $transtype = 'ETH';
                $language = 'kr';
                
                $code = $code1;
                $event = '-';

                $t1 = date_default_timezone_get();
                $s1 = new DateTime($t1);
                $htime = $s1->format('Y-m-d H:i:s');
                $processingTime = $date;

                $plus = $win;
                $minus = 0;
                $cbalance = $totalMoney;
                $status1 = 1;

                $stmt1->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
                $stmt1->bindParam(':Language', $language, PDO::PARAM_STR);
                $stmt1->bindParam(':code', $code, PDO::PARAM_STR);
                $stmt1->bindParam(':e', $event, PDO::PARAM_STR);
                $stmt1->bindParam(':Contract_Time', $htime, PDO::PARAM_STR);
                $stmt1->bindParam(':Plus', $plus, PDO::PARAM_STR);
                $stmt1->bindParam(':Minus', $minus, PDO::PARAM_STR);
                $stmt1->bindParam(':Current_Balance', $cbalance, PDO::PARAM_STR);
                $stmt1->bindParam(':Process_Time', $processingTime, PDO::PARAM_STR);
                $stmt1->bindParam(':S', $status1, PDO::PARAM_STR);
                
                $stmt1->execute();

            }

            $stmt->bindParam(':totalMoney', $totalMoney, PDO::PARAM_STR);
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->bindParam(':code1', $code1, PDO::PARAM_STR);
            $stmt->bindParam(':time', $t, PDO::PARAM_STR);
            $stmt->bindParam(':status', $s, PDO::PARAM_INT);
            $stmt->bindParam(':status1', $status1, PDO::PARAM_INT);
            
            if($stmt->execute()){
                return true;
            }
            return false;
            
        }

        public function postHistoryGroupUpdate($arr){

            $query = "UPDATE ".$this->tbl_bit_wss_result." SET r_Deleted_Date = :date WHERE r_Id = :id ";
            $stmt = $this->conn->prepare($query);

            $id = $arr->r_Id;

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $time = $s1->format('Y-m-d H:i:s');

            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':date', $time, PDO::PARAM_STR);
           

            if($stmt->execute()){
                return true;
            }
            return false;
            
            
        }

        public function postHistoryGroupUpdateETH($arr){

            $query = "UPDATE ".$this->tbl_bit_wss_result." SET r_Deleted_Date = :date WHERE r_Id = :id ";
            $stmt = $this->conn->prepare($query);

            $id = $arr->r_Id;

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $time = $s1->format('Y-m-d H:i:s');
           
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':date', $time, PDO::PARAM_STR);
           

            if($stmt->execute()){
                return true;
            }
            return false;
            
            
        }

        public function postPurchaserequest($arr){


            $query = "INSERT INTO ".$this->tbl_bit_betting." 
            (b_Account_Code,b_Language,b_Game_Type,b_time,b_betAmount,b_Total_BetAmount,b_MultiplyBy,b_Trend, b_Result, b_Status) VALUES 
            (:Account_Code,:Language,:GameType,:CurrentTime,:betAmount,:Total_BetAmount,:MultiplyBy,:Trend, :Result, :Status);
            UPDATE ".$this->tbl_bit_transaction_header." SET t_Amount_in_Total = :total_balance 
            WHERE t_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);


            $cur_balance = $this->selectCurrentBalance($_SESSION["user_session"]["u_Account_Code"]);

            $accountcode = $_SESSION["user_session"]["u_Account_Code"];
            $language = 'kr';
            $time = $arr->time;
            $betamount = $arr->betAmount;
            $dbalance = $cur_balance - $arr->betAmount;
            $totalbetAmount = round($arr->totalBetAmount);
            $multiplyby = $arr->multiplyby;
            $trend = ($arr->trend == 1) ? '매수' : '매도';
            $result = 0;
            $status = 0;
            $gametype = 'BTCUSDT';

            $stmt->bindParam(':Account_Code', $accountcode, PDO::PARAM_STR);
            $stmt->bindParam(':Language', $language, PDO::PARAM_STR);
            $stmt->bindParam(':CurrentTime', $time, PDO::PARAM_STR);
            $stmt->bindParam(':betAmount', $betamount, PDO::PARAM_STR);
            $stmt->bindParam(':Total_BetAmount', $totalbetAmount, PDO::PARAM_STR);
            $stmt->bindParam(':MultiplyBy', $multiplyby, PDO::PARAM_STR);
            $stmt->bindParam(':Trend', $trend, PDO::PARAM_STR);
            $stmt->bindParam(':Result', $result, PDO::PARAM_STR);
            $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':GameType', $gametype, PDO::PARAM_STR);
            $stmt->bindParam(':total_balance', $dbalance, PDO::PARAM_STR);



            $query1 = "INSERT INTO tbl_bit_transaction_histories 
             (h_Transaction_Type, h_Language, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance, h_Processing_Time, h_Status) VALUES 
             (:Transaction_Type, :h_Language, :code, :event1, :Contract_Time, :Plus, :Minus, :Current_Balance, :Process_Time, :Status1)";
            $stmt1 = $this->conn->prepare($query1);

            // $transtype = ($arr->trend == 1) ? 'Buy' : 'Sell';
            $transtype = 'BTC';
            $h_language = 'kr';
            $code = $_SESSION["user_session"]["u_Account_Code"];
            $event = ($arr->trend == 1) ? '매수' : '매도';

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $htime = $s1->format('Y-m-d H:i:s');
            $processingTime = $s1->format('Y-m-d H:i:s');

            $plus = 0;
            $minus = $arr->betAmount;
            $cbalance = $cur_balance - $arr->betAmount;
            $status1 = 1;

            $stmt1->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
            $stmt1->bindParam(':h_Language', $h_language, PDO::PARAM_STR);
            $stmt1->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt1->bindParam(':event1', $event, PDO::PARAM_STR);
            $stmt1->bindParam(':Contract_Time', $htime, PDO::PARAM_STR);
            $stmt1->bindParam(':Plus', $plus, PDO::PARAM_STR);
            $stmt1->bindParam(':Minus', $minus, PDO::PARAM_STR);
            $stmt1->bindParam(':Current_Balance', $cbalance, PDO::PARAM_STR);
            $stmt1->bindParam(':Process_Time', $processingTime, PDO::PARAM_STR);
            $stmt1->bindParam(':Status1', $status1, PDO::PARAM_STR);
            

            if($stmt->execute() && $stmt1->execute()){
                return true;
            }
            return false;

        }

        public function postPurchaserequestETH($arr){
            $query = "INSERT INTO ".$this->tbl_bit_betting." 
            (b_Account_Code,b_Language,b_Game_Type,b_time,b_betAmount,b_Total_BetAmount,b_MultiplyBy,b_Trend, b_Result, b_Status) VALUES 
            (:Account_Code,:Language,:GameType,:CurrentTime,:betAmount,:Total_BetAmount,:MultiplyBy,:Trend, :Result, :Status);
            UPDATE ".$this->tbl_bit_transaction_header." SET t_Amount_in_Total = :total_balance 
            WHERE t_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);


            $cur_balance = $this->selectCurrentBalance($_SESSION["user_session"]["u_Account_Code"]);

            $accountcode = $_SESSION["user_session"]["u_Account_Code"];
            $language = 'kr';
            $time = $arr->time;
            $betamount = $arr->betAmount;
            $dbalance = $cur_balance - $arr->betAmount;
            $totalbetAmount = round($arr->totalBetAmount);
            $multiplyby = $arr->multiplyby;
            $trend = ($arr->trend == 1) ? '매수' : '매도';
            $result = 0;
            $status = 0;
            $gametype = 'ETHUSDT';

            $stmt->bindParam(':Account_Code', $accountcode, PDO::PARAM_STR);
            $stmt->bindParam(':Language', $language, PDO::PARAM_STR);
            $stmt->bindParam(':CurrentTime', $time, PDO::PARAM_STR);
            $stmt->bindParam(':betAmount', $betamount, PDO::PARAM_STR);
            $stmt->bindParam(':Total_BetAmount', $totalbetAmount, PDO::PARAM_STR);
            $stmt->bindParam(':MultiplyBy', $multiplyby, PDO::PARAM_STR);
            $stmt->bindParam(':Trend', $trend, PDO::PARAM_STR);
            $stmt->bindParam(':Result', $result, PDO::PARAM_STR);
            $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':GameType', $gametype, PDO::PARAM_STR);
            $stmt->bindParam(':total_balance', $dbalance, PDO::PARAM_STR);



            $query1 = "INSERT INTO tbl_bit_transaction_histories 
             (h_Transaction_Type, h_Language, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance, h_Processing_Time, h_Status) VALUES 
             (:Transaction_Type, :h_Language, :code, :event1, :Contract_Time, :Plus, :Minus, :Current_Balance, :Process_Time, :Status1)";
            $stmt1 = $this->conn->prepare($query1);

            // $transtype = ($arr->trend == 1) ? 'Buy' : 'Sell';
            $transtype = 'ETH';
            $h_language = 'kr';
            $code = $_SESSION["user_session"]["u_Account_Code"];
            $event = ($arr->trend == 1) ? '매수' : '매도';

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $htime = $s1->format('Y-m-d H:i:s');
            $processingTime = $s1->format('Y-m-d H:i:s');

            $plus = 0;
            $minus = $arr->betAmount;
            $cbalance = $cur_balance - $arr->betAmount;
            $status1 = 1;

            $stmt1->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
            $stmt1->bindParam(':h_Language', $h_language, PDO::PARAM_STR);
            $stmt1->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt1->bindParam(':event1', $event, PDO::PARAM_STR);
            $stmt1->bindParam(':Contract_Time', $htime, PDO::PARAM_STR);
            $stmt1->bindParam(':Plus', $plus, PDO::PARAM_STR);
            $stmt1->bindParam(':Minus', $minus, PDO::PARAM_STR);
            $stmt1->bindParam(':Current_Balance', $cbalance, PDO::PARAM_STR);
            $stmt1->bindParam(':Process_Time', $processingTime, PDO::PARAM_STR);
            $stmt1->bindParam(':Status1', $status1, PDO::PARAM_STR);
            

            if($stmt->execute() && $stmt1->execute()){
                return true;
            }
            return false;

        }

        public function postWsskline($result){
            $queryTime = $result[0]->time;
            $query1 = "SELECT w_Transaction_Id, w_Time_Min_Unix, w_Time_Kor, w_Current_Price FROM tbl_bit_wss_tmp 
            WHERE w_Time_Min_Unix = '".$queryTime."' AND w_Game_Type = 'BTC' ORDER BY w_Transaction_Id ASC"; 

            $query = "INSERT INTO ".$this->tbl_bit_wss_result." 
            (r_Game_Type,r_Time_Unix, r_Time_Datetime, r_Price_Result, r_Game_Result, r_Open, r_High, r_Low, r_Close, r_StatusId, JsonDataResult  ) VALUES 
            (:Game_Type, :Time_Unix, :Time_Datetime, :Price_Result, :Game_Result, :Open, :High, :Low, :Close,  :Status, :Json)";

            $stmt = $this->conn->prepare($query);

            $time = $result[0]->time;
            $time_kr = $result[0]->time_kr;
            $open = $result[0]->open;
            $high = $result[0]->high;
            $low = $result[0]->low;
            $close = $result[0]->close;
            $gametype = $result[0]->gType;
            $reserve = $result[0]->reserved;
            $rs = $this->getWssdata($query1,$open,$close,$reserve);
            $s = 1;
            $json = json_encode($rs);
            $wss_trade = json_decode($json, true);
            ($close == 0 ) ? $gr = '무효' : $gr = ($rs["lastresult"]["w_Current_Price"] >= $open) ? '매수' : '매도';
            $pr = $rs["lastresult"]["w_Current_Price"];

            $stmt->bindParam(':Time_Unix', $time, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Datetime', $time_kr, PDO::PARAM_STR);
            $stmt->bindParam(':Open', $open, PDO::PARAM_STR);
            $stmt->bindParam(':High', $high, PDO::PARAM_STR);
            $stmt->bindParam(':Low', $low, PDO::PARAM_STR);
            $stmt->bindParam(':Close', $close, PDO::PARAM_STR);
            $stmt->bindParam(':Json', $json, PDO::PARAM_STR);
            $stmt->bindParam(':Price_Result', $pr, PDO::PARAM_STR);
            $stmt->bindParam(':Game_Result', $gr, PDO::PARAM_STR);
            $stmt->bindParam(':Game_Type', $gametype, PDO::PARAM_STR);
            $stmt->bindParam(':Status', $s, PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postWssklineETH($result){
            $queryTime = $result[0]->time;

            $query1 = "SELECT w_Transaction_Id, w_Time_Min_Unix, w_Time_Kor, w_Current_Price FROM tbl_bit_wss_tmp 
            WHERE w_Time_Min_Unix = '".$queryTime."' AND w_Game_Type = 'ETH' ORDER BY w_Transaction_Id ASC"; 

            $query = "INSERT INTO ".$this->tbl_bit_wss_result." 
            (r_Game_Type,r_Time_Unix, r_Time_Datetime, r_Price_Result, r_Game_Result, r_Open, r_High, r_Low, r_Close, r_StatusId, JsonDataResult  ) VALUES 
            (:Game_Type, :Time_Unix, :Time_Datetime, :Price_Result, :Game_Result, :Open, :High, :Low, :Close,  :Status, :Json)";

            $stmt = $this->conn->prepare($query);

            $time = $result[0]->time;
            $time_kr = $result[0]->time_kr;
            $open = $result[0]->open;
            $high = $result[0]->high;
            $low = $result[0]->low;
            $close = $result[0]->close;
            $gametype = $result[0]->gType;
            $reserve = $result[0]->reserved;
            $rs = $this->getWssdataETH($query1,$open,$close,$reserve);
            $s = 1;
            $json = json_encode($rs);
            $wss_trade = json_decode($json, true);
            ($close == 0 ) ? $gr = '무효' : $gr = ($rs["lastresult"]["w_Current_Price"] >= $open) ? '매수' : '매도';
            $pr = $rs["lastresult"]["w_Current_Price"];

            $stmt->bindParam(':Time_Unix', $time, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Datetime', $time_kr, PDO::PARAM_STR);
            $stmt->bindParam(':Open', $open, PDO::PARAM_STR);
            $stmt->bindParam(':High', $high, PDO::PARAM_STR);
            $stmt->bindParam(':Low', $low, PDO::PARAM_STR);
            $stmt->bindParam(':Close', $close, PDO::PARAM_STR);
            $stmt->bindParam(':Json', $json, PDO::PARAM_STR);
            $stmt->bindParam(':Price_Result', $pr, PDO::PARAM_STR);
            $stmt->bindParam(':Game_Result', $gr, PDO::PARAM_STR);
            $stmt->bindParam(':Game_Type', $gametype, PDO::PARAM_STR);
            $stmt->bindParam(':Status', $s, PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function getWssdata($query,$openPrice,$close,$r){
            $isStop = false;
            $openprice_ex = explode('.', $openPrice);
            $decimal = explode('.', number_format($openPrice, 2))[1];

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num = count($data);
            
            $resultArr = array();

            $max = $openPrice + 1;
            $min = $openPrice - 1;

            
            foreach($data as $key => $res){

                if(!$isStop){
                    if($data[$key] == $data[0]){
                        $resultArr[] = array(
                            "w_Transaction_Id" => $res["w_Transaction_Id"],
                            "w_Time_Min_Unix" => $res["w_Time_Min_Unix"],
                            "w_Time_Kor" => $res["w_Time_Kor"],
                            "w_Current_Price" => $openPrice
                        );
                    }else{
                        if($res["w_Current_Price"] < $max  && $res["w_Current_Price"] > $min){
                            $resultArr[] = array(
                                "w_Transaction_Id" => $res["w_Transaction_Id"],
                                "w_Time_Min_Unix" => $res["w_Time_Min_Unix"],
                                "w_Time_Kor" => $res["w_Time_Kor"],
                                "w_Current_Price" => $res["w_Current_Price"]
                            );
                        }
                        else{
                            $isStop = true;
                            $resultArr[] = array(
                                "w_Transaction_Id" => $res["w_Transaction_Id"],
                                "w_Time_Min_Unix" => $res["w_Time_Min_Unix"],
                                "w_Time_Kor" => $res["w_Time_Kor"],
                                "w_Current_Price" => $res["w_Current_Price"]
                            );
                        }
                        
                    }
                }
            }
            
            $fresult = end($resultArr);
            
            if($r == '매수' || $r == '매도'){
                $newfresult = array(
                    "w_Transaction_Id" => $fresult["w_Transaction_Id"],
                    "w_Time_Min_Unix" => $fresult["w_Time_Min_Unix"],
                    "w_Time_Kor" => $fresult["w_Time_Kor"],
                    "w_Current_Price" => ($r == '매수') ? $openprice_ex[0] + rand(1,2) . '.' . rand($decimal,99) : $openprice_ex[0] - rand(1,2) . '.' . rand(00,$decimal)
                );
            }else{
                $newfresult = array(
                    "w_Transaction_Id" => $fresult["w_Transaction_Id"],
                    "w_Time_Min_Unix" => $fresult["w_Time_Min_Unix"],
                    "w_Time_Kor" => $fresult["w_Time_Kor"],
                    "w_Current_Price" => $fresult["w_Current_Price"]
                );
            }
            
            
            $newarr = array(
                "result" => array_slice($resultArr, 0, count($resultArr)-1, true),
                "lastresult" => $newfresult
            );
            return $newarr;
        }

        public function getWssdataETH($query,$openPrice,$close,$r){
            $isStop = false;

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num = count($data);
            
            $resultArr = array();

            $max = $openPrice + 0.2;
            $min = $openPrice - 0.2;

            foreach($data as $key => $res){

                if(!$isStop){
                    if($data[$key] == $data[0]){
                        $resultArr[] = array(
                            "w_Transaction_Id" => $res["w_Transaction_Id"],
                            "w_Time_Min_Unix" => $res["w_Time_Min_Unix"],
                            "w_Time_Kor" => $res["w_Time_Kor"],
                            "w_Current_Price" => $openPrice
                        );
                    }else{
                        if($res["w_Current_Price"] < $max  && $res["w_Current_Price"] > $min){
                            $resultArr[] = array(
                                "w_Transaction_Id" => $res["w_Transaction_Id"],
                                "w_Time_Min_Unix" => $res["w_Time_Min_Unix"],
                                "w_Time_Kor" => $res["w_Time_Kor"],
                                "w_Current_Price" => $res["w_Current_Price"]
                            );
                        }
                        else{
                            $isStop = true;
                            $resultArr[] = array(
                                "w_Transaction_Id" => $res["w_Transaction_Id"],
                                "w_Time_Min_Unix" => $res["w_Time_Min_Unix"],
                                "w_Time_Kor" => $res["w_Time_Kor"],
                                "w_Current_Price" => $res["w_Current_Price"]
                            );
                        }
                        
                    }
                }
            }
            
            $fresult = end($resultArr);

            
            if($r == '매수' || $r == '매도'){
                $newfresult = array(
                    "w_Transaction_Id" => $fresult["w_Transaction_Id"],
                    "w_Time_Min_Unix" => $fresult["w_Time_Min_Unix"],
                    "w_Time_Kor" => $fresult["w_Time_Kor"],
                    "w_Current_Price" => ($r == '매수') ? $openPrice + (rand(2,5) / 10) : $openPrice - (rand(2,5) / 10)
                );
            }else{
                $newfresult = array(
                    "w_Transaction_Id" => $fresult["w_Transaction_Id"],
                    "w_Time_Min_Unix" => $fresult["w_Time_Min_Unix"],
                    "w_Time_Kor" => $fresult["w_Time_Kor"],
                    "w_Current_Price" => $fresult["w_Current_Price"]
                );
            }
            
            
            $newarr = array(
                "result" => array_slice($resultArr, 0, count($resultArr)-1, true),
                "lastresult" => $newfresult
            );
            return $newarr;
        }

        public function postWssTrade($result){
            $query = "INSERT INTO ".$this->tbl_bit_wss_tmp." 
            (w_Game_Type,w_Time_Min_unix,w_Time_Min,w_Time_Unix,w_Time_Kor,w_Current_Price,w_Transaction_Id) VALUES 
            (:type,:Time_Min_unix,:Time_Min,:Time_Unix,:Time_kor,:Cur_Price,:Trans_Id)";
            $stmt = $this->conn->prepare($query);

            $type = $result->type;
            $currenttime = $result->currenttime;
            $mytimeunix = $result->mytimeunix;
            $secunixtime = $result->secunixtime;
            $kortime = $result->kortime;
            $curprice = number_format((float)$result->currentprice, 2, '.', '');
            $transid = $result->transid;

            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Min', $currenttime, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Min_unix', $mytimeunix, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Unix', $secunixtime, PDO::PARAM_STR);
            $stmt->bindParam(':Time_kor', $kortime, PDO::PARAM_STR);
            $stmt->bindParam(':Cur_Price', $curprice, PDO::PARAM_STR);
            $stmt->bindParam(':Trans_Id', $transid, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;

        }

        public function postWssTradeETH($result){
            $query = "INSERT INTO ".$this->tbl_bit_wss_tmp." 
            (w_Game_Type,w_Time_Min_unix,w_Time_Min,w_Time_Unix,w_Time_Kor,w_Current_Price,w_Transaction_Id) VALUES 
            (:type,:Time_Min_unix,:Time_Min,:Time_Unix,:Time_kor,:Cur_Price,:Trans_Id)";
            $stmt = $this->conn->prepare($query);

            $type = $result->type;
            $currenttime = $result->currenttime;
            $mytimeunix = $result->mytimeunix;
            $secunixtime = $result->secunixtime;
            $kortime = $result->kortime;
            $curprice = number_format((float)$result->currentprice, 2, '.', '');
            $transid = $result->transid;

            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Min', $currenttime, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Min_unix', $mytimeunix, PDO::PARAM_STR);
            $stmt->bindParam(':Time_Unix', $secunixtime, PDO::PARAM_STR);
            $stmt->bindParam(':Time_kor', $kortime, PDO::PARAM_STR);
            $stmt->bindParam(':Cur_Price', $curprice, PDO::PARAM_STR);
            $stmt->bindParam(':Trans_Id', $transid, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;

        }

        public function postReservedGameResult($result){
            $query = "INSERT INTO ".$this->tbl_bit_reserved_result." (r_Gametype,r_Time_Unix,r_Date_Time,r_Game_Selected) VALUES (:type, :unix, :date, :selected)";
            $stmt = $this->conn->prepare($query);
            
            $unix = $result->unixseconds;
            $date = $result->datetime;
            $selected = $result->selected;
            $type = $result->type;

            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':unix', $unix, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':selected', $selected, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        
        public function postInquiry($arr){
            $query = "INSERT INTO ".$this->tbl_bit_inquiry." (t_Account_Code,t_Inquiry_Title,t_Inquiry_Details,t_Inquiry_Status_Id,t_Inquiry_Date,t_Language) VALUES (:code,:title,:details,:status,:date,:language) ;
                         UPDATE tbl_bit_sounds SET s_TypeName = :Sound, s_TypeId = :soundStatus WHERE s_Notif_Type = :notifType ";
            $stmt = $this->conn->prepare($query);

            $code = $_SESSION["user_session"]["u_Account_Code"];
            $title = $arr["inquiry_title"];
            $details = $arr["inquiry_details"];
            $status = 0;
            $language = 'kr';

            $t1 = date_default_timezone_get();
            $s1 = new DateTime($t1);
            $date = $s1->format('Y-m-d H:i:s');

            $sound = 'on';
            $soundStatus = 1;
            $notifType = 'InquiryApplication';

            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':details', $details, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':language', $language, PDO::PARAM_STR);
            $stmt->bindParam(':Sound', $sound, PDO::PARAM_STR);
            $stmt->bindParam(':soundStatus', $soundStatus, PDO::PARAM_STR);
            $stmt->bindParam(':notifType', $notifType, PDO::PARAM_STR);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postChangePassword($arr){
            $query = "UPDATE ".$this->tbl_bit_users." SET u_Password = :new_password WHERE u_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            
            $new_password = $arr["password"];
           
            $stmt->bindParam(':new_password', $new_password, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        ////get function
        public function getReservedResultPerMinute($rtime){
            $query = "SELECT * FROM ".$this->tbl_bit_reserved_result." WHERE r_Time_Unix = '".$rtime."' AND r_Gametype = 'BTCUSDT'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getReservedResultPerMinuteETH($rtime){
            $query = "SELECT * FROM ".$this->tbl_bit_reserved_result." WHERE r_Time_Unix = '".$rtime."' AND r_Gametype = 'ETHUSDT'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBinanceHistory(){
            $query = "SELECT TOP 20 r_Time_Unix, r_Open, r_Game_Result, r_StatusId FROM ".$this->tbl_bit_wss_result." WHERE r_Game_Type = 'BTC' ORDER BY r_Id DESC"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBinanceHistoryETH(){
            $query = "SELECT TOP 20 r_Time_Unix, r_Open, r_Game_Result, r_StatusId FROM ".$this->tbl_bit_wss_result." WHERE r_Game_Type = 'ETH' ORDER BY r_Id DESC"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBettingHistoryGroup(){
            $query = "SELECT r_Game_Result, r_Time_Unix, r_Deleted_Date FROM ".$this->tbl_bit_wss_result." WHERE r_Game_Type = 'BTC' AND r_Deleted_Date IS NULL ORDER BY r_Time_Unix ASC"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBettingHistoryGroupETH(){
            $query = "SELECT r_Game_Result, r_Time_Unix, r_Deleted_Date FROM ".$this->tbl_bit_wss_result." WHERE r_Game_Type = 'ETH' AND r_Deleted_Date IS NULL ORDER BY r_Time_Unix ASC"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBinanceUserHistory(){
            $query = "SELECT TOP 20 b_time, b_betAmount, b_Trend, b_Result FROM ".$this->tbl_bit_betting." WHERE b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND b_Game_Type = 'BTCUSDT' ORDER BY b_Id DESC"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBinanceUserHistoryETH(){
            $query = "SELECT TOP 20 b_time, b_betAmount, b_Trend, b_Result FROM ".$this->tbl_bit_betting." WHERE b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND b_Game_Type = 'ETHUSDT' ORDER BY b_Id DESC"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBetPerMin(){
            $query = "SELECT * FROM ".$this->tbl_bit_betting." WHERE DATE(b_UpdatedDate) = '".date('Y-m-d')."' AND b_Result IN(0) AND b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getOpenprice($time){
            $query = "SELECT TOP 1 r_Open FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '$time'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }


        public function getWssResultPerMin($time){
            $query = "SELECT TOP 1 JsonDataResult FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '$time' AND r_Game_Type = 'BTC'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getWssResultPerMinETH($time){
            $query = "SELECT TOP 1 JsonDataResult FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '$time' AND r_Game_Type = 'ETH'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getGameresult($time){
            $query = "SELECT TOP 1 r_Time_Unix,r_Time_Datetime,r_Price_Result,r_Game_Result FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '".$time."' AND r_Game_Type = 'BTC'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getGameresultETH($time){
            $query = "SELECT TOP 1 r_Time_Unix,r_Time_Datetime,r_Price_Result,r_Game_Result FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = '".$time."' AND r_Game_Type = 'ETH'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }


        public function getOpenBet($time){
            $query = "SELECT w_Current_Price FROM ".$this->tbl_bit_wss_tmp." WHERE w_Time_Min = '".$time."' ORDER BY w_Transaction_Id ASC"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

       public function getUserCashBalance(){
            $query = "SELECT TOP 1 t_Amount_in_Total FROM ".$this->tbl_bit_transaction_header." WHERE t_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
       }

        public function getUserAvailableGame(){
            $query = "SELECT g_BTCUSD, g_ETHUSD FROM ".$this->tbl_bit_game_type." WHERE g_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBettingSettings(){
            $query = "SELECT * FROM tbl_bit_settings WHERE s_Type = 'Betting'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function checkUserForceLogout(){
            $query = "SELECT TOP 1 * FROM ".$this->tbl_bit_users." WHERE u_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getAutoIncrement(){
            $query = "SELECT TOP 1 MAX(a_Id) + 1 FROM tbl_bi_apis ORDER BY a_Id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
        }

        public function getReserveGameResult(){
            $query = "SELECT * FROM ".$this->tbl_bit_reserved_result;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getResultUnixtime($unixtime){
            $query = "SELECT r_Open FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = ".$unixtime." AND r_Game_Type = 'BTC'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getResultUnixtimeETH($unixtime){
            $query = "SELECT r_Open FROM ".$this->tbl_bit_wss_result." WHERE r_Time_Unix = ".$unixtime." AND r_Game_Type = 'ETH'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function checkMaintenance(){
            $query = "SELECT * FROM tbl_bit_settings WHERE s_Type = 'Maintenance'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function checkBTCMaintenance(){
            $query = "SELECT * FROM tbl_bit_settings WHERE s_Name = 'BTC' OR s_Name = 'ETH'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } 

        public function checkSound(){
            $query = "SELECT u_Access_Code FROM tbl_bit_users WHERE u_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function checkNewMessage(){
            $query = "SELECT COUNT(e_Checker) AS CntChck FROM ".$this->tbl_bit_note." WHERE e_Checker IN(0) AND e_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' OR e_Account_Code = 'ALL' AND e_Checker IN(0)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getInfoCntNote(){
            $query = "SELECT COUNT(e_State) AS Cnt FROM ".$this->tbl_bit_note." WHERE e_State IN(0) AND e_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' OR e_Account_Code = 'ALL' AND e_State IN(0)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getNoteList(){
            $query = "SELECT * FROM tbl_bit_notes WHERE e_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        

        public function getNotification(){
            $query = "SELECT COUNT(s_TypeName) AS TypeCnt  FROM ".$this->tbl_bit_sound." WHERE s_TypeName IN('on') GROUP BY s_TypeName";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function checkCategoryRequest(){
            $query = "SELECT s_Notif_Type,s_TypeName FROM ".$this->tbl_bit_sound;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function setToMUte(){
            $query = "UPDATE ".$this->tbl_bit_sound." SET s_TypeId = 0, s_TypeName = 'off'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function updateRefresh($type){
            $query = "UPDATE ".$this->tbl_bit_note." SET e_Checker = 1 WHERE e_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' OR e_Account_Code = 'ALL'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function updateRefreshSound($type){
            $query = "UPDATE tbl_bit_users SET u_Access_Code = '$type' WHERE u_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getTotalBetPerMin(){
            $query = "SELECT 
            SUM(b_betAmount) AS Totalwin, b_time, b_Trend
            FROM ".$this->tbl_bit_betting."
            GROUP BY b_Time,b_Trend";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getGameResultHistory(){
            $query = "SELECT TOP 5
            R.r_Time_Unix AS resTime,
            W.r_Time_Datetime AS Date_Time,
            W.r_Price_Result,
            W.r_Game_Result,
            W.JsonDataResult,
            W.r_Game_Type
            FROM ".$this->tbl_bit_wss_result." W
            LEFT JOIN ".$this->tbl_bit_reserved_result." R ON W.r_Time_Unix = R.r_Time_Unix WHERE W.r_StatusId IN(1) ORDER BY W.r_Time_Unix DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBetAtThisTime(){
            $query = "SELECT * FROM ".$this->tbl_bit_betting;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getGameResservedMinUpdate($unixtime){
            $query = "SELECT
            tbl_bit_reserved_results.r_Game_Selected AS GameSelected,
            tbl_bit_reserved_results.r_Time_Unix AS TimeUnix,
            tbl_bit_wss_results.r_Open AS OpenPrice,
            tbl_bit_wss_results.JsonDataResult AS JSONResult
            FROM ".$this->tbl_bit_reserved_result."
            JOIN ".$this->tbl_bit_wss_result." ON tbl_bit_reserved_results.r_Time_Unix = tbl_bit_wss_results.r_Time_Unix
            WHERE tbl_bit_reserved_results.r_Time_Unix = :time_unix AND tbl_bit_reserved_results.r_IsCanceled IN(0)";
            $stmt = $this->conn->prepare($query);

            $unix = $unixtime;
            $stmt->bindParam(':time_unix', $unix, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rowCount = $stmt->rowCount();
            if($rowCount > 0){
                $update = "UPDATE ".$this->tbl_bit_wss_result." SET r_Price_Result = :price_res, r_Game_Result = :game_result, JsonDataResult = :json WHERE r_Time_Unix = :time_reserved";
                $stmt1 = $this->conn->prepare($update);

                $openprice_ex = explode('.', $data[0]["OpenPrice"]);
                $gs = $data[0]["GameSelected"];
                $tu = $data[0]["TimeUnix"];
                $pr = ($gs == '매수') ? $openprice_ex[0] + rand(1,2) . '.' . rand($openprice_ex[1],99) : $openprice_ex[0] - rand(2,2) . '.' . rand(0,$openprice_ex[1]);
                $jr = $data[0]["JSONResult"];
                $jsondecode = json_decode($jr, true);
                $rs = $jsondecode["result"];
                $lr = array(
                    "w_Time_Kor" => $jsondecode["lastresult"]["w_Time_Kor"],
                    "w_Current_Price" => $pr,
                    "w_Time_Min_Unix" => $jsondecode["lastresult"]["w_Time_Min_Unix"],
                    "w_Transaction_Id" => $jsondecode["lastresult"]["w_Transaction_Id"]
                );
                $newArrayJson = array(
                    "result" => $rs,
                    "lastresult" => $lr
                );
                $jsontype = json_encode($newArrayJson);

                // print_r($gs);
                // print_r($lr);
                // print_r(json_encode($newArrayJson));

                $stmt1->bindParam(':price_res', $pr, PDO::PARAM_STR);
                $stmt1->bindParam(':game_result', $gs, PDO::PARAM_STR);
                $stmt1->bindParam(':time_reserved', $tu, PDO::PARAM_STR);
                $stmt1->bindParam(':json', $jsontype, PDO::PARAM_STR);
                if($stmt1->execute()){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function checkTimeDeposit(){
            $query = "SELECT TOP 1 h_Contract_Time FROM tbl_bit_transaction_histories WHERE h_Transaction_Type = 'Deposit' AND h_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' ORDER BY h_Contract_Time DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        
        public function checkTimeWithdraw(){
            $query = "SELECT h_Contract_Time, h_Status FROM tbl_bit_transaction_histories WHERE h_Transaction_Type = 'Withdraw' AND h_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND h_Status IN(1) ORDER BY h_Contract_Time DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function checkTimeBetPerMin($timeunix){
            $query = "SELECT * FROM ".$this->tbl_bit_betting." WHERE b_time = '".$timeunix."' AND b_Game_Type = 'BTCUSDT' 
            AND b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function checkTimeBetPerMinETH($timeunix){
            $query = "SELECT * FROM ".$this->tbl_bit_betting." WHERE b_time = '".$timeunix."' AND b_Game_Type = 'ETHUSDT' 
            AND b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getUserBankInfo(){
            $query = "SELECT TOP 1
            U.u_Account_Number,
            U.u_Bank_Holder_Name,
            B.m_Bank_Name
            FROM ".$this->tbl_bit_users." U
            JOIN ".$this->tbl_bit_bank." B ON U.u_Bank_Code = B.m_BankId
            WHERE U.u_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getUserPrivacyInfo(){
            $query = "SELECT TOP 1
            tbl_bit_users.u_Account_Code,
            tbl_bit_users.u_Account_Number,
            tbl_bit_users.u_Bank_Holder_Name,
            tbl_bit_users.u_Id,
            tbl_bit_users.u_Nickname,
            tbl_bit_users.u_Password,
            tbl_bit_users.u_Recommended_Point,
            tbl_bit_banklists.m_Bank_Name
            FROM tbl_bit_users
             JOIN tbl_bit_banklists ON tbl_bit_users.u_Bank_Code = tbl_bit_banklists.m_BankId
            WHERE u_Account_Code  = '".$_SESSION["user_session"]["u_Account_Code"]."'"; 

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }