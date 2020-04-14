<?php
session_start();

include_once __DIR__ . '/../../Controllers/ExpenseController.php';
include_once __DIR__ . '/../../Controllers/RevenueController.php';

$expense_controller = new ExpenseController();
$spending_earning = $expense_controller->spending_earning($_SESSION['userId']);
$spending_breakdown = $expense_controller->spending_breakdown($_SESSION['userId']);
$monthly_spending_data = $expense_controller->monthly_spending($_SESSION['userId']);
$monthly_revenue_data = $expense_controller->monthly_revenue($_SESSION['userId']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preload" href="../fonts/regular.otf" as="font" type="font/otf" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:,">
    <script src="../web-components/budget-card.js"></script>
    <link type="text/css" rel="stylesheet" href="../styles/styles.css">
    <link type="text/css" rel="stylesheet" href="../styles/trends.css">
</head>

<body>
    <div class="content">
        <?php
        require './header.php';
        ?>
        <budget-card card header="<?php echo date('F') . ' Spendings vs Earnings'; ?>">
            <div class="chart" slot="body">
                <canvas id="spending-earned" height=100></canvas>
            </div>
        </budget-card>

        <script>
            var ctx = document.getElementById('spending-earned').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: ['Spent', 'Earned'],
                    datasets: [{
                        data: [<?php echo implode(',', $spending_earning); ?>],
                        backgroundColor: ['#ffd640', '#abe663'],
                    }, ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    "animation": {
                        "duration": 1,
                        "onComplete": function() {
                            var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';
                            ctx.fillStyle = '#676968';

                            this.data.datasets.forEach(function(dataset, i) {
                                var meta = chartInstance.controller.getDatasetMeta(i);
                                meta.data.forEach(function(bar, index) {
                                    var data = dataset.data[index];
                                    ctx.fillText('$' + data, bar._model.x + 20, bar._model.y + 5);
                                });
                            });
                        }
                    }
                }
            });
        </script>

        <budget-card href='/transactions' type="View Transactions" header="<?php echo date('F') . ' Spending Breakdown'; ?>">
            <div class="chart" slot="body">
                <canvas id="spending-breakdown" height=150></canvas>
            </div>
        </budget-card>

        <script>
            Chart.defaults.global.legend.labels.usePointStyle = true;
            data = {
                datasets: [{
                    data: [<?php echo implode(',', $spending_breakdown); ?>],
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

        <budget-card card header="Monthly Spending Trend">
            <div class="chart" id="chart-monthly-spending" slot="body">
                <div class="scrollable">
                    <canvas id="spending-trend"></canvas>
                </div>
            </div>
        </budget-card>
        <script>
            var ctx = document.getElementById('spending-trend').getContext('2d');
            var myChart2 = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        backgroundColor: 'rgba(0, 186, 219, 0.36)',
                        data: [<?php echo implode(',', $monthly_spending_data); ?>],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                        }]
                    }
                }
            });
        </script>

        <budget-card card header="Cash Flow">
            <div class="chart" id="chart-cash-flow" slot="body">
                <div class="scrollable">
                    <canvas id="cash-flow" height=200></canvas>
                </div>
            </div>
        </budget-card>

        <script>
            var ctx = document.getElementById('cash-flow').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Spent',
                        data: [<?php echo implode(',', $monthly_spending_data); ?>],
                        backgroundColor: '#66e3b7',
                    }, {
                        label: 'Earned',
                        data: [<?php echo implode(',', $monthly_revenue_data); ?>],
                        backgroundColor: '#aba1f7',
                    }, ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                        }]
                    },
                    layout: {
                        padding: {
                            top: 25
                        }
                    },
                    "animation": {
                        "duration": 1,
                        "onComplete": function() {
                            var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';
                            ctx.fillStyle = '#676968';

                            this.data.datasets.forEach(function(dataset, i) {
                                var meta = chartInstance.controller.getDatasetMeta(i);
                                meta.data.forEach(function(bar, index) {
                                    var data = dataset.data[index];
                                    if (data != 0) ctx.fillText('$' + data, bar._model.x, bar._model.y - 5);
                                });
                            });
                        }
                    }
                }
            });
        </script>
    </div>
    <?php
    require './footer.php';
    ?>
</body>

</html>