<?php
ini_set('display_errors', 1);

include_once __DIR__ . '/../Interfaces/Controller.inter.php';
include_once __DIR__ . '/../Public/includes/MySqlDatabase.inc.php';
include_once __DIR__ . '/../models/User.class.php';

class UserController implements Controller {

  function get($mailuid) {

    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT * FROM users WHERE uidUsers=? OR emailUsers=?';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    }
    else {

      $stmt->bind_param('ss', $mailuid, $mailuid);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {

        $user = new User($row['uidUsers'], $row['emailUsers'], $row['pwdUsers']);
        return $user;
      }
      else {
        return null;
      }
    }
    $db->disconnect();
  } 

  function create($user) {

    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return 2;
    }
    else {
      $hashPassword = password_hash($user->password, PASSWORD_DEFAULT);
      $stmt->bind_param('sss', $user->username, $user->email, $hashPassword);
      $stmt->execute();

      return $stmt->errno;
    }

    $db->disconnect();
  }

  function delete() {}

  function update() {}

  function delete_all() {}
}