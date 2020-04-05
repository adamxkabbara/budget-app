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
    <script src="../web-components/budget-card.js"></script>
    <link type="text/css" rel="stylesheet" href="../styles/styles.css">
</head>
<style>
    .graph-title {
        text-align: left;
        margin: 1.2rem 0 1rem .5rem;
        font-size: 18px;
    }

    budget-card {
        margin: 10px;
    }

    .chart {
        margin: 10px;
    }
</style>

<body>
    <div class="content">
        <?php
        require './header.php';
        ?>
        <budget-card card header="Spending vs Earnings">
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
                        data: [89, 200],
                        backgroundColor: ['#ffd640', '#abe663'],
                    }, ]
                },
                options: {
                    maintainAspectRatio: true,
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
                    }
                }
            });
        </script>

        <budget-card href='/transactions' type="View Transactions" header="Spending Breakdown">
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
                responsive: false,
                maintainAspectRatio: true
            }
            var ctx = document.getElementById('spending-breakdown').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: options
            });
        </script>

        <budget-card card header="Monthly Spending Trend">
            <div class="chart" slot="body">
                <canvas id="spending-trend"></canvas>
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
                        data: [120, 100, 120, 200, 300, 120, 200],
                    }]
                },
                options: {
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