<?php
namespace App\Services\Data\Utility;

use mysqli;

class DBConnect {
    
    private $conn;
    private $servername;
    private $username;
    private $password;
    private $dbname;
    
    
    public function __construct()
    {
        $this->dbname = "glimpse";
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
    }
    
    public function getDBConnect() {
        // OOP
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        // Procedural
//         $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        
        // Scope Resolution Operator
//         $this->conn = mysqli::connect($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            echo "Failed to connect to MySQL: " . $this->conn->connect_error;
            exit();
        }
        return($this->conn);
    }
    
    public function setDBAutoCommitTrue() {
        $this->conn->autocommit(TRUE);
    }
    
    public function setDBAutoCommitFalse() {
        $this->conn->autocommit(FALSE);
    }
    
    public function closeDBConnect() {
        // Procedural
//         mysqli_close($this->conn);
        
        // OOP
        $this->conn->close();
        
        // Scope Resolution Operator
//         mysqli::close($this->conn);
    }
    
    public function beginTransaction() {
        $this->conn->begin_transaction();
    }
    
    public function commitTransaction() {
        $this->conn->commit();
    }
    
    public function rollBackTransaction() {
        $this->conn->rollback();
    }
    
}