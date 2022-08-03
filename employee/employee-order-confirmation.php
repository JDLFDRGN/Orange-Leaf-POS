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

    $orderID = $_REQUEST['id'];
    $order = $user->userSpecificOrders($orderID)->fetch_assoc();
    $userAccount =  $order['user_id'] != 0 ? $user->userMyOrders($order['user_id'])->fetch_assoc() : 0;
?>
<body>
    <section class="min-height-full relative">
        <?php require('employee-header.php'); ?>
        <form class="w-full flex justify-center h-full absolute pb-4 z-0"  method="post" action="employee-order-submit.php?id=<?php echo $orderID;?>">
            <div class="mt-20 w-4/5 flex flex-col justify-between items-center p-4 rounded-lg overflow-y-auto">
                <div class="receipt border-show w-2/5 p-4 h-4/5 rounded-lg overflow-y-auto">
                    <div class=" w-full text-end">
                        <span class="mr-4"><?php echo $order['date_ordered'];?></span>
                        <span class="mr-4"><?php echo $order['time_ordered'];?></span>
                    </div>
                    <div class="mt-8 <?php echo !$userAccount ? 'hide' : '' ;?>">
                        <div>name: <?php echo $userAccount['firstname']." ".$userAccount['lastname'];?></div>
                        <div>phone number: <?php echo $userAccount['phone_number'];?></div>
                    </div>
                    <div class="mt-4">
                        <h1 class="capitalize font-bold text-end">total:</h1>
                        <div class="flex justify-between">
                            <pre class="order"><?php echo $order['order_text'];?></pre>
                            <pre class="amount text-end"><?php echo $order['price_text'];?></pre>
                        </div>
                        <div class="flex justify-between">
                            <div>Tax (2%)</div>
                            <div class="tax"><?php echo $order['tax'];?></div>
                        </div>
                        <div class="border-show my-4"></div>
                        <div class="text-end bill">Php <?php echo $order['bill'];?></div>
                    </div>
                </div>
                <div class="w-full flex justify-between items-center">
                    <a class="capitalize font-bold text-2xl" href="employee-order.php">orders</a>
                    <div class="flex">
                        <div class="button2 border-show mr-4 w-32 flex items-center justify-center rounded-lg py-1"> 
                            <img class="w-4 h-4 mr-2" src="../img/icon/remove-red.svg" alt="no image">
                            <input class="font-semibold" type="submit" value="Decline" name="order-decline">
                        </div>
                        <div class="button2 border-show mr-4 w-32 flex items-center justify-center rounded-lg py-1"> 
                            <img class="w-4 h-4 mr-2" src="../img/icon/check-green.svg" alt="no image">
                            <input class="font-semibold" type="submit" value="Accept" name="order-accept">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <?php include '../footer.php';?>
</body>
</html>