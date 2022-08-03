<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">    
    <title>Add Product</title>
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
    
    if(isset($_POST['admin-product-submit'])){
        $product = $_FILES['image']['name'];
        $product_temp = $_FILES['image']['tmp_name'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $size = $_POST['size']; 
        $volume = $_POST['volume'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $ingredients = $admin->adminAllIngredient();
        $allIngredients = '';   
        $allAddons = '';
        foreach($ingredients as $ingredient){
            $temp = str_replace(' ', '-', $ingredient['ingredient']);
            if(isset($_POST[$temp])) $allIngredients .= $_POST[$temp].'\n'; 
            if(isset($_POST[$temp.'-addons'])) $allAddons .= $_POST[$temp.'-addons'].'\n';
        }

        $ingredientsArr = explode(" ", str_replace("\\n", ' ', $allIngredients));

        $validStock = true;
        foreach($ingredientsArr as $ingredientArr){
            foreach($ingredients as $ingredient){
                if($ingredient['ingredient'] == $ingredientArr){
                    if(intval($ingredient['stock']) <= 0) $validStock = false;  
                    $cost = $cost + $ingredient['price'];
                    break;
                }
            }
            if($validStock == false) break;
        }

        if($allIngredients == ''){
            echo "<script>alert('Product should have ingredients')</script>";
        }else if(!is_numeric($price)){
            echo "<script>alert('Please enter a valid price')</script>";
        }else if($validStock == false){
            echo "<script>alert('Insufficient stock. Please check the ingredients');</script>";
        }else{
            $price = number_format($price, 2);
            if($product == '') $product = "no-product.jpg";
            $result = $admin->adminAddProduct($product, $name, $category, $size, $allIngredients, $allAddons, $volume, $price, $cost, $stock);
            
            if($result){
                move_uploaded_file($product_temp, "../img/uploaded/".$product);
                header('Location: admin-product.php');
            }else{
                echo "<script>alert('Product already exists');</script>";
            }
            
            $cost = 0;
            foreach($ingredientsArr as $ingredientArr){
                foreach($ingredients as $ingredient){
                    if($ingredient['ingredient'] == $ingredientArr){
                        $difference = intval($ingredient['stock']) - 1;
                        $admin->admminUpdateIngredientStock($ingredient['ingredient_id'], $difference);
                        break;
                    }
                }
            }   
        }
    }
?>
<body>
    <section class="min-height-full relative">
        <?php
            require('admin-header.php');
            require('admin-side-navigation.php');
        ?>
        <div class="h-full flex flex-col items-center mt-20">  
            <form class=" w-4/5 flex flex-col px-4" method="post" enctype="multipart/form-data">
                <h1 class="uppercase font-black text-4xl">add product</h1>
                <div class="mt-4 flex h-1/5">
                    <div>
                        <div class="grid place-items-center">
                            <img id="admin-add-product" class="border-show" accept="img/*" src="../img/no-product.jpg" alt="no image" style="width: 300px; height: 200px;">
                        </div>
                        <input class="mt-4" type="file" onchange="insertImage(this,'#admin-add-product')" name="image">
                    </div>
                    <div class="w-full px-4 flex flex-col">
                        <div class="flex justify-between">
                            <label class="capitalize font-semibold text-4xl">name:</label>
                            <input class="border-show rounded-lg w-3/4 px-2" type="text" name="name" required>
                        </div>
                        <div class="flex justify-between mt-8">
                            <div class="my-4 flex w-1/2">
                                <label class="capitalize font-semibold text-4xl">category:</label>
                                <select class="border-show  w-1/2 ml-4" name="category">
                                    <?php
                                        $categories = $admin->adminAllCategory();
                                        foreach($categories as $category){
                                            echo "<option value='$category[category]'>$category[category]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="my-4 flex w-1/2">
                                <label class="capitalize font-semibold text-4xl">size:</label>
                                <select class="border-show w-1/2 ml-4" name="size">
                                    <?php
                                        $sizes = $admin->adminAllSize();
                                        foreach($sizes as $size){
                                            echo "<option value='$size[size]'>$size[size]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex w-full">
                    <div class='flex w-1/2 justify-between'>
                        <label class="capitalize font-semibold text-4xl">ingredients:</label>
                        <div class='w-1/2'>
                            <div class='h-10 border-show flex justify-end items-center'><img class='h-8 w-8 on-hover-pointer' src="../img/icon/caret-down.svg" alt="no-image" onclick="toggleChecklistForm(this, '.checklist-body');"></div>
                            <div class='border-show flex flex-col w-full checklist-body hide h-40 overflow-y-auto'>
                                <?php
                                    $ingredients = $admin->adminAllIngredient();
                                    foreach($ingredients as $ingredient){
                                        $ingredientName = str_replace(' ', '-', $ingredient['ingredient']);

                                        echo "<span class='ml-4'>";
                                        echo "<input class='mr-2' type='checkbox' value='$ingredient[ingredient]' name='$ingredientName'>";
                                        echo "<label class='capitalize font-medium text-2xl'>$ingredient[ingredient]</label>";
                                        echo "</span>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class='flex w-1/2 justify-between'>
                        <label class="capitalize font-semibold text-4xl ml-4">addons:</label>
                        <div class='w-1/2'>
                            <div class='h-10 border-show flex justify-end items-center'><img class='h-8 w-8 on-hover-pointer' src="../img/icon/caret-down.svg" alt="no-image" onclick="toggleChecklistForm(this, '.addons-body');"></div>
                            <div class='border-show flex flex-col w-full addons-body hide h-40 overflow-y-auto'>
                                <?php
                                    $ingredients = $admin->adminAllIngredient();
                                    foreach($ingredients as $ingredient){
                                        $ingredientName = str_replace(' ', '-', $ingredient['ingredient']);

                                        echo "<span class='ml-4'>";
                                        echo "<input class='mr-2' type='checkbox' value='$ingredient[ingredient]' name='$ingredientName-addons'>";
                                        echo "<label class='capitalize font-medium text-2xl'>$ingredient[ingredient]</label>";
                                        echo "</span>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex">
                    <div class="flex w-1/2">
                        <label class="capitalize font-semibold text-4xl">weight/volume:</label>
                        <input class="border-show rounded-lg w-2/6 px-2 ml-4" type="text" name="volume" required>
                    </div>
                    <div class="flex w-1/2">
                        <label class="capitalize font-semibold text-4xl">price:</label>
                        <input class="border-show rounded-lg w-2/6 px-2 ml-4" type="text" name="price" required>
                    </div>
                </div>
                <div class="mt-8 flex">
                    <label class="capitalize font-semibold text-4xl">stock:</label>
                    <input class="border-show rounded-lg w-2/6 px-2 ml-4" type="number" name="stock" required>
                </div>
                <div class="m-8">
                    <div class=" text-end">
                        <button type="button" class="button1 font-bold w-32 py-1 rounded-lg mr-4" onclick="navigate('admin-product.php');">Cancel</button>
                        <input class="button1 font-bold w-32 py-1 rounded-lg on-hover-pointer" type="submit" value="Confirm" name="admin-product-submit">
                    </div>
                </div>
            </form> 
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>