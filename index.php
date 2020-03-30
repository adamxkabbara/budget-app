<?php
  require './header.php';
?>

<script src="./index.js"></script>

<?php
  if (isset($_SESSION['userUid'])) {
    echo '<h1>'.$_SESSION['userUid'].'</h1>';
    echo '<div id=getTime></div>';
  }
  else {
    echo '<h1>'.$_SESSION['userUid'].'</h1>';
    echo '<h1>NOT SIGNED IN</h1>';
  }
?>

<?php
  require './footer.php';
?>