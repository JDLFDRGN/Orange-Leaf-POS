<?php
    include '../sql/queries.php';

    if(isset($_POST['submit'])){
        $id = $_POST['id'];

        $order = $user->userSpecificOrders($id)->fetch_assoc();
        $userAccount =  $order['user_id'] != 0 ? $user->userMyOrders($order['user_id'])->fetch_assoc() : 0;

        if($order['user_id'] != '0'){
            $order['fullname'] = "Full Name: " . $userAccount['firstname']." ".$userAccount['lastname'];
            $order['number'] = "Phone Number: " . $userAccount['phone_number'];
        }

        echo json_encode($order);
    }
?>