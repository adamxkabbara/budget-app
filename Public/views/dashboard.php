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
        fab-button {
            position: fixed;
            right: 20px;
            bottom: 20px;
            box-shadow: 0 5px 11px 4px rgba(0, 0, 0, 0.18), 0 4px 12px -7px rgba(0, 0, 0, 0.15);
            border-radius: 50%;
        }

        fab-button:hover {
            transition-duration: 0.3s;
            transform: scale(1.05);
            box-shadow: 0 5px 15px 9px rgba(0, 0, 0, 0.18), 0 4px 17px 0px rgba(0, 0, 0, 0.15);
        }

        fab-item {
            box-shadow: 0 3px 10px 0px rgba(0, 0, 0, 0.18), 0 3px 20px 0px rgba(0, 0, 0, 0.15);
            transition-duration: .3s;
            background-color: #5fca97;
            border-radius: 10px;
            margin: 10px 0;
        }

        fab-item:hover {
            background-color: #76dea5;
        }

        budget-card {
            margin: 0px 25px;
            max-width: 900px;
        }

        ul {
            padding: 0px;
        }

        .chart {
            margin: 10px;
        }
    </style>
    <title>dashboard</title>
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
            <budget-card card header="Quick Summary">
                <div slot="body">
                    <budget-item no-border value="30.32">Total Spent Today</budget-item>
                    <budget-item no-border value="50.32">Total Spent this Month</budget-item>
                </div>
            </budget-card>

            <budget-card href='/transactions' header="Recent Transactions" type='View Transactions'>
                <div slot="body">
                    <budget-item date="12/13" category="Category" value="30.21">Transaction</budget-item>
                    <budget-item date="12/13" category="Category" value="50.22">Transaction</budget-item>
                    <budget-item no-border date="12/13" category="Category" value="20.88">Transaction</budget-item>
                </div>
            </budget-card>

            <budget-card href='/trends' header="Latest Trends" type="View Trends">
                <div class="chart" slot="body">
                    <canvas id="spending-breakdown" height=150></canvas>
                </div>
            </budget-card>

            <script>
                Chart.defaults.global.legend.labels.usePointStyle = true;
                data = {
                    datasets: [{
                        data: [10, 20, 30, 100, 99, 20],
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
        <fab-item href="/new-transaction">Revenue</fab-item>
        <fab-item href="/new-transaction">Expense</fab-item>
    </fab-button>
</body>

</html>