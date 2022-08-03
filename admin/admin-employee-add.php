<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Add Employee</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
    <script src="../js/functions.js" defer></script>
</head>
<?php
    include '../sql/queries.php';
     if(isset($_POST['admin-add-employee-submit'])){
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

        if($password == $retypePassword){
            $inserted = $admin->adminAddEmployee($profile, $firstname, $lastname, $email, md5($password), $gender, $number, $address);
            
            if($inserted){
                move_uploaded_file($profile_temp, "../img/uploaded/".$profile);
                header('Location: admin-employee.php');
            }
            else echo "<script>alert('Email already exists');</script>";
            
        }else{
            echo "<script>alert(`Passwords don't match`);</script>";
        }
    }
    $account = $_SESSION['account'];
?>
<body>
    <?php 
        require('admin-header.php');
        require('admin-side-navigation.php');
    ?>  
    <section class="min-height-full w-full">
       <form class="w-3/4 mx-auto p-4 mt-4" style="margin-top: 5em;"  method="post" enctype="multipart/form-data">
            <h1 class="uppercase bold font-bold text-2xl">add employee</h1>
            <div class="flex">
                <div class="w-1/4 mt-4">
                    <div class="grid place-items-center overflow-y-hidden">
                        <img id="user-signup-profile" class="border-show w-full object-contain h-72" src="../img/no-profile.png" accept="img/*" alt="no image" width="400" height="400" name="image">
                    </div>
                    <input id="user-signup-image" class="w-full mt-4" type="file" onchange="insertImage(this,'#user-signup-profile')" name="image">
                </div>
                <div class="w-3/4 flex justify-evenly flex-col">
                    <div class="w-full flex justify-between items-center h-12">
                        <label class="pl-4 text-2xl capitalize" for="user-fn">first name:</label>
                        <input id="user-fn" class="border-show w-3/4 h-full rounded-lg p-4" type="text" name="first-name" required>
                    </div>
                    <div class="w-full flex justify-between items-center h-12">
                        <label class="pl-4 text-2xl capitalize" for="user-ln">last name:</label>
                        <input id="user-ln" class="border-show w-3/4 h-full rounded-lg p-4" type="text" name="last-name" required>
                    </div>
                    <div class="w-full flex justify-between items-center h-12">
                        <label class="pl-4 text-2xl capitalize" for="user-e">email:</label>
                        <input id="user-e" class="border-show w-3/4 h-full rounded-lg p-4" type="email" name="email" required>
                    </div>
                </div>
            </div>
            <div class="h-12 flex content-between mt-4">
                <div class="h-full w-1/2 flex justify-between items-center pl-4">
                    <label class=" text-2xl capitalize" for="user-signup-pwd">password:</label>
                    <input id="user-signup-pwd" class="border-show rounded-lg h-full p-4 w-3/4" type="password" name="password" required>
                </div>
                <div class="h-full w-1/2 flex justify-between items-center pl-4">
                    <label class="text-2xl capitalize" for="user-signup-retype-pwd">retype:</label>
                    <input id="user-signup-retype-pwd" class="border-show rounded-lg h-full p-4 w-3/4" type="password" name="retype-password" required>
                </div>
            </div>
            <div class="flex items-center mt-4 ml-4">
                <input type="checkbox" id="user-c" onclick="showDoublePassword(this, '#user-signup-pwd','#user-signup-retype-pwd')">
                <label class="capitalize pl-1" for="user-c">show password</label>
            </div>
            <div class="flex justify-between items-center h-12 mt-16">
                <div class="flex h-full items-center w-1/2">
                    <span class="text-2xl capitalize">gender:</span>
                    <div class="ml-4">
                        <input type="radio" id="user-m" name="gender" value="male" checked>
                        <label class="text-2xl capitalize" for="user-m">male</label>
                    </div>
                    <div class="ml-4">
                        <input type="radio" id="user-f" name="gender" value="female">
                        <label class="text-2xl capitalize" for="user-f">female</label>
                    </div>
                </div>
                <div class="h-full w-1/2 flex justify-between items-center pl-4">
                    <label class="text-2xl capitalize" for="user-signup-number">number:</label>
                    <input id="user-signup-number" class="border-show rounded-lg h-full p-4 w-3/4" type="tel" name="number">
                </div>
            </div>
            <div class="h-36 flex mt-16">
                <label class="text-2xl capitalize" for="user-signup-address">address:</label>
                <textarea id="user-signup-address" class="border-show resize-none ml-4 rounded-lg w-full p-4" name="address"></textarea>
            </div>
            <div class="mt-32 text-end">
                <input class="button1 border-show w-32 py-2 rounded-lg mr-4" type="button" value="Cancel" onclick="navigate('admin-employee.php')"> 
                <input class="button1 border-show w-32 py-2 rounded-lg" type="submit" value="Submit" name="admin-add-employee-submit">
            </div>
       </form>
    </section>
    <?php
        include '../footer.php';
    ?>
</body>
</html>