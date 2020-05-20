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
    <script src="../web-components/budget-card.js"></script>
</head>
<style>
    budget-card {
        margin: 0 25px;
    }

    ul {
        padding: 0;
    }

    .list {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .category {
        text-align: left;
        padding: 10px;
        color: var(--secondary-color);
    }

    .value {
        text-align: right;
        padding: 10px;
        color: var(--primary-dark-color);
    }

    #save,
    #edit, #cancel {
        background-color: var(--primary-color);
        padding: 8px 45px;
        border-radius: 5px;
        margin: 10px;
        display: inline;
    }

    #cancel {
        background-color: var(--text-body);
    }

    input {
        border: none;
    }

    .hidden {
        display: none;
    }
</style>

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
                <form>
                    <div class="list"><span class="category">Username:</span><input class="value" type="text" value="<?php echo $user->username; ?>" readonly></div>
                    <div class="list"><span class="category">Email:</span><input class="value" type="email" value="<?php echo $user->email; ?>" readonly></div>
                    <div class="list"><span class="category">Password:</span><input class="value" type="password" value="&#9679;&#9679;&#9679;&#9679;&#9679;" readonly></div>
                    <input type="hidden" id="cancel" value="Cancel"> </input>
                    <input type="hidden" id="save" value="Save"> </input>
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
            })

            document.querySelector('#cancel').addEventListener('click', function() {
                document.getElementById('edit').type = 'button';
                document.getElementById('save').type = 'hidden';
                document.getElementById('cancel').type = 'hidden';
            })
        </script>
    </div>
    <?php
    require './footer.php';
    ?>
</body>

</html>