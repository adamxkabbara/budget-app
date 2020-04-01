<?php

  if (isset($_POST["signup-submit"])) {

    // include files
    include_once(__DIR__ . '/../../Controllers/UserController.php');
    include_once(__DIR__ . '/../../models/User.class.php');

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

      $user_obj = new User($username, $email, $password);
      $user_controller = new UserController();

      $result = $user_controller->create($user_obj);
      if ($result === 1062) {
        //User taken

        header("Location: ../signup.php?error=userTaken&mail=$email");
        exit();
      }
      else if ($result === 0) {
        header("Location: ../signup.php?signup=success");
        exit();
      }
      else {
        header("Location: ../signup.php?error=invalidsql");
        exit();
      }
    }
  }
  else {
      header("Location: ../signup.phpp");
      exit();
  }
