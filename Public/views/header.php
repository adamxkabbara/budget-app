<link type="text/css" rel="stylesheet" href="../styles/header.css">
<header class="navbar">
  <label for="hamburger">&#9776;</label>
  <input type="checkbox" id="hamburger"/>
  <h1 id="title">Budget App</h1>
  <?php
  if (isset($_SESSION['userUid'])) {
    // User logged in
    echo '<ul class="menu">
          <a href="/dashboard"><img src=\'../media/trend.svg\' width=30 height=35/>Profile</a>
          <a href="/dashboard"><img src=\'../media/trend.svg\' width=30 height=35/>Dashboard</a>
          <a href="/transactions"><img src=\'../media/transaction.svg\' width=30 height=35/>Transactions</a>
          <a href="/trends"><img src=\'../media/trend.svg\' width=30 height=35/>Trends</a>
          <a href="/transactions"><img src=\'../media/transaction.svg\' width=30 height=35/>Settings</a>
          <form class="main-button" action="../../includes/logout.inc.php" method="post">
          <img src=\'../media/logout.svg\' width=30 height=30/><input type="submit" name="logout-submit" value="Logout">
          </form>
          </ul>';
  } else {
    // NOT logged in
  }
  ?>
</header>