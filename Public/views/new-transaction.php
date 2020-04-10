<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preload" href="../fonts/regular.otf" as="font" type="font/otf" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:,">
    <link type="text/css" rel="stylesheet" href="../styles/styles.css">
    <script src="../web-components/budget-card.js"></script>
    <script src="../web-components/budget-item.js"></script>
    <script src="../web-components/budgetDrawer.js"></script>
    <style>
        select {
            width: 300px;
            height: 38px;
            margin-bottom: 1rem;
            border-radius: 5px;
            font-family: Brandon;
            font-size: 18px;
        }

        input[type="button"],
        input[type="submit"] {
            width: 125px;
            margin: 15px;
        }

        textarea {
            width: 300px;
            height: 150px;
            margin: 2px;
        }
        .button-group {
            display: flex;
        }
    </style>
    <title>add</title>
</head>

<body>
    <div class="content">
        <?php
        require './header.php';
        ?>
        <?php
        if (!isset($_SESSION['userUid'])) {
            header("Location: /login");
        }
        ?>
        <div class="container">
            <form class="form-group" action="../includes/transaction.inc.php" method="post" id="transaction-form">
                <h1 class="headings">Add Transaction</h1>
                <div>
                    <label for="name">Merchant </label>
                    <input type="text" name="merchant" required>
                </div>
                <div>
                    <label for="category">Category </label>
                    <select name="category">
                        <option value="housing">Housing</option>
                        <option value="transportation">Transporation</option>
                        <option value="food">Food & Dining</option>
                        <option value="medical">Medical</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="shopping">Shopping</option>
                    </select>
                </div>
                <div>
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" required>
                </div>
                <div>
                    <label for="notes">Notes</label>
                    <textarea name="notes" form="transaction-form"></textarea>
                </div>
                <div class="button-group">
                    <input type="button" value="Cancel" onClick="javascript:history.back()">
                    <input type="submit" name="transaction-submit" value="Add" required>
                </div>

            </form>

        </div>
    </div>
</body>

</html>