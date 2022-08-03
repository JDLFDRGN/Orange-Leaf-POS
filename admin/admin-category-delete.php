<?php
    include '../sql/queries.php';
    if(isset($_POST['admin-category-delete-submit'])){
        $id = $_POST['category-id'];
        
        $admin->adminDeleteCategory($id);
        header('Location: admin-product-categories.php');
    }
?>