<?php
    include '../sql/queries.php';

    $id = $_REQUEST['id'];
    $state = $_REQUEST['state'];

    $admin->adminDisableUser($id, $state);
    header('Location: admin-user.php');
?>