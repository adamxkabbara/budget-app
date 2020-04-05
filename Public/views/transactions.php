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
        ?>
                <?php
                    $transactions = [
                        ['date' => '12/13', 'category' => 'category', 'transaction'=> 'Transaction', 'value' => 30.21],
                        ['date' => '12/13', 'category' => 'category', 'transaction'=> 'Transaction', 'value' => 30.21],
                        ['date' => '12/13', 'category' => 'category', 'transaction'=> 'Transaction', 'value' => 30.21],
                        ['date' => '12/13', 'category' => 'category', 'transaction'=> 'Transaction', 'value' => 30.21],
                        ['date' => '12/13', 'category' => 'category', 'transaction'=> 'Transaction', 'value' => 30.21],
                        ['date' => '12/13', 'category' => 'category', 'transaction'=> 'Transaction', 'value' => 30.21],
                    ];
                    foreach($transactions as $item){
                        echo "<budget-item date=\"{$item['date']}\" category=\"{$item['category']}\" value=\"{$item['value']}\">{$item['transaction']}</budget-item>";
                    }
                ?>
    </div>
    <?php
    require './footer.php';
    ?>
</body>

</html>