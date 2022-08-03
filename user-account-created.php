<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Account Created Successfully</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/functions.js" defer></script>
</head>
<body>
    <section class="min-height-full grid place-items-center">
       <h1 class="w-fit font-extrabold uppercase text-2xl">account created successfully</h1>
       <img class="check rounded-full" src="img/check.png" alt="no image">
       <input class="button1 w-32 py-2 rounded-lg font-extrabold" type="button" value="Continue" onclick="navigate('user-login.php')">
    </section>
    <?php
        include 'footer.php';
    ?>
</body>
</html>