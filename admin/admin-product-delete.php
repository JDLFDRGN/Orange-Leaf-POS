<?php
    include '../sql/queries.php';
    if(isset($_POST['admin-product-delete-submit'])){
        $id = $_POST['product-id'];
        
        $admin->adminDeleteProduct($id);
        header('Location: admin-product.php');
    }
?>