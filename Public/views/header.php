<?php
session_start();
?>
<header>
  <?php
  if (isset($_SESSION['userId'])) {
    // User logged in
    echo '<form action="./includes/logout.inc.php" method="post">
                  <input type="submit" name="logout-submit" value="Logout">
                </form>';
  } else {
    // NOT logged in
  }
  ?>
</header>