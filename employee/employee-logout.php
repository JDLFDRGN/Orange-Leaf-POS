<?php
    include '../sql/queries.php';
    $account = $_SESSION['account'];
    $staff->employeeSetInactive($account['employee_id']);
    session_destroy();
    header('Location: employee-home.php');
?>