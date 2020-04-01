<?php
ini_set('display_errors', 1);

require_once __DIR__.'/../Interfaces/Database.inter.php';

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

    $this->servername = '127.0.0.1';
    $this->dbUsername = 'root';
    $this->dbPassword = '9000';
    $this->dbName = 'budget-app-schema';
    $this->dbPort = '3306';

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
