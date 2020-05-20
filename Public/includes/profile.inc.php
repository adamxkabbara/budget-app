<?php 
session_start();
include_once __DIR__ . '/../../Controllers/UserController.php';
include_once __DIR__ . '/../../Models/User.class.php';
include_once __DIR__ . '/../../Utils/Constants.php';

if (isset($_POST['profile-submit'])) {
    $username = $_POST["username"]; 
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    // User input check
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {

      header("Location: /profile?error=emptyfields&uid=$username&mail=$email");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {

      header("Location: /profile?error=invalidmailuid");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

      header("Location: /profile?error=invalidmail&uid=$username");
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {

      header("Location: /profile?error=invaliduid&mail=$email");
      exit();
    }
    else if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9]{8,}$/', $password)) {

      header("Location: /profile?error=passwordmalformed&uid=$username&mail=$email");
      exit();
    }
    else if ($password !== $passwordRepeat) {

      header("Location: /profile?error=passwordcheck&uid=$username&mail=$email");
      exit();
    }
    else {
      // Check if user already exists

      $user_obj = new User(null, $username, $email, $password);
      $user_controller = new UserController();

      $result = $user_controller->update($user_obj, $_SESSION['userUid']);
      if ($result === SUCCESS) {
        $_SESSION['userUid'] = $_POST["userUid"] = $username;
        header("Location: /profile?edit=success");
        exit();
      }
      else if ($result === ER_DUP_ENTRY) {
        //User taken
        header("Location: /profile?error=userTaken&mail=$email");
        exit();
      }
      else if ($result === ER_PARSE_ERROR) {
        header("Location: /profile?error=invalidsql");
        exit();
      }
      else {
        throw new Exception($result);
        //header("Location: /profile?error=invalid");
        exit();
      }
    }
  }
  else {
    header("Location: /profile");
    exit();
  }
