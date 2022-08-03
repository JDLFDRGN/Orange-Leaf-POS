<?php
    include '../sql/queries.php';
    if(isset($_POST['employee-login-submit'])){
        $email = $connect->real_escape_string($_POST['username']);
        $password = md5($connect->real_escape_string($_POST['password']));

        if($staff->employeeExists($email, $password)) header('Location: employee-home.php');
        else echo "<script>alert(`Account does'nt exists`); window.location = 'employee-login.php';</script>";    
    }
?>