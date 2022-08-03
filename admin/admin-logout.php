<?php
   include '../sql/queries.php';
    $account = $_SESSION['account'];
    $admin->adminSetInactive($account['admin_id']);
    session_destroy();
    header('Location: admin-home.php');
?>