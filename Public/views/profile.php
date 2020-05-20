<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preload" href="../fonts/regular.otf" as="font" type="font/otf" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:,">
    <link type="text/css" rel="stylesheet" href="../styles/styles.css">
    <link type="text/css" rel="stylesheet" href="../styles/profile.css">
    <script src="../web-components/budget-card.js"></script>
</head>

<body>
    <div class="content">
        <?php
        require './header.php';
        include_once __DIR__ . '/../../Controllers/UserController.php';

        $uid = $_SESSION['userUid'];
        $user_controller = new UserController();
        $user = $user_controller->get($uid);
        ?>
        <budget-card card header="<span class='heading'>My Profile </span>">
            <div slot="body">
                <?php
                $errorMapping = [
                    'userTaken' => 'User is taken!',
                    'invalidsql' => 'Oops! An error occured!',
                    'invaliduid' => 'Invalid username!',
                    'invalimail' => 'Invalid email!',
                    'invalimailuid' => 'Invalid email!',
                    'emptyfields' => 'Some fields were left empty!',
                    'passwordmalformed' => 'Password needs 1 uppercase, 1 lowercase, and 1 digit!',
                    'passwordcheck' => 'Passwords don\'t match!',
                    '' => ''
                ];
                if (isset($_GET['error'])) {
                    $errorMapping[$_GET['error']];

                    echo '<p class="error">' . $errorMapping[$_GET["error"]] . '</p>';
                }
                ?>
                <form action="../includes/profile.inc.php" method="post">
                    <div class="list"><span class="category">Username:</span><input class="value" type="text" name="username" value="<?php echo $user->username; ?>" readonly></div>
                    <div class="list"><span class="category">Email:</span><input class="value" type="email" name="email" value="<?php echo $user->email; ?>" readonly></div>
                    <div class="list"><span class="category">Password:</span><input class="value" type="password" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" readonly></div>
                    <div class="list hidden" id="repeat-password"><span class="category">Confirm Password:</span><input class="value" type="password" name="password-repeat" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" readonly></div>
                    <input type="hidden" id="cancel" value="Cancel"> </input>
                    <input type="hidden" id="save" value="Save" name="profile-submit"> </input>
                    <input type="button" id="edit" value="Edit"> </input>
                </form>
            </div>
        </budget-card>

        <script>
            document.querySelector('#edit').addEventListener('click', function() {
                document.getElementById('edit').type = 'hidden';
                document.getElementById('save').type = 'submit';
                document.getElementById('cancel').type = 'button';

                var inputs = document.querySelectorAll('input.value');
                inputs.forEach(input => input.readOnly = false);
                inputs[0].focus();
                document.querySelector('#repeat-password').classList.remove('hidden');
            })

            document.querySelector('#cancel').addEventListener('click', function() {
                document.getElementById('edit').type = 'button';
                document.getElementById('save').type = 'hidden';
                document.getElementById('cancel').type = 'hidden';
                document.querySelector('#repeat-password').classList.add('hidden');
                
                var inputs = document.querySelectorAll('input.value');
                inputs[0].value = "<?php echo $user->username; ?>";
                inputs[1].value = "<?php echo $user->email; ?>";
            })
        </script>
    </div>
    <?php
    require './footer.php';
    ?>
</body>

</html>