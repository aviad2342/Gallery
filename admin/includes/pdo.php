<?php 

require_once("new_config.php");

class Dbh { // future alternative (to mysqli) more secured database connection (PDO)

    public $pdoConnection;
    public $db;

    function __construct(){
        $this->db = $this->connect();
    }

    public function connect(){  
        try {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME."charset=utf8mb4";
            $this->pdoConnection = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdoConnection;

        } catch (PDOException $e) {
            echo "Database connection failed:".$e->getMessage();
        }
    }

    public function query($sql){
        $result = $this->db->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($result){
        if(!$result){
            die("Query Failed" . $this->db->error);
        }
    }

    public function insert_id(){
        return $this->db->lastInsertId();
    }


}

$pdoDatabase = new Dbh();

?>