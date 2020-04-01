<?php
ini_set('display_errors', 1);

require_once('../Interfaces/Database.inter.php');

Class MySqlDatabase implements Database {
    
  private $servername;
  private $dbUsername;
  private $dbPassword;
  private $dbName;
  private $dbPort;
  private $conn;

  public function connect() {

    // Check if connection already exists
    if ($this->conn) {
      die("Connection already established");
    }

    $this->servername = "";
    $this->dbUsername = "";
    $this->dbPassword = "";
    $this->dbName = "";
    $this->dbPort = 3306;

    $this->conn = new mysqli($this->servername, $this->dbUsername, $this->dbPassword, $this->dbName, $this->dbPort);
    
    if ($this->conn->connect_errno) {
      die("Connection failed: ".$this->conn->connect_errno);
    }

    return $this->conn;
  }
  
  public function disconnect() {
    $this->conn->mysqli_close();
  }
}