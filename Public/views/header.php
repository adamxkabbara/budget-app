<header class="navbar">
  <?php
  if (isset($_SESSION['userUid'])) {
    // User logged in
    echo '<a href="/views/index.php">Dashboard</a>
          <form class="main-button" action="../../includes/logout.inc.php" method="post">
                  <input type="submit" name="logout-submit" value="Logout">
                </form>';
  } else {
    // NOT logged in
  }
  ?>
</header>