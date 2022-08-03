<?php
    include 'sql/queries.php';
    if(isset($_POST['user-login-submit'])){
        $email = $connect->real_escape_string($_POST['username']);
        $password = md5($connect->real_escape_string($_POST['password']));

        if($user->userExists($email, $password)) header('Location: index.php');
        else echo "<script>alert(`Account does'nt exists`); window.location = 'user-login.php';</script>";    
    }
?>