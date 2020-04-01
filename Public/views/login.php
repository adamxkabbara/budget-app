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
  <form action="../../includes/login.inc.php" method="post">
    <h1 class="headings">Login</h1>
    <label for="username">Username </label>
    <input type="text" name="mailuid" id="username" required>
    <label for="password">Password: </label>
    <input type="password" name="pwd" id="password" required>

    <input type="submit" name="login-submit" value="submit">
  </form>
  <p>Don't have an account? <a href="signup.php"> Sign up </a></p>
</body>

</html>