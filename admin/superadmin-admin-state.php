<?php
    include '../sql/queries.php';

    $id = $_REQUEST['id'];
    $state = $_REQUEST['state'];

    $admin->adminDisableAdmin($id, $state);
    header('Location: superadmin-admin.php');
?>