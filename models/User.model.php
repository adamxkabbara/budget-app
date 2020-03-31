<?php
ini_set('display_errors', 1);

  class User {
    public $username;
    public $email;
    public $password;
    
    private $conn;
    private $user_tbl;

    public function __construct($db, $username=null, $email=null, $password=null) {

      $this->username = $username;
      $this->email = $email;
      $this->password = $password;

      $this->conn     = $db;
      $this->user_tbl = "users";
    }

    public function create_user() {
      $sql = 'INSERT INTO '.$this->user_tbl.' (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?);';
      $stmt = mysqli_stmt_init($this->conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {

        return false;
      }
      else {
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'sss', $this->username, $this->email, $hashPassword);
        mysqli_stmt_execute($stmt);

        return true;
      }
    }

    public function isDuplicate() {

      $sql = 'SELECT uidUsers FROM users WHERE emailUsers=?;';
      $stmt = mysqli_stmt_init($this->conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {

        return true;
      }
      else {

        mysqli_stmt_bind_param($stmt, 's', $this->email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
          //User taken

          return true;
        }
        else {
          return false;
        }
      }
      mysqli_stmt_close($stmt);
    }
  }