<?php
ini_set('display_errors', 1);

include_once __DIR__ . '/../Interfaces/Controller.inter.php';
include_once __DIR__ . '/../Models/MySqlDatabase.class.php';
include_once __DIR__ . '/../Models/User.class.php';

class UserController implements Controller {

  function get($mailuid) {

    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT * FROM users WHERE uidUser=? OR emailUser=?';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    }
    else {

      $stmt->bind_param('ss', $mailuid, $mailuid);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {

        $user = new User($row['idUser'], $row['uidUser'], $row['emailUser'], $row['pwdUser']);
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

    $sql = 'INSERT INTO users (uidUser, emailUser, pwdUser) VALUES (?, ?, ?)';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return 1064;
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

  function update($user, $uidUser) {
    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'UPDATE users SET uidUser=?, emailUser=?, pwdUser=? WHERE uidUser=?';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return 1064;
    }
    else {
      $hashPassword = password_hash($user->password, PASSWORD_DEFAULT);
      $stmt->bind_param('ssss', $user->username, $user->email, $hashPassword, $uidUser);
      $stmt->execute();

      return $stmt->errno;
    }

    $db->disconnect();
  }

  function delete_all() {}
}
