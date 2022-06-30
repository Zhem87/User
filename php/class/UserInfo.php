<?php
    class Userinfo {
        // DB stuff
        private $conn;
        private $tbl_bit_notice = "tbl_bit_notice";
        private $tbl_bit_guide = "tbl_bit_guide";
        private $tbl_bit_inquiry = "tbl_bit_inquiries";
        private $tbl_bit_faq = "tbl_bit_faqs";
        private $tbl_bit_transaction_history = "tbl_bit_transaction_histories";
        private $tbl_bit_wss_result = "tbl_bit_wss_results";
        private $tbl_bit_betting_detail = "tbl_bit_betting_details";
        private $tbl_bit_user = "tbl_bit_users";
        private $tbl_bit_transactions_cashin_detail = "tbl_bit_transactions_cashin_details";
        private $tbl_bit_transactions_withdraw_detail = "tbl_bit_transactions_withdraw_details";
        private $tbl_bit_note = "tbl_bit_notes";
        
        
        //properties  
		public function __construct($db){
			$this->conn = $db;

		}
        
        ///rowcount
        public function getFAQRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_faq." WHERE f_Deleted_Date IS NULL AND f_Language = 'kr'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        ///rowcount
        public function getGuideRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_IsPublic IN(1) AND g_Deleted_Date IS NULL AND g_Language = 'kr'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getNoteRowCount(){
            $query = "SELECT * FROM tbl_bit_notes WHERE e_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND e_Deleted_Time IS NULL OR e_Account_Code = 'ALL'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getNoticeRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_IsPublic IN(1) AND n_Deleted_Date IS NULL AND n_Language = 'kr'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        public function getInquiryRowCount(){
            $query = "SELECT * FROM tbl_bit_inquiries WHERE t_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND t_Language = 'kr'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        // Cashin Cashout History
        public function getUserHistoryRowCount(){
            $query = "SELECT * FROM tbl_bit_transaction_histories WHERE h_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'"; 
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        // Betting Transaction History
        public function getUserTransactionRowCount(){
            $query = "SELECT * FROM tbl_bit_betting_details WHERE b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        //execute datarow
        public function getFAQList(){
            $query = "SELECT * FROM ".$this->tbl_bit_faq." WHERE f_Deleted_Date IS NULL AND f_Language = 'kr'";
            return $query;
        }
        public function getNoticeList(){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_IsPublic IN(1) AND n_Deleted_Date IS NULL AND n_Language = 'kr'";
            return $query;
        }
        public function getGuideList(){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_IsPublic IN(1) AND g_Deleted_Date IS NULL AND g_Language = 'kr'";
            return $query;
        }
        public function getNoteList(){
            $query = "SELECT * FROM tbl_bit_notes WHERE e_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND e_Deleted_Time IS NULL OR e_Account_Code = 'ALL'";
            return $query;
        }
        public function getInquiryList(){
            $query = "SELECT * FROM tbl_bit_inquiries WHERE t_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND t_Language = 'kr'";
            return $query;
        }

        // Cashin Cashout History
        public function getUserHistoryList(){
            $query = "SELECT *
            FROM tbl_bit_transaction_histories 
            JOIN tbl_bit_users ON tbl_bit_transaction_histories.h_Account_Code = tbl_bit_users.u_Account_Code
            WHERE h_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND h_Event = '입금' OR h_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND h_Event = '출금'";
            return $query;

            // $query = "SELECT *
            // FROM tbl_bit_transaction_histories H
            // JOIN tbl_bit_users U ON H.h_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."'";
            // return $query;

        }

        public function getUserTransactionList(){
            $query = "SELECT * FROM tbl_bit_betting_details WHERE b_Account_Code = '".$_SESSION["user_session"]["u_Account_Code"]."' AND b_Language = 'kr'";
            return $query;
        }
      
    }
?>