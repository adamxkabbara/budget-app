<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preload" href="../fonts/regular.otf" as="font" type="font/otf" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:,">
    <link type="text/css" rel="stylesheet" href="../styles/styles.css">
    <script src="../web-components/budget-card.js"></script>
    <script src="../web-components/budget-item.js"></script>
    <script src="../web-components/budgetDrawer.js"></script>
    <style>
        form.form-group {
            border: none;
        }

        select {
            width: 300px;
            height: 38px;
            margin-bottom: 1rem;
            border-radius: 5px;
            font-family: Brandon;
            font-size: 18px;
        }

        input[type="button"],
        input[type="submit"] {
            margin: 5px;
        }

        textarea {
            width: 300px;
            height: 150px;
        }

        .button-group,
        .toggle-field {
            display: flex;
            margin: 10px 0;
        }

        .toggle-field {
            margin-bottom: 30px;
        }

        .toggle-field input[type="radio"] {
            opacity: 0;
            position: fixed;
            width: 0;
        }

        .toggle-field label {
            background-color: var(--text-body-light);
            color: var(--primary-color);
            border: solid .1rem var(--primary-color);
            text-align: center;
            padding: 5px 10px;
            transition: all 0.2s ease-in-out;
        }

        .toggle-field input[type="radio"]:checked+label {
            background-color: var(--primary-color);
            color: var(--text-body-light);
            box-shadow: none;
        }

        .hidden {
            display: none;
        }

        label[for="expense"] {
            border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
        }

        label[for="revenue"] {
            border-bottom-right-radius: 5px;
            border-top-right-radius: 5px;
        }
    </style>
    <script>
        function on_change(el) {
            if (el.target.value === '0') {
                showExpense()
            } else {
                showRevenue()
            }
        }

        function showExpense() {
            document.getElementById('revenue-form').classList.add('hidden');
            document.getElementById('expense-form').classList.remove('hidden');
        }

        function showRevenue() {
            document.getElementById('revenue-form').classList.remove('hidden');
            document.getElementById('expense-form').classList.add('hidden');
        }
    </script>
</head>

<body>
    <div class="content">
        <?php
        require './header.php';
        ?>
        <?php
        if (!isset($_SESSION['userUid'])) {
            header("Location: /login");
        }
        ?>
        <div class="container">
            <form class="form-group" action="" method="post" id="add-form">
                <div class="toggle-field">
                    <input id="expense" type="radio" value="0" name="type" oninput="on_change(event)"><label for="expense">Expense</label>
                    <input id="revenue" type="radio" value="1" name="type" oninput="on_change(event)"><label for="revenue">Revenue</label>
                </div>
                <div id="expense-form">
                    <label for="name">Merchant </label>
                    <input type="text" name="name" required>
                    <label for="category">Category </label>
                    <select name="category">
                        <option value="0">Housing</option>
                        <option value="1">Transporation</option>
                        <option value="2">Food & Dining</option>
                        <option value="3">Medical</option>
                        <option value="4">Entertainment</option>
                        <option value="5">Shopping</option>
                    </select>
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" step=".01" required>
                    <label for="notes">Notes</label>
                    <textarea name="notes" form="add-form"></textarea>
                </div>
                <div id="revenue-form" class="hidden">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" step=".01" required>
                </div>
                <div class="button-group">
                    <input type="button" value="Cancel" onClick="javascript:history.back()">
                    <input type="submit" name="signup-submit" value="Add" required>
                </div>
            </form>
            <script>
                document.getElementsByName('type')[0].checked = <?php echo (isset($_GET['type']) && $_GET['type'] === '0') ? 'true; showExpense();' : 'false; showRevenue();'; ?>
                document.getElementsByName('type')[1].checked = <?php echo (isset($_GET['type']) && $_GET['type'] === '1') ? 'true; showRevenue();' : 'false; showExpense();'; ?>
            </script>
        </div>
    </div>
</body>

</html>