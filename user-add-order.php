<?php
    include 'sql/queries.php';
    if(isset($_POST['user-order-submit'])){
        $orders = $_POST['order'];
        $account = $_SESSION['account'];
        $bill = $_POST['bill'];
        $tax = $_POST['tax'];
        $cost = $_POST['cost'];
        $orderListText = $_POST['order-list-text'];
        $orderPriceText = $_POST['order-price-text'];

        $user->userAddOrder($account['user_id'], $orders, $bill, $tax, $cost, $orderListText, $orderPriceText);
        header('Location: user-order-complete.php');        
    }
?>