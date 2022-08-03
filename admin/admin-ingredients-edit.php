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
    $ingredientID = $_REQUEST['id'];

    if(!$account) header('Location: admin-login.php');
    else if(!$admin->adminEnabled($account['admin_id'])) header('Location: ../disabled.php');
    
    if(isset($_POST['admin-edit-ingredient'])){
        $ingredient = $_POST['ingredient'];
        $supplier = $_POST['supplier'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];

        if(!is_numeric($price)){
            echo "<script>alert('Please enter a valid price')</script>";
        }else if($stock >= 0){
            $price = number_format($price, 2);

            if($admin->adminEditIngredient($ingredientID, $ingredient, $supplier, $stock, $price)) header('Location: admin-product-ingredients.php');
            else echo "<script>alert('Ingredient already exists'); window.location='admin-product-ingredients.php';</script>";
        }else{
            echo "<script>alert('Stock should be greater than or equal to zero');  window.location='admin-product-ingredients.php';</script>";
        }
    }
?>
<body>
    <section class="min-height-full relative">
        <?php
            require('admin-header.php');
            require('admin-side-navigation.php');
        ?>
        <div class="my-4 h-full w-full flex flex-col justify-center items-center">  
            <form class=" w-2/4flex flex-col items-center mt-20" method="post">
                <?php $ingredient = $admin->adminSpecificIngredient($ingredientID)->fetch_assoc(); ?>
                <h1 class="uppercase font-black text-4xl">edit ingredients</h1>
                <div class="mt-12 w-full">
                    <h1 class="font-bold capitalize text-2xl">ingredients:</h1>
                    <input class="border-show rounded-lg w-full px-4 py-2" type="text" name="ingredient" autocomplete="off" required value="<?php echo $ingredient['ingredient'];?>">
                </div>
                <div class="mt-12 w-full">
                    <h1 class="font-bold capitalize text-2xl">supplier:</h1>
                    <input class="border-show rounded-lg w-full px-4 py-2" type="text" name="supplier" autocomplete="off" required value="<?php echo $ingredient['supplier'];?>">
                </div>
                <div class="mt-12 w-full">
                    <h1 class="font-bold capitalize text-2xl">price:</h1>
                    <input class="border-show rounded-lg w-full px-4 py-2" type="text" min="0" name="price" autocomplete="off" required value="<?php echo $ingredient['price'];?>">
                </div>
                <div class="mt-12 w-full">
                    <h1 class="font-bold capitalize text-2xl">stocks:</h1>
                    <input class="border-show rounded-lg w-full px-4 py-2" type="number" min="0" name="stock" autocomplete="off" required value="<?php echo $ingredient['stock'];?>">
                </div>
                <div class=" mt-32 flex w-full justify-between">
                    <button class="button1 border-show w-2/5 rounded-lg py-1" type="button" onclick="navigate('admin-product-ingredients.php')">Back</button>
                    <input class="button1 border-show w-2/5 rounded-lg py-1" type="submit" value="Confirm" name="admin-edit-ingredient">
                </div>
            </form> 
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>