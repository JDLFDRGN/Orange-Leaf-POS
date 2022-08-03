<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Edit User</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/functions.js" defer></script>
</head>
<?php
    include 'sql/queries.php';
    $account = $_SESSION['account'];

     if(isset($_POST['edit-user-submit'])){
        $profile = $_FILES['image']['name'];
        $profile_temp = $_FILES['image']['tmp_name'];
        $firstname = $_POST['first-name'];
        $lastname = $_POST['last-name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $number = $_POST['number'];
        $address = $_POST['address'];

        $admin->adminUpdateUserProfile($account['user_id'], $profile, $firstname, $lastname, $email, $gender, $number, $address);
        $user->userUpdateSession($account['user_id']);
        move_uploaded_file($profile_temp, "img/uploaded/".$profile);
        $account = $_SESSION['account'];
    }  
?>
<body>
    <?php 
        require('user-header.php');
    ?>
    <section class="min-height-full w-full">
       <form class="w-3/4 mx-auto p-4" style="margin-top: 5em;"  method="post" enctype="multipart/form-data">
            <h1 class="uppercase bold font-bold text-2xl link">edit user</h1>
            <div class="flex">
                <div class="w-1/4 mt-4">
                    <div class="grid place-items-center overflow-y-hidden">
                        <img id="user-signup-profile" class="border-show w-full object-contain h-72" src="img/uploaded/<?php echo $account['image']?>" accept="img/*" alt="no image" width="400" height="400" name="image">
                    </div>
                    <input id="user-signup-image" class="w-full mt-4" type="file" onchange="insertImage(this,'#user-signup-profile')" name="image">
                </div>
                <div class="w-3/4 flex justify-evenly flex-col">
                    <div class="w-full flex justify-between items-center h-12">
                        <label class="pl-4 text-2xl capitalize" for="user-fn">first name:</label>
                        <input id="user-fn" class="border-show w-3/4 h-full rounded-lg p-4" type="text" name="first-name" value="<?php echo $account['firstname']?>" required>
                    </div>
                    <div class="w-full flex justify-between items-center h-12">
                        <label class="pl-4 text-2xl capitalize" for="user-ln">last name:</label>
                        <input id="user-ln" class="border-show w-3/4 h-full rounded-lg p-4" type="text" name="last-name" value="<?php echo $account['lastname']?>" required>
                    </div>
                    <div class="w-full flex justify-between items-center h-12">
                        <label class="pl-4 text-2xl capitalize" for="user-e">email:</label>
                        <input id="user-e" class="border-show w-3/4 h-full rounded-lg p-4" type="email" name="email" value="<?php echo $account['email']?>" required>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center h-12 mt-8">
                <div class="flex h-full items-center w-1/2">
                    <span class="text-2xl capitalize">gender:</span>
                    <div class="ml-4">
                        <input type="radio" id="user-m" name="gender" value="male" <?php if($account['gender'] == 'male') echo 'checked';?>>
                        <label class="text-2xl capitalize" for="user-m">male</label>
                    </div>
                    <div class="ml-4">
                        <input type="radio" id="user-f" name="gender" value="female" <?php if($account['gender'] == 'female') echo 'checked';?>>
                        <label class="text-2xl capitalize" for="user-f">female</label>
                    </div>
                </div>
                <div class="h-full w-1/2 flex justify-between items-center pl-4">
                    <label class="text-2xl capitalize" for="user-signup-number">number:</label>
                    <input id="user-signup-number" class="border-show rounded-lg h-full p-4 w-3/4" type="tel" name="number" value="<?php echo $account['phone_number'];?>">
                </div>
            </div>
            <div class="h-36 flex mt-16">
                <label class="text-2xl capitalize" for="user-signup-address">address:</label>
                <textarea id="user-signup-address" class="border-show resize-none ml-4 rounded-lg w-full p-4" name="address"><?php echo $account['address'];?></textarea>
            </div>
            <div class="mt-32 flex justify-between items-center">
                <a class="underline link" href="user-update-mypassword.php">Change password</a>
                <div>
                    <input class="button1 w-32 py-2 rounded-lg mr-4 font-bold" type="button" value="Cancel" onclick="navigate('index.php')"> 
                    <input class="button1 w-32 py-2 rounded-lg font-bold" type="submit" value="Submit" name="edit-user-submit">
                </div>
            </div>
       </form>
    </section>
    <?php
        include 'footer.php';
    ?>
</body>
</html>