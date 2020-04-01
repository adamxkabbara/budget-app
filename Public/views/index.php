<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <link rel="preload" href="fonts/regular.otf" as="font" type="font/otf" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:,">
    <link type="text/css" rel="stylesheet" href="styles/styles.css">
</head>

<body>
  <?php
  require './header.php';
  ?>

  <script src="./index.js"></script>

  <?php
  if (isset($_SESSION['userUid'])) {
    echo '<h1>' . $_SESSION['userUid'] . '</h1>';
    echo '<div id=getTime></div>';
  } else {
    echo '<h1>' . $_SESSION['userUid'] . '</h1>';
    echo '<h1>NOT SIGNED IN</h1>';
  }
  ?>

  <?php
  require './footer.php';
  ?>
</body>
</html>