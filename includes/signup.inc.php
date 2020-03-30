<?php

  if (isset($_POST["signup-submit"])) {

    // Connect to db
    require 'dbh.inc.php';

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

      $sql = 'SELECT uidUsers FROM users WHERE emailUsers=?;';
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("Location: ../signup.php?error=invalidsql");
        exit();
      }
      else {

        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
          //User taken

          header("Location: ../signup.php?error=userTaken&mail=$email");
          exit();
        }
        else {
          // Add User

          $sql = 'INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?);';
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("Location: ../signup.php?error=invalidsql");
            exit();
          }
          else {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashPassword);
            mysqli_stmt_execute($stmt);

            header("Location: ../signup.php?signup=success");
            exit();
          }
        }
      }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
  else {
      header("Location: ../signup.php");
      exit();
   }
