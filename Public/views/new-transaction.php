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
            document.getElementById('name-input').classList.remove('hidden');
            document.getElementById('category-input').classList.remove('hidden');
            document.getElementById('notes-input').classList.remove('hidden');

            document.querySelector('#name-input input').removeAttribute('disabled')
            document.querySelector('#category-input select').removeAttribute('disabled')
            document.querySelector('#notes-input textarea').removeAttribute('disabled')
        }

        function showRevenue() {
            document.getElementById('name-input').classList.add('hidden');
            document.getElementById('category-input').classList.add('hidden');
            document.getElementById('notes-input').classList.add('hidden');

            document.querySelector('#name-input input').setAttribute('disabled', true);
            document.querySelector('#category-input select').setAttribute('disabled', true);
            document.querySelector('#notes-input textarea').setAttribute('disabled', true);
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
            <form class="form-group" action="../includes/transaction.inc.php" method="post" id="add-form">
                <div class="toggle-field">
                    <input id="expense" type="radio" value="0" name="type" oninput="on_change(event)"><label for="expense">Expense</label>
                    <input id="revenue" type="radio" value="1" name="type" oninput="on_change(event)"><label for="revenue">Revenue</label>
                </div>
                <div id="name-input">
                    <label for="merchant">Merchant </label>
                    <input type="text" name="merchant" required>
                </div>
                <div id="category-input">
                    <label for="category">Category </label>
                    <select name="category">
                        <option value="housing">Housing</option>
                        <option value="transportation">Transporation</option>
                        <option value="food">Food & Dining</option>
                        <option value="medical">Medical</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="shopping">Shopping</option>
                    </select>
                </div>
                <div id="amount-input">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" step=".01">
                </div>
                <div id="notes-input">
                    <label for="notes">Notes</label>
                    <textarea name="notes"></textarea>
                </div>

                <div class="button-group">
                    <input type="button" value="Cancel" onClick="javascript:history.back()">
                    <input type="submit" name="transaction-submit" value="Add">
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