<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Login</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/functions.js"></script>
</head>
<body>
    <section class="min-height-full grid place-items-center">
        <form class="container border-show rounded-xl mx-auto w-2/5" method="post" action="user-validate.php">
            <div class="uppercase text-center text-lg py-4 font-black link">user login</div>
            <div class=" flex flex-col items-center">
                <div class=" mt-8 w-4/5">
                    <div class="flex rounded-lg p-4 mt-4 border-show bg-white">
                        <img class="w-4" src="img/icon/user.svg" alt="No image">
                        <input class="ml-4 w-full" type="text" name="username" placeholder="Enter username" autocomplete="off" required>
                    </div>
                    <div class="flex rounded-lg p-4 mt-4 border-show bg-white">
                        <img class="w-4" src="img/icon/lock.svg" alt="No image">
                        <input class="ml-4 w-full" type="password" name="password" placeholder="Enter password" required>
                    </div>
                </div>
                <div class=" my-16 flex flex-col items-center">
                    <div>
                        <input class="button1 rounded-lg w-28 py-1 font-extrabold on-hover-pointer" type="button" value="Back" onclick="navigate('index.php');">
                        <input class="button1 rounded-lg w-28 py-1 font-extrabold on-hover-pointer" type="submit" value="Sign In" name="user-login-submit">
                    </div>
                    <span>or</span>
                    <a class="link underline" href="user-signup.php">Create an account</a>
                </div>
            </div>
        </form>
    </section>
    <?php
        include 'footer.php';
    ?>
</body>
</html>