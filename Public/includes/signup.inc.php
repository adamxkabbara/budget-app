<?php

  if (isset($_POST["signup-submit"])) {

    // include files
    include_once('./dbh.inc.php');
    include_once('../../models/User.model.php');

    // Connect to db
    //require 'dbh.inc.php';

    $username = $_POST["uid"]; 
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    // User input check
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {

      header("Location: ../signup.php?error=emptyfields&uid=$username&mail=$email");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {

      header("Location: ../signup.php?error=invalidmailuid");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

      header("Location: ../signup.php?error=invalidmail&uid=$username");
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {

      header("Location: ../signup.php?error=invaliduid&mail=$email");
      exit();
    }
    else if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8,}$/', $password)) {

      header("Location: ../signup.php?error=passwordmalformed&uid=$username&mail=$email");
      exit();
    }
    else if ($password !== $passwordRepeat) {

      header("Location: ../signup.php?error=passwordcheck&uid=$username&mail=$email");
      exit();
    }
    else {
      // Check if user already exists

      $db = new Database();

      $connection = $db->connect();

      $user_obj = new User($connection, $username, $email, $password);

      if ($user_obj->isDuplicate()) {
          //User taken

          header("Location: ../signup.php?error=userTaken&mail=$email");
          exit();
      }
      else {
        // Create User

        if (!$user_obj->create_user()) {
          header("Location: ../signup.php?error=invalidsql");
          exit();
        }
        else {
          header("Location: ../signup.php?signup=success");
          exit();
        }
      }

      $db->disconnect();
    }
  }
  else {
      header("Location: ../signup.phpp");
      exit();
  }