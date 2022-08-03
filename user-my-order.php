<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Home</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/functions.js" defer></script>
</head>
<?php
    include 'sql/queries.php';

    $account = $_SESSION['account'];

    if(!$account) header('Location: user-login.php');
    else if(!$user->userEnabled($account['user_id'])) header('Location: disabled.php');
?>
<body>
    <section class="min-height-full relative pt-20">
        <?php require('user-header.php'); ?>
        <div>
            <a href="index.php" class="capitalize font-bold text-2xl pl-4 on-hover-pointer">home</a>
            <div class="my-order">
                <?php
                    $orders = $user->userMyOrders($account['user_id']);
                    foreach($orders as $order){
                        echo "<div class='receipt order-receipt w-full mt-4 relative'>";
                            echo "<div class='w-full text-end'>";
                                echo "<span class='mr-4'>$order[date_ordered]</span>";
                                echo "<span class='mr-4'>$order[time_ordered]</span>";
                            echo "</div>";
                            if($order['order_successful'] == 1){
                                echo "<div class='mt-4 flex flex-col items-center'>";
                                    echo "<h1 class='capitalize font-bold text-4xl'>reference no.</h1>";
                                    echo "<h1 class='uppercase font-semibold text-lg'>1drf$order[orders_id]</h1>";
                                echo "</div>";
                            }else if($order['order_successful'] == -1){
                                echo "<h1 class='w-full text-center uppercase text-2xl font-black absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45'>order declined!!</h1>";      
                            }else{
                                echo "<h1 class='uppercase text-2xl font-black absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rotate-45'>pending...</h1>";      
                            }                   
                            echo "<div class='mt-4'>";
                                echo "<h1 class='capitalize font-bold text-end'>total:</h1>";
                                echo "<div class='flex justify-between'>";
                                    echo "<pre class='order'>$order[order_text]</pre>";
                                    echo "<pre class='amount text-end'>$order[price_text]</pre>";
                                echo "</div>";
                            echo "</div>";
                            echo " <div class='flex justify-between'>";
                                echo "<div>Tax (2%)</div>";
                                echo "<div class='tax'>$order[tax]</div>";
                            echo "</div>";
                            echo " <div class='border-show my-4'></div>";
                            echo "<div class='text-end bill'>Php $order[bill]</div>";
                        echo "</div>";
                    }
                ?> 
            </div>
        </div>
    </section>
    <?php include 'footer.php';?>
</body>
</html>