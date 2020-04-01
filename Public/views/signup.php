<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="preload" href="../../fonts/regular.otf" as="font" type="font/otf" crossorigin>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="data:,">
  <link type="text/css" rel="stylesheet" href="../../styles/styles.css">
</head>

<body>
  <form class="form-group" action="../../includes/signup.inc.php" method="post">
    <h1 class="headings">Sign up</h1>
    <div>
      <label for="username">Username: </label>
      <input type="text" name="uid">
    </div>
    <div>
      <label for="email">Email: </label>
      <input type="email" name="email">
    </div>
    <div>
      <label for="password">Password: </label>
      <input type="password" name="password" required>
    </div>
    <div>
      <label for="password">Repeat Password: </label>
      <input type="password" name="password-repeat" required>
    </div>
    <input type="submit" name="signup-submit" value="Sign up" required>
  </form>
  <p>Already have an account? <a href="login.php"> Sign in!</a></p>
  <?php
  require './footer.php';
  ?>
</body>

</html>