<?php

  session_start();
  
  // Check if request came from the login form
  if (isset($_POST['login-submit'])) {

    // Setup db
    require './dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {

      header('Location: ../login.php?error=emptyfields');
      exit();
    }
    else {

      $sql = 'SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;';
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {

        header('Location: ../login.php?error=invalidsql');
        exit();
      }
      else {
        // verify password

        mysqli_stmt_bind_param($stmt, 'ss', $mailuid, $mailuid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {

          $pwdCheck = password_verify($password, $row['pwdUsers']);
          if ($pwdCheck == false) {
            // wrong password

            header('Location: ../login.php?error=wrongpwd');
            exit();
          }
          else if ($pwdCheck == true) {
            // found user

            $_SESSION['userId'] = $row['idUsers'];
            $_SESSION['userUid'] = $row['uidUsers'];

            header('Location: ../index.php?login=success');
            echo $_SESSION['userId'];
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
  }
  else {

    header('Location: ../login.php');
    exit();
  }
