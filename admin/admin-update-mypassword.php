<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Update Password</title>
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
    
    if(isset($_POST['admin-mypassword-submit'])){
        $oldPassword = md5($_POST['old-password']);
        $newPassword = md5($_POST['new-password']);
        $retypeNewPassword = md5($_POST['retype-new-password']);

        if($newPassword == $retypeNewPassword){
            if($oldPassword == $account['password']){
                $admin->adminUpdatePassword($account['admin_id'], $newPassword);
                echo "<script>alert('Password updated successfully')</script>";
            }else{
                echo "<script>alert('Old password is not accurate')</script>";
            }
        }else{
            echo "<script>alert('$oldPassword');</script>";
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
            <form class="container border-show rounded-lg p-4 m-20 flex flex-col items-center w-2/5" method="post">
                <div class="flex justify-between w-full mt-8">
                    <label class="capitalize text-2xl" for="admin-ma-op">old password:</label>
                    <div class="border-show flex items-center rounded-lg w-1/2">
                        <input id="admin-ma-op" class="rounded-lg p-2 w-full" type="password" name="old-password" onkeyup="showPasswordEye(this, '#admin-ma-e')">
                        <img id="admin-ma-e" class="h-4 w-4 mr-4 hide" src="../img/icon/hide-password.svg" alt="no image" onclick="showSinglePassword(this, '#admin-ma-op');">
                    </div>
                </div>
                <div class="flex justify-between w-full mt-8">
                    <label class="capitalize text-2xl" for="admin-ma-np">new password:</label>
                    <div class="border-show flex items-center rounded-lg w-1/2">
                        <input id="admin-ma-np" class="rounded-lg p-2 w-full" type="password" name="new-password" onkeyup="showPasswordEye(this, '#admin-ma-ne')">
                        <img id="admin-ma-ne" class="h-4 w-4 mr-4 hide" src="../img/icon/hide-password.svg" alt="no image" onclick="showSinglePassword(this, '#admin-ma-np');">
                    </div>
                </div>
                <div class="flex justify-between w-full mt-8">
                    <label class="capitalize text-2xl" for="admin-ma-rnp">retype password:</label>
                    <div class="border-show flex items-center rounded-lg w-1/2">
                        <input id="admin-ma-rnp" class="rounded-lg p-2 w-full" type="password" name="retype-new-password" onkeyup="showPasswordEye(this, '#admin-ma-rne')">
                        <img id="admin-ma-rne" class="h-4 w-4 mr-4 hide" src="../img/icon/hide-password.svg" alt="no image" onclick="showSinglePassword(this, '#admin-ma-rnp');">
                    </div>
                </div>
                <input class="button1 w-28 rounded-lg py-1 mt-10 font-bold" type="submit" value="Update" name="admin-mypassword-submit">
                <a class="mt-4 underline capitalize link" href="admin-my-account.php">my profile</a>
            </form>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>