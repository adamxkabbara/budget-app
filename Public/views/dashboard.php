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
        margin: 0px 25px;
    }

    ul {
        padding: 0px;
    }
</style>

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
        <budget-card card>
            <div slot="body">
                <budget-item no-border item-name="Total Spent Today" value="30.32"></budget-item>
                <budget-item no-border item-name="Total Spent this Month" value="50.32"></budget-item>
            </div>
        </budget-card>

        <budget-card href='/transactions' header="Recent Transactions" type='View Transactions'>
            <div slot="body">
                <budget-item date="12/13" item-name="Transaction" category="Category" value="30.21"></budget-item>
                <budget-item date="12/13" item-name="Transaction" category="Category" value="50.22"></budget-item>
                <budget-item no-border date="12/13" item-name="Transaction" category="Category" value="20.88"></budget-item>
            </div>
        </budget-card>

        <budget-card href='/trends' header="Latest Trends" type="View Trends">
            <div slot="body"></div>
        </budget-card>
    </div>
    <?php
    require './footer.php';
    ?>
</body>

</html>