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
    <link type="text/css" rel="stylesheet" href="../styles/transactions.css">
    <script src="../web-components/budget-card.js"></script>
    <script src="../web-components/budget-item.js"></script>
    <script src="../web-components/budgetDrawer.js"></script>
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
                        <option value="Housing">Housing</option>
                        <option value="Transportation">Transporation</option>
                        <option value="Food">Food & Dining</option>
                        <option value="Medical">Medical</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Shopping">Shopping</option>
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