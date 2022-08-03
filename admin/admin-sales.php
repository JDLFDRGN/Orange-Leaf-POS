<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Sales</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script src="../js/functions.js" defer></script>
</head>
<?php
   include '../sql/queries.php';

    $account = $_SESSION['account'];

    if(!$account) header('Location: admin-login.php');
    else if(!$admin->adminEnabled($account['admin_id'])) header('Location: ../disabled.php');
    
    $admin->adminSetActive($account['admin_id']);
?>
<body>
    <section class="min-height-full relative">
        <?php
            require('admin-header.php');
            require('admin-side-navigation.php');
        ?>
        <div class="mt-20 flex justify-evenly flex-col">
            <form id="span-cotainer" class="mb-4 pl-16" method='post' action="admin-get-sales.php">  
                <div class=" flex items-center w-fit h-full" style="padding-left: 10em;">
                    <h1 class=" capitalize font-bold text-4xl">revenue: </h1>
                    <select id="option-select" class="border-show ml-4 w-40 py-2 rounded-md" name="option" onchange="drawChart()">
                        <option class="border-show capitalize" value="all">All Time</option>
                        <option class="border-show capitalize" value="day">this day</option>
                        <option class="border-show capitalize" value="month">this month</option>
                        <option class="border-show capitalize" value="year">this year</option>
                    </select>
                </div>
            </form>
            <div class="flex justify-evenly mt-8">
                <div class="chart-container" style="height: 30em; width: 30em;">
                    <canvas id="pie" width="100" height="100"></canvas>
                </div>  
                <div class="chart-container" style="height: 30em; width: 30em;">
                    <canvas id="line" width="100" height="100"></canvas>
                </div>  
            </div>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>