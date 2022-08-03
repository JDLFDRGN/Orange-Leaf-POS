<?php
    include '../sql/queries.php';
    if(isset($_POST['employee-order-submit'])){
        $orders = $_POST['order'];
        $bill = $_POST['bill'];
        $tax = $_POST['tax'];
        $cost = $_POST['cost'];
        $orderListText = $_POST['order-list-text'];
        $orderPriceText = $_POST['order-price-text'];

        $user->userAddOrder(0, $orders, $bill, $tax, $cost, $orderListText, $orderPriceText);
        $latestOrder = $user->userLatestOrders()->fetch_assoc();
        $id = $latestOrder['orders_id'];
        
        header("Location: employee-order-confirmation.php?id=$id");
    }
?>