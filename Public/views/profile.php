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

    .list {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .category {
        text-align: left;
        padding: 10px;
        color: var(--secondary-color);
    }

    .value {
        text-align: right;
        padding: 10px;
        color: var(--primary-dark-color);
    }
</style>

<body>
    <div class="content">
        <?php
        require './header.php';
        include_once __DIR__ . '/../../Controllers/UserController.php';

        $uid = $_SESSION['userUid'];
        $user_controller = new UserController();
        $user = $user_controller->get($uid);
        ?>
        <budget-card card header="My Profile">
            <div slot="body">
                <div class="list"><span class="category">Username:</span><span class="value"><?php echo $user->username; ?></span></div>
                <div class="list"><span class="category">Email:</span><span class="value"><?php echo $user->email; ?></span></div>
                <div class="list"><span class="category">Password:</span><span class="value">&#9679;&#9679;&#9679;&#9679;&#9679;</span></div>
            </div>
        </budget-card>
    </div>
    <?php
    require './footer.php';
    ?>
</body>

</html>