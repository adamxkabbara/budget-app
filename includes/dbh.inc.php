<?php
ini_set('display_errors', 1);

  class Database {
    
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
      $this->dbPort = null;

      $this->conn = mysqli_connect($this->servername, $this->dbUsername, $this->dbPassword, $this->dbName, $this->dbPort);

      if (!$this->conn) {
        die("Connection failed: ".mysqli_connect_error());
      }
      else {
        return $this->conn;
      }
    }
    
    public function disconnect() {
      mysqli_close($this->conn);
    }
  }