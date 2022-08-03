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
                    <img class="w-8 h-8 on-hover-pointer" src="../img/icon/sale-history-white.svg" alt="no image" onclick="navigate('employee-order-history.php');">
                </div>
                <div class="list border-show h-full overflow-y-auto p-4 mt-4">
                    <?php
                        $orders = $user->userAllOrders();
                        $number = 1;
                        foreach($orders as $order){
                            if($order['employee_hide']) continue;
                            echo "<div class='order-message flex items-center justify-between'>";
                                echo "<div class='flex items-center p-4'>";
                                    echo "<img class='h-4 w-4 on-hover-pointer' src='../img/icon/utensil.svg' alt='no image'>";
                                    echo "<h1 class='capitalize ml-4 font-bold'>order no. $number</h1>";
                                echo "</div>";
                                echo "<div class='flex items-center on-hover-pointer' onclick='navigate(`employee-order-confirmation.php?id=$order[orders_id]`);'>";
                                    echo "<h1 class='capitalize font-bold'>view</h1>";
                                    echo "<img class='h-4 w-4 ml-4' src='../img/icon/view.svg' alt='no image'>";
                                echo "</div>";
                            echo "</div>";
                            $number++;
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>