<?php
    include '../sql/queries.php';

    $id = $_REQUEST['id'];
    $state = $_REQUEST['state'];

    $admin->adminDisableEmployee($id, $state);
    header('Location: admin-employee.php');
?>