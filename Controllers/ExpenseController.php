<?php
ini_set('display_errors', 1);

include_once __DIR__ . '/../Interfaces/Controller.inter.php';
include_once __DIR__ . '/../Models/MySqlDatabase.class.php';
include_once __DIR__ . '/../Models/Expense.class.php';

class ExpenseController implements Controller
{

  function getAll($idUser)
  {
    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT * FROM transaction WHERE idUser=?';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    } else {

      $stmt->bind_param('s', $idUser);
      $stmt->execute();
      $result = $stmt->get_result();
      $expenses = [];

      if ($rows = $result->fetch_assoc()) {
        foreach ($rows as $row) {
          if ($row) $expenses[] = new Expense($row['idExpense'], $row['idUser'], $row['idItem'], $row['merchant'], $row['amount'], $row['category'], $row['notes'], $row['date'], $row['status']);
        }
        return $expenses;
        
      } else {
        return null;
      }
    }
    $db->disconnect();
  }

  function get($idTransaction)
  {

    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT * FROM transaction WHERE idExpense=?';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    } else {

      $stmt->bind_param('s', $idTransaction);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {

        $expense = new Expense($row['idExpense'], $row['idUser'], $row['idItem'], $row['merchant'], $row['amount'], $row['category'], $row['notes'], $row['date'], $row['status']);
        return $expense;
      }
      else {
        return null;
      }
    }
    $db->disconnect();
  }

  function create($transaction)
  {

    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'INSERT INTO expenses (idUser, merchant, amount, notes, category, date, status) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return 1064;
    } else {
      $stmt->bind_param('sssssss', $transaction->idUser, $transaction->merchant, $transaction->amount, $transaction->notes, $transaction->category, $transaction->date, $transaction->status);
      $stmt->execute();

      return $stmt->errno;
    }

    $db->disconnect();
  }

  function delete()
  {
  }

  function update()
  {
  }

  function delete_all()
  {
  }
}
