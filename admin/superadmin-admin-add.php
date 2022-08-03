<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Add Account</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
    <script src="../js/functions.js" defer></script>
</head>
<?php
    include '../sql/queries.php';

    $account = $_SESSION['account'];

    if(!$account) header('Location: admin-login.php');
    else if(!$admin->adminEnabled($account['admin_id'])) header('Location: ../disabled.php');
    
    if(isset($_POST['admin-add-submit'])){
        $profile = $_FILES['image']['name'];
        $profile_temp = $_FILES['image']['tmp_name'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $retypePassword = md5($_POST['retype-password']);

        $account = $_SESSION['account'];

        if($profile == '') $profile = 'no-profile.png';
        if($password == $retypePassword){

            if($admin->adminAddAdmin($profile, $firstname, $lastname, $username, $password)){
                $latestAdmin = $admin->adminLatestAdmin()->fetch_assoc();
                $admin->adminSetAccessibility($latestAdmin['admin_id']);
                move_uploaded_file($profile_temp, "../img/uploaded/".$profile);
                header('Location: superadmin-admin.php');
            }else{
                echo "<script>alert('Username is already taken');</script>";
            } 
        }else{
            echo "<script>alert('Passwords do not match');</script>";
        }
    }
?>
<body>
    <section class="min-height-full relative">
        <?php
            require('admin-header.php');
            require('admin-side-navigation.php');
        ?>
        <div class="w-full flex justify-center">
            <form class="container border-show rounded-lg p-4 m-20 flex flex-col items-center w-2/5" method="post" enctype="multipart/form-data">
                <div class="border-show w-40 h-40 overflow-hidden">
                    <img id="admin-add-image" src="../img/no-profile.png" alt="no image" width="200">
                </div>   
                <div class="flex justify-between w-full mt-12">
                    <label class="capitalize text-2xl" for="admin-ma-fl">change profile:</label>
                    <input class="w-1/2" type="file" id="admin-ma-fl" name="image" onchange="insertImage(this,'#admin-add-image');">
                </div>
                <div class="flex justify-between w-full mt-8">
                    <label class="capitalize text-2xl" for="admin-ma-f">firstname:</label>
                    <input id="admin-ma-f" class="border-show rounded-lg p-2 w-1/2" type="text" name="firstname" required>
                </div>
                <div class="flex justify-between w-full mt-8">
                    <label class="capitalize text-2xl" for="admin-ma-l">lastname:</label>
                    <input id="admin-ma-l" class="border-show rounded-lg p-2 w-1/2" type="text" name="lastname" required>
                </div>
                <div class="flex justify-between w-full mt-8">
                    <label class="capitalize text-2xl" for="admin-ma-u">username:</label>
                    <input id="admin-ma-u" class="border-show rounded-lg p-2 w-1/2" type="text" name="username" required>
                </div>
                <div class="flex justify-between w-full mt-8">
                    <label class="capitalize text-2xl" for="admin-ma-rnp">password:</label>
                    <div class="border-show flex items-center rounded-lg w-1/2 bg-white">
                        <input id="admin-ma-rnp" class="rounded-lg p-2 w-full" type="password" name="password" onkeyup="showPasswordEye(this, '#admin-ma-rne')" required>
                        <img id="admin-ma-rne" class="h-4 w-4 mr-4 hide" src="../img/icon/hide-password.svg" alt="no image" onclick="showSinglePassword(this, '#admin-ma-rnp');">
                    </div>
                </div>
                <div class="flex justify-between w-full mt-8">
                    <label class="capitalize text-2xl" for="admin-ma-rnp">retype password:</label>
                    <div class="border-show flex items-center rounded-lg w-1/2 bg-white">
                        <input id="admin-create-password" class="rounded-lg p-2 w-full" type="password" name="retype-password" onkeyup="showPasswordEye(this, '#admin-password-eye')" required>
                        <img id="admin-password-eye" class="h-4 w-4 mr-4 hide" src="../img/icon/hide-password.svg" alt="no image" onclick="showSinglePassword(this, '#admin-create-password');">
                    </div>
                </div>
                <input class="button1 border-show w-28 rounded-lg py-1 mt-10" type="submit" value="Create" name="admin-add-submit">
            </form>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>