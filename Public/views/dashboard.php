<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="preload" href="../fonts/regular.otf" as="font" type="font/otf" crossorigin>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#66dea5">
  <link rel="icon" href="data:,">
  <link type="text/css" rel="stylesheet" href="../styles/styles.css">
  <script src="../web-components/budgetDrawer.js"></script>
  <style>
    fab-button{
    }
    fab-item {
      background-color: #5fca97;
    }
    fab-item:hover {
      background-color: #76dea5;
    }
  </style>
  <title>dashboard</title>
</head>

<body>
  <?php
  require './header.php';
  ?>

  <script src="../scripts/index.js"></script>

  <?php
  if (isset($_SESSION['userUid'])) {
    echo '<h1>' . $_SESSION['userUid'] . '</h1>';
    echo '<div id=getTime></div>';
  } else {
    echo '<h1>' . $_SESSION['userUid'] . '</h1>';
    echo '<h1>NOT SIGNED IN</h1>';
  }
  ?>
  <fab-button>
    <fab-item href="/login">Revenue</fab-item>
    <fab-item href="/login">Expense</fab-item>
  </fab-button>
  <?php
  require './footer.php';
  ?>
</body>

</html>