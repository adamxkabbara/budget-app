<?php

  session_start();
  
  // Check if request came from the login form
  if (isset($_POST['login-submit'])) {
    
    // include files
    include_once('../Controllers/UserController.php');
    include_once('../models/User.class.php');

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {

      header('Location: ../login.php?error=emptyfields');
      exit();
    }
    else {

      $user_controller = new UserController();
      $user = $user_controller->get($mailuid);
     
      if ($user) {

        $pwdCheck = password_verify($password, $user->password);
        if ($pwdCheck == false) {
          // wrong password

          header('Location: ../login.php?error=wrongpwd');
          exit();
        }
        else if ($pwdCheck == true) {
          // found user
          $_SESSION['userUid'] = $user->username;

          header('Location: ../index.php?login=success');
          exit();
        }
        else {
          // unexpected condition value

          header('Location: ../login.php?error=internalerror');
          exit();
        }
      }
      else {
        // No user exits

        header('Location: ../login.php?error=nouser');
        exit();
      }
    }
  }
  else {

    header('Location: ../login.php');
    exit();
  }
