<link type="text/css" rel="stylesheet" href="../styles/header.css">
<header class="navbar">
  <label for="hamburger">&#9776;</label>
  <input type="checkbox" id="hamburger"/>
  <a id="title" href='/'><span> $ Budget App</span></a>
  <?php
  if (isset($_SESSION['userUid'])) {
    // User logged in
    echo '<ul class="menu">
          <label id="close">&#10006;</label>
          <a class="nav-link" href="/profile"><img src=\'../media/profile.svg\' width=30 height=35/>Profile</a>
          <a class="nav-link" href="/dashboard"><img src=\'../media/dashboard.svg\' width=30 height=35/>Dashboard</a>
          <a class="nav-link" href="/transactions"><img src=\'../media/transactions.svg\' width=30 height=35/>Transactions</a>
          <a class="nav-link" href="/trends"><img src=\'../media/trend.svg\' width=30 height=35/>Trends</a>
          <a class="nav-link" href="/transactions"><img src=\'../media/settings.svg\' width=30 height=35/>Settings</a>
          <form class="main-button" action="../../includes/logout.inc.php" method="post">
          <img src=\'../media/logout.svg\' width=30 height=35/><input type="submit" name="logout-submit" value="Logout">
          </form>
          </ul>
          
          <script>
          document.querySelector("#close").addEventListener("click", function() {
          document.querySelector("#hamburger").checked = false;
          })
          </script>
          ';
  } else {
    // NOT logged in
  }
  ?>
</header>
