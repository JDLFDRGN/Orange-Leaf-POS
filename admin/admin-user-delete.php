<?php
    include '../sql/queries.php';
    if(isset($_POST['admin-user-delete-submit'])){
        $id = $_POST['user-id'];
        
        $admin->adminDeleteUser($id);
        header('Location: admin-user.php');
    }
?>