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
        <div class="text-center">
            <div class="text-center flex flex-col items-center">
                <h1 class="w-fit font-extrabold uppercase text-2xl">your order is complete</h1>
                <h1 class=" font-medium text-lg">To check your order status go to My order</h1>
            </div>
            <input class="button1 mt-4 w-32 py-2 rounded-lg font-bold on-hover-pointer" type="button" value="Continue" onclick="navigate('index.php')">
        </div>
    </section>
    <?php
        include 'footer.php';
    ?>
</body>
</html>