<?php
ini_set('display_errors', 1);

include_once __DIR__ . '/../Interfaces/Controller.inter.php';
include_once __DIR__ . '/../Models/MySqlDatabase.class.php';
include_once __DIR__ . '/../Models/Revenue.class.php';

class RevenueController implements Controller {

  function get($idRevenue) {

    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT * FROM transaction WHERE idRevenue=?';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    }
    else {

      $stmt->bind_param('s', $idRevenue);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {

        $revenue = new Revenue($row['idRevenue'], $row['idUser'], $row['amount'], $row['date']);
        return $revenue;
      }
      else {
        return null;
      }
    }
    $db->disconnect();
  } 

  function create($transaction) {

    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'INSERT INTO revenues (idUser,amount, date) VALUES (?, ?, ?)';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return 1064;
    }
    else {
      $stmt->bind_param('sss', $transaction->idUser, $transaction->amount, $transaction->date);
      $stmt->execute();

      return $stmt->errno;
    }

    $db->disconnect();
  }

  function delete() {}

  function update() {}

  function delete_all() {}
}