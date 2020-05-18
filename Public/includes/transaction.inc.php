<?php
    session_start();

    if (isset($_POST["transaction-submit"])) {

      // include files
      include_once __DIR__ . '/../../Controllers/ExpenseController.php';
      include_once __DIR__ . '/../../Controllers/RevenueController.php';
      include_once __DIR__ . '/../../Utils/Constants.php';
  
      $type = $_POST['type'];

      if ($type == 0) {
        $merchant = $_POST["merchant"]; 
        $category = $_POST["category"];
        $amount = $_POST["amount"];
        $notes = $_POST["notes"];

        // User input check
        if (empty($merchant) || empty($category) || empty($amount)) {

            header("Location: /dashboard");
            exit();
        }
        else {
      
          $userId = $_SESSION['userId'];
          $date = date('Y-m-d H:i:s');
          $expense_obj = new Expense(null, $userId, null, $merchant, $amount, $notes, $category, $date, null);
          $expense_controller = new ExpenseController();
    
          $result = $expense_controller->create($expense_obj);

          if ($result === SUCCESS) {
            header("Location: /dashboard?expense=success");
            exit();
          }
          else if ($result === ER_PARSE_ERROR) {
            header("Location: /dashboard?error=invalidsql");
            exit();
          }
          else {
            header("Location: /dashboard?error=invalid");
            exit();
          }
        }
      }
      else if ($type == 1) {
        $amount = $_POST["amount"];

        // User input check
        if (empty($amount)) {

            header("Location: /new-transaction?error=emptyAmount");
            exit();
        }
        else {
      
          $userId = $_SESSION['userId'];
          $date = date('Y-m-d H:i:s');
          $revenue_obj = new Revenue(null, $userId, $amount, $date);
          $revenue_controller = new RevenueController();
    
          $result = $revenue_controller->create($revenue_obj);
          if ($result === SUCCESS) {
            header("Location: /dashboard?revenue=success");
            exit();
          }
          else if ($result === ER_PARSE_ERROR) {
            header("Location: /dashboard?error=invalidsql");
            exit();
          }
          else {
            header("Location: /dashboard?error=invalid");
            exit();
          }
        }
      }
      else {
        header("Location: /dashboard?error=unknown");
        exit();
      }
    }
    else {
        header("Location: /signup");
        exit();
    }