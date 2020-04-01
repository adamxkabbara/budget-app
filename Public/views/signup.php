<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <form action="../includes/signup.inc.php" method="post">
    <div>
      <label for="username">Username: </label>
      <input type="text" name="uid" placeholder="Username">
    </div>
    <div>
      <label for="email">Email: </label>
      <input type="email" name="email" placeholder="E-mail">
    </div>
    <div>
      <label for="password">Password: </label>
      <input type="password" name="password" placeholder="Password">
    </div>
    <div>
      <label for="password">Repeat Password: </label>
      <input type="password" name="password-repeat" placeholder="Repeat Password">
    </div>
    <input type="submit" name="signup-submit" value="submit">
  </form>

</body>
</html>