<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
    <header>
      <?php
        if (isset($_SESSION['userId'])) {
          // User logged in
          echo '<form action="./includes/logout.inc.php" method="post">
                  <input type="submit" name="logout-submit" value="Logout">
                </form>';
        }
        else {
          // NOT logged in
        }
      ?>
    </header>