<?php
ini_set('display_errors', 1);

include_once __DIR__ . '/../Interfaces/Controller.inter.php';
include_once __DIR__ . '/../Models/MySqlDatabase.class.php';
include_once __DIR__ . '/../Models/Expense.class.php';

class ExpenseController implements Controller {

  function get($idTransaction) {

    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT * FROM transaction WHERE idTransaction=?';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    }
    else {

      $stmt->bind_param('s', $idTransaction);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {

        $transaction = new Expense($row['idExpense'], $row['idUser'], $row['idItem'], $row['merchant'], $row['amount'], $row['category'], $row['notes'], $row['date'], $row['status']);
        return $transaction;
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

    $sql = 'INSERT INTO expenses (idUser, idItem, merchant, amount, date, category, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return 1064;
    }
    else {

      $stmt->bind_param('ssssssss', $transaction->idUser, null, $transaction->merchant, $transaction->amount, $transaction->category, $transaction->notes, $transaction->date, $transaction->status);
      $stmt->execute();

      return $stmt->errno;
    }

    $db->disconnect();
  }

  function delete() {}

  function update() {}

  function delete_all() {}
}