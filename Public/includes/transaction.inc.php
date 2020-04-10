<?php
    session_start();

    if (isset($_POST["transaction-submit"])) {

        // include files
        include_once __DIR__ . '/../../Controllers/ExpenseController.php';
        include_once __DIR__ . '/../../Utils/Constants.php';
    
        $merchant = $_POST["merchant"]; 
        $category = $_POST["category"];
        $amount = $_POST["amount"];
        $notes = $_POST["notes"];

        // User input check
        if (empty($merchant) || empty($category) || empty($amount) || empty($notes)) {

            header("Location: /signup?error=emptyfields&uid=$username&mail=$email");
            exit();
        }
        else {
      
            $userId = $_SESSION['userUid'];
            $date = date("Y-m-d H:i:s");
            $expense_obj = new Expense(null, $userID, null, $merchant, $amount, $category, $notes, $date, null);
            $expense_controller = new ExpenseController();
      
            $result = $expense_controller->create($expense_obj);
            echo $result;
            echo $userId;
            if ($result === SUCCESS) {
              //header("Location: /dashboard?transaction=success");
              exit();
            }
            else if ($result === ER_PARSE_ERROR) {
              //header("Location: /dashboard?error=invalidsql");
              exit();
            }
            else {
              //header("Location: /dashboard?error=invalid");
              exit();
            }
          }
    }
    else {
        header("Location: /signup");
        exit();
    }