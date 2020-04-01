<?php
ini_set('display_errors', 1);

require_once(__DIR__ . '/../../Interfaces/Database.inter.php');

class MySqlDatabase implements Database
{

  private $servername;
  private $dbUsername;
  private $dbPassword;
  private $dbName;
  private $dbPort;
  private $conn;

  public function connect()
  {

    // Check if connection already exists
    if ($this->conn) {
      die("Connection already established");
    }

    $this->servername = getenv("DB_Server_Name");
    $this->dbUsername = getenv("DB_Username");
    $this->dbPassword = getenv("DB_Password");
    $this->dbName = getenv("DB_Name");;
    $this->dbPort = getenv("DB_Port");

    $this->conn = new mysqli($this->servername, $this->dbUsername, $this->dbPassword, $this->dbName, $this->dbPort);

    if ($this->conn->connect_errno) {
      die("Connection failed: " . $this->conn->connect_errno);
    }

    return $this->conn;
  }

  public function disconnect()
  {
    $this->conn->mysqli_close();
  }
}
