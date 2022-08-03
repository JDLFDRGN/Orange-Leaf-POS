<?php
    include '../sql/queries.php';
    if(isset($_POST['admin-ingredient-delete-submit'])){
        $id = $_POST['ingredient-id'];
        
        $admin->adminDeleteIngredient($id);
        header('Location: admin-product-ingredients.php');
    }
?>