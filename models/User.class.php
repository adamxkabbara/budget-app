<?php
ini_set('display_errors', 1);

  class User {
    public $id; 
    public $username;
    public $email;
    public $password;

    public function __construct( $id=null, $username=null, $email=null, $password=null) {
      $this->username = $username;
      $this->email = $email;
      $this->password = $password;
      $this->id = $id;
    }
  }