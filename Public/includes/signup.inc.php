<?php

  if (isset($_POST["signup-submit"])) {

    // include files
    include_once __DIR__ . '/../../Controllers/UserController.php';
    include_once __DIR__ . '/../../models/User.class.php';
    include_once __DIR__ . '/../../Utils/Constants.inc.php';

    $username = $_POST["uid"]; 
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    // User input check
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {

      header("Location: /signup?error=emptyfields&uid=$username&mail=$email");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {

      header("Location: /signup?error=invalidmailuid");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

      header("Location: /signup?error=invalidmail&uid=$username");
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {

      header("Location: /signup?error=invaliduid&mail=$email");
      exit();
    }
    else if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8,}$/', $password)) {

      header("Location: /signup?error=passwordmalformed&uid=$username&mail=$email");
      exit();
    }
    else if ($password !== $passwordRepeat) {

      header("Location: /signup?error=passwordcheck&uid=$username&mail=$email");
      exit();
    }
    else {
      // Check if user already exists

      $user_obj = new User($username, $email, $password);
      $user_controller = new UserController();

      $result = $user_controller->create($user_obj);
      if ($result === SUCCESS) {
        header("Location: /dashboard?signup=success");
        exit();
      }
      else if ($result === ER_DUP_ENTRY) {
        //User taken
        header("Location: /signup?error=userTaken&mail=$email");
        exit();
      }
      else if ($result === ER_PARSE_ERROR) {
        header("Location: /signup?error=invalidsql");
        exit();
      }
      else {
        header("Location: /signup.php?error=invalid");
        exit();
      }
    }
  }
  else {
    header("Location: /signup");
    exit();
  }
