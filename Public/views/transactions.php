<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preload" href="../fonts/regular.otf" as="font" type="font/otf" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:,">
    <link type="text/css" rel="stylesheet" href="../styles/styles.css">
    <script src="../web-components/budget-card.js"></script>
    <script src="../web-components/budget-item.js"></script>
</head>
<style>
    budget-card {
        margin: 0 25px;
    }

    ul {
        padding: 0;
    }
</style>

<body>
    <div class="content">
        <?php
        require './header.php';
        include_once __DIR__ . '/../../Controllers/ExpenseController.php';
        include_once __DIR__ . '/../../Controllers/RevenueController.php';

        $expense_controller = new ExpenseController();
        $transactions = $expense_controller->getAll($_SESSION['userId']);

        foreach ((array)$transactions as $item) {
            $date = date("M d", strtotime($item->date));
            echo "<budget-item date=\"{$date}\" category=\"{$item->category}\" value=\"{$item->amount}\">{$item->merchant}</budget-item>";
        }
        ?>
    </div>
    <?php
    require './footer.php';
    ?>
</body>

</html>