<?php

  session_start();
  
  // Check if request came from the login form
  if (isset($_POST['login-submit'])) {
    
    // include files
    include_once(__DIR__ . '/../../Controllers/UserController.php');
    include_once(__DIR__ . '/../../Models/User.class.php');

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {

      header('Location: /login?error=emptyfields');
      exit();
    }
    else {

      $user_controller = new UserController();
      $user = $user_controller->get($mailuid);
     
      if ($user) {

        $pwdCheck = password_verify($password, $user->password);
        if ($pwdCheck == false) {
          // wrong password

          header('Location: /login?error=wrongpwd');
          exit();
        }
        else if ($pwdCheck == true) {
          // found user
          $_SESSION['userUid'] = $user->username;
          $_SESSION['userId'] = $user->id;
          header('Location: /dashboard?login=success');
          exit();
        }
        else {
          // unexpected condition value

          header('Location: /login?error=internalerror');
          exit();
        }
      }
      else {
        // No user exits

        header('Location: /login?error=nouser');
        exit();
      }
    }
  }
  else {

    header('Location: /login');
    exit();
  }
