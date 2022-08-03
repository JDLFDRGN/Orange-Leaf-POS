<?php
    include '../sql/queries.php';
    if(isset($_POST['admin-delete-submit'])){
        $id = $_POST['admin-id'];
        
        $admin->adminDeleteAdmin($id);
        header('Location: superadmin-admin.php');
    }
?>