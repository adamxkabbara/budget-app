<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="preload" href="../fonts/regular.otf" as="font" type="font/otf" crossorigin>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="data:,">
  <link type="text/css" rel="stylesheet" href="../styles/styles.css">
</head>

<body>
  <form class="form-group" action="../includes/login.inc.php" method="post">
    <h1 class="headings">Login</h1>
    <?php
    $errorMapping = [
      'wrongpwd' => 'Invalid password!',
      'nouser' => 'Oops! No such user exists!',
      'internalerror' => 'Something went wrong!',
      'emptyfields' => 'Some fields were left empty',
      '' => ''
    ];
    if (isset($_GET['error'])) {
      $errorMapping[$_GET['error']];
      echo '<p class="error">' . $errorMapping[$_GET["error"]] . '</p>';
    }
    ?>
    <label for="username">Username </label>
    <input type="text" name="mailuid" id="username" required>
    <label for="password">Password: </label>
    <input type="password" name="pwd" id="password" required>

    <input type="submit" name="login-submit" value="Login">
  </form>
  <p>Don't have an account? <a href="/signup"> Sign up </a></p>
  <?php
  require './footer.php';
  ?>
</body>

</html>