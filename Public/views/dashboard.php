<?php
session_start();

if (!isset($_SESSION['userUid'])) {
    header("Location: /login");
}
include_once __DIR__ . '/../../Controllers/ExpenseController.php';
include_once __DIR__ . '/../../Controllers/RevenueController.php';

$expense_controller = new ExpenseController();
$transactions = $expense_controller->getAll($_SESSION['userId']);
$chartData = $expense_controller->spending_breakdown($_SESSION['userId']);
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
    <link type="text/css" rel="stylesheet" href="../styles/dashboard.css">
    <script src="../web-components/budget-card.js"></script>
    <script src="../web-components/budget-item.js"></script>
    <script src="../web-components/budgetDrawer.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="content">
        <?php
        require './header.php';
        ?>
        <div class="container">
            <budget-card card header="Quick Summary">
                <div slot="body">
                    <budget-item no-border value="<?php echo $expense_controller->sumAmount($_SESSION['userId'], 0); ?>">Total Spent Today</budget-item>
                    <budget-item no-border value="<?php echo $expense_controller->sumAmount($_SESSION['userId'], 1); ?>">Total Spent in <?php echo date('F'); ?></budget-item>
                </div>
            </budget-card>

            <budget-card href='/transactions' header="Recent Transactions" type='View Transactions'>
                <div slot="body">
                    <?php
                    if ($transactions) {
                        foreach (array_splice($transactions, 0, 5) as $item) {
                            $date = date("M d", strtotime($item->date));
                            echo "<budget-item date=\"{$date}\" category=\"{$item->category}\" value=\"{$item->amount}\">{$item->merchant}</budget-item>";
                        }
                    } else {
                        echo "<p>No recent transactions</p>";
                    }
                    ?>
                </div>
            </budget-card>

            <budget-card href='/trends' header="Latest <?php echo date('F'); ?> Trends" type="View Trends">
                <div class="chart" slot="body">
                    <canvas id="spending-breakdown" height=150></canvas>
                </div>
            </budget-card>

            <script>
                Chart.defaults.global.legend.labels.usePointStyle = true;
                data = {
                    datasets: [{
                        data: [<?php echo implode(',', $chartData); ?>],
                        backgroundColor: ['#f29d9d', '#ffd640', '#abe663', '#66e3b7', '#a7e4fa', '#aba1f7'],
                    }, ],
                    labels: [
                        'Housing',
                        'Transportation',
                        'Food & Dining',
                        'Medical',
                        'Entertainment',
                        'Shopping'
                    ]
                };
                options = {
                    legend: {
                        position: 'right'
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
                var ctx = document.getElementById('spending-breakdown').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: options
                });
            </script>
        </div>
    </div>
    <fab-button>
        <fab-item href="/new-transaction?type=1">Revenue</fab-item>
        <fab-item href="/new-transaction?type=0">Expense</fab-item>
    </fab-button>
</body>

</html>