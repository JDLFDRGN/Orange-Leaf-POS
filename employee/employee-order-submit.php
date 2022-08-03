<?php
    include '../sql/queries.php';

    $account = $_SESSION['account'];
    $orderID = $_REQUEST['id'];
    $orders = $user->userSpecificOrders($orderID)->fetch_assoc();
    $orderValid = true;

    if(isset($_POST['order-accept'])){
        $getOrders = $orders['orders'];
        $orderJson = json_decode(str_replace('}"', "}", str_replace('"{', "{", $getOrders)), true);

        foreach($orderJson as $order){
            $product = $admin->adminSpecificProduct($order['productID'])->fetch_assoc();
            $stock = intval($product['stock']);
            $quantity = intval($order['productQnty']);

            if($stock < $quantity){
                $orderValid = false;
                break;
            }
        }
        if($orderValid){
            foreach($orderJson as $order){
                $product = $admin->adminSpecificProduct($order['productID'])->fetch_assoc();
                $updatedStock = intval($product['stock']) - intval($order['productQnty']);

                $staff->employeeUpdateStock($product['product_id'], $updatedStock);
            }
            $staff->employeeAcceptOrder($orderID);
            $staff->employeeAddSales($orderID, $account['employee_id']);
            $staff->employeeHideOrder($orderID);
            header('Location: employee-order.php');
        }else{
            echo "<script>alert('Insufficient Stocks'); window.location='employee-order-confirmation.php?id=$orderID';</script>";
        }
    }else if(isset($_POST['order-decline'])){
        $staff->employeeDeclineOrder($orderID);
        $staff->employeeHideOrder($orderID);
        header('Location: employee-order.php');
    }
   
?>