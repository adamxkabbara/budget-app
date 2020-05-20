<?php
ini_set('display_errors', 1);

include_once __DIR__ . '/../Interfaces/Controller.inter.php';
include_once __DIR__ . '/../Models/MySqlDatabase.class.php';
include_once __DIR__ . '/../Models/Expense.class.php';
include_once __DIR__ . '/../Utils/Constants.php';

class ExpenseController implements Controller
{

  function getAll($idUser)
  {
    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT * FROM expenses WHERE idUser=? ORDER BY date DESC';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    } else {

      $stmt->bind_param('s', $idUser);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($rows = $result->fetch_all(MYSQLI_ASSOC)) {
        $expenses = [];
        foreach ($rows as $row) {
          $expenses[] = new Expense($row['idTransaction'], $row['idUser'], $row['idItem'], $row['merchant'], $row['amount'], $row['notes'], $row['category'], $row['date'], $row['status']);
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
      } else {
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

  function sumAmount($idUser, $type)
  {
    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $subquery = $type == TODAY ? 'DATE(date) = CURDATE()' : 'DATE_FORMAT(date, "%Y-%m") = DATE_FORMAT(NOW(), "%Y-%m")';
    $sql = 'SELECT IFNULL(SUM(amount),0) AS total FROM expenses WHERE ' . $subquery . ' AND idUser=?;';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    } else {
      $stmt->bind_param('s', $idUser);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {
        return $row['total'];
      } else {
        return 0;
      }
    }
    $db->disconnect();
  }

  function spending_breakdown($idUser)
  {
    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT SUM(amount) AS total, category FROM expenses WHERE idUser=? AND DATE_FORMAT(date, "%Y-%m") = DATE_FORMAT(NOW(), "%Y-%m") GROUP BY category;';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    } else {
      $stmt->bind_param('s', $idUser);
      $stmt->execute();
      $result = $stmt->get_result();

      $chartData = ['Housing' => 0, 'Transportation' => 0, 'Food' => 0, 'Medical' => 0, 'Entertainment' => 0, 'Shopping' => 0];
      while ($row = $result->fetch_assoc()) {
        $chartData[$row['category']] = $row['total'];
      }
      return array_values($chartData);
    }
    $db->disconnect();
  }

  function monthly_spending($idUser)
  {
    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT SUM(amount) AS total, MONTH(date) AS month FROM expenses WHERE idUser=? AND YEAR(date) = YEAR(NOW()) GROUP BY MONTH(date);';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    } else {
      $stmt->bind_param('s', $idUser);
      $stmt->execute();
      $result = $stmt->get_result();

      $chartData = array_fill(0, date("n"), 0);
      while ($row = $result->fetch_assoc()) {
        $chartData[$row['month']-1] = $row['total'];
      }
      return array_values($chartData);
    }
    $db->disconnect();
  }

  function spending_earning($idUser)
  {
    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT * from balance WHERE idUser=?;';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    } else {
      $stmt->bind_param('s', $idUser);
      $stmt->execute();
      $result = $stmt->get_result();

      $chartData = [0, 0];
      while ($row = $result->fetch_assoc()) {
        $chartData[0] = $row['month_spent'];
        $chartData[1] = $row['month_earned'];
      }
      return array_values($chartData);
    }
    $db->disconnect();
  }

  function monthly_revenue($idUser)
  {
    $db = new MySqlDatabase();
    $mysql = $db->connect();

    $sql = 'SELECT SUM(amount) AS total, MONTH(date) AS month FROM revenues WHERE idUser=? AND YEAR(date) = YEAR(NOW()) GROUP BY MONTH(date);';
    $stmt = $mysql->prepare($sql);

    if (!$stmt) {
      return null;
    } else {
      $stmt->bind_param('s', $idUser);
      $stmt->execute();
      $result = $stmt->get_result();

      $chartData = array_fill(0, 12, 0);
      while ($row = $result->fetch_assoc()) {
        $chartData[$row['month']-1] = $row['total'];
      }
      return array_values($chartData);
    }
    $db->disconnect();
  }
}
