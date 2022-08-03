<?php
    include '../sql/queries.php';
    if(isset($_POST['admin-size-delete-submit'])){
        $id = $_POST['size-id'];
        
        $admin->adminDeleteSize($id);
        header('Location: admin-product-size.php');
    }
?>