<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Add Size</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
    <script src="../js/functions.js" defer></script>
</head>
<?php
    include '../sql/queries.php';

    $account = $_SESSION['account'];
    $sizeID = $_REQUEST['id'];

    if(!$account) header('Location: admin-login.php');
    else if(!$admin->adminEnabled($account['admin_id'])) header('Location: ../disabled.php');
    
    if(isset($_POST['admin-edit-size'])){
        $size = $_POST['size'];
        
        $admin->adminEditSize($sizeID, $size);
        header('Location: admin-product-size.php');
    }
?>
<body>
    <section class="min-height-full relative">
        <?php
            require('admin-header.php');
            require('admin-side-navigation.php');
        ?>
        <div class="absolute h-full w-full flex flex-col justify-center items-center">
            <form class="w-1/5 flex flex-col items-center" method="post">
                <?php $size = $admin->adminSpecificSize($sizeID)->fetch_assoc(); ?>
                <h1 class="uppercase font-black text-4xl">edit size</h1>
                <div class="mt-12 w-full">
                    <h1 class="font-bold capitalize text-2xl">size:</h1>
                    <input class="border-show rounded-lg w-full px-4 py-2" type="text" name="size" autocomplete="off" required value="<?php echo $size['size']?>">
                </div>
                <div class=" mt-32 flex w-full justify-between">
                    <button class="button1 border-show w-2/5 rounded-lg py-1" type="button" onclick="navigate('admin-product-size.php')">Back</button>
                    <input class="button1 border-show w-2/5 rounded-lg py-1" type="submit" value="Confirm" name="admin-edit-size">
                </div>
            </form> 
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>