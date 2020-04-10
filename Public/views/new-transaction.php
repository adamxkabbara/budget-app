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
            <form class="form-group" action="" method="post">
                <h1 class="headings">Add Transaction</h1>
                <div>
                    <label for="name">Transaction Name </label>
                    <input type="text" name="name" required>
                </div>
                <div>
                    <label for="category">Category </label>
                    <select name="category">
                        <option value="0">Housing</option>
                        <option value="1">Transporation</option>
                        <option value="2">Food & Dining</option>
                        <option value="3">Medical</option>
                        <option value="4">Entertainment</option>
                        <option value="5">Shopping</option>
                    </select>
                </div>
                <div>
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" required>
                </div>
                <div class="button-group"><input type="button" value="Cancel" onClick="javascript:history.back()"><input type="submit" name="signup-submit" value="Add" required></div>

            </form>

        </div>
    </div>
</body>

</html>