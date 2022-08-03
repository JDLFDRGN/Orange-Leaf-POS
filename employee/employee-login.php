<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Login</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
    <section class="min-height-full">
        <header>
            <ul class="flex justify-end">
                <li class="m-8"><a class="uppercase text-lg" href="../admin/admin-login.php">admin</a></li>
            </ul>
        </header>
        <form class="container border-show rounded-xl mx-auto w-2/5" method="post" action="employee-validate.php">
            <div class="uppercase text-center text-lg py-4 font-black link">employee login</div>
            <div class=" flex flex-col items-center">
                <div class=" mt-8 w-4/5">
                    <div class="flex rounded-lg p-4 mt-4 border-show bg-white">
                        <img class="w-4" src="../img/icon/employee.svg" alt="No image">
                        <input class="ml-4 w-full" type="text" name="username" placeholder="Enter username" autocomplete="off" required>
                    </div>
                    <div class="flex rounded-lg p-4 mt-4 border-show bg-white">
                        <img class="w-4" src="../img/icon/lock.svg" alt="No image">
                        <input class="ml-4 w-full" type="password" name="password" placeholder="Enter password" required>
                    </div>
                </div>
                <div class=" my-16">
                    <input class="button1 rounded-lg w-28 py-1 font-extrabold" type="submit" value="Sign In" name="employee-login-submit">
                </div>
            </div>
        </form>
    </section>
    <?php
        include '../footer.php';
    ?>
</body>
</html>