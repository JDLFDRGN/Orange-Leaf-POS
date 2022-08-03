<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Order</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
    <script src="../js/functions.js" defer></script>
</head>
<?php
    include '../sql/queries.php';

    $account = $_SESSION['account'];

    if(!$account) header('Location: employee-login.php');
    else if(!$staff->employeeEnabled($account['employee_id'])) header('Location: ../disabled.php');
?>
<body>
    <section class="min-height-full relative">
        <?php require('employee-header.php'); ?>
        
        <div class="w-full flex justify-center h-full absolute pb-4 z-0">
            <div class="order-list mt-20 w-4/5 flex flex-col p-4 rounded-lg" method="post" style="background-color: #3e2015;">
                <div class=" flex justify-between">
                    <a class="font-bold text-lg w-fit capitalize white" href="employee-home.php">home</a>
                </div>
                <div class="list border-show h-full overflow-y-auto p-4 mt-4">
                    <div class='w-full h-4/5 flex mt-8'>
                        <div class='rounded-lg w-1/2 overflow-y-auto flex justify-center flex-wrap'>
                            <?php
                                $sales = $staff->employeeSales($account['employee_id']);
                                $number = 1;
                                $totalSales = 0;
                                foreach($sales as $sale){
                                    echo "<div class='order-card m-4 on-hover-pointer rounded-lg w-2/5 h-3/5 flex flex-col items-center justify-evenly font-bold' data-id=$sale[orders_id] onclick='viewOrder(this);'>";
                                        echo "<div class='white uppercase font-bold'>order no. $number</div>";
                                        echo "<img class=' w-8 h-8' src='../img/icon/mouse-white.svg' alt='no image'>";
                                    echo "</div>";
                                    $number++;
                                    $totalSales += floatval($sale['bill']);
                                }
                            ?>
                        </div>
                        <div class='w-1/2 flex justify-center'>
                            <div class="w-4/5 h-full">
                                <div class="receipt border-show w-full p-4 h-full rounded-lg overflow-y-auto">
                                    <div class=" w-full text-end">
                                        <span class="mr-4 employee-sale-date"></span>
                                        <span class="mr-4 employee-sale-time"></span>
                                    </div>
                                    <div class="mt-8">
                                        <div class="employee-sale-name capitalize"></div>
                                        <div class="employee-sale-number capitalize"></div>
                                    </div>
                                    <div class="mt-4">
                                        <h1 class="capitalize font-bold text-end">total:</h1>
                                        <div class="flex justify-between">
                                            <pre class="employee-sale-order"></pre>
                                            <pre class="text-end employee-sale-amount"></pre>
                                        </div>
                                        <div class="flex justify-between">
                                            <div>Tax (2%)</div>
                                            <div class="employee-sale-tax">0.00</div>
                                        </div>
                                        <div class="border-show my-4"></div>
                                        <div class="text-end employee-sale-bill">Php 0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='w-full h-8 mt-8 text-end'>
                        <div class=' capitalize font-bold text-lg'>total sales:  Php <?php echo number_format($totalSales, 2); ?></div>    
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>