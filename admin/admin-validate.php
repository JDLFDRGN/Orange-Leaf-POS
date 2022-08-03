<?php
    include '../sql/queries.php';

    if(isset($_POST['admin-login-submit'])){
        $username = $connect->real_escape_string($_POST['username']);
        $password = md5($connect->real_escape_string($_POST['password']));

        if($admin->adminExists($username, $password)) header('Location: admin-home.php');
        else echo "<script>alert(`Account does'nt exists`); window.location = 'admin-login.php';</script>";
    }
?>