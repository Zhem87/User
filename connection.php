  
<?php
	    private $serverName = "localhost\\SE2016";
        private $database_name = "bitman365";
        private $username = "root";
        private $password = "1q2w3e4r**";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("sqlsrv:server=" . $this->serverName . ";Database=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }


      
        $sql =  "SELECT * FROM tbl_bit_users";
        $results = sqlsrv_query($conn, $sql);

        if( $results === false ) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }

    }
?>