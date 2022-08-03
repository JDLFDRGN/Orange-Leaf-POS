<?php
    include '../sql/queries.php';
    if(isset($_POST['admin-employee-delete-submit'])){
        $id = $_POST['employee-id'];
        
        $admin->adminDeleteEmployee($id);
        header('Location: admin-employee.php');
    }
?>