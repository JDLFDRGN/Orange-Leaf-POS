<?php
   include 'sql/queries.php';

    if(isset($_POST['user-signup-submit'])){
        $profile = $_FILES['image']['name'];
        $profile_temp = $_FILES['image']['tmp_name'];
        $firstname = $_POST['first-name'];
        $lastname = $_POST['last-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $retypePassword = $_POST['retype-password'];
        $gender = $_POST['gender'];
        $number = $_POST['number'];
        $address = $_POST['address'];

        if($profile == '')$profile = 'no-profile.png';
        if($password == $retypePassword){
            $inserted = $user->userSignup($profile, $firstname, $lastname, $email, md5($password), $gender, $number, $address);
            
            if($inserted){
                move_uploaded_file($profile_temp, "img/uploaded/".$profile);
                header('Location: user-account-created.php');
            }
            else echo "<script>alert('Email already exists');  window.location='user-signup.php';</script>";
            
        }else{
            echo "<script>alert(`Passwords don't match`); window.location='user-signup.php';</script>";
        }
    }
?>