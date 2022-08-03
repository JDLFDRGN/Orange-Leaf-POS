<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Products</title>
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
?>
<body>
    <section class="min-height-full relative">
        <?php
            require('admin-header.php');
            require('admin-side-navigation.php');
        ?>
        <form id="admin-delete-product" class="absolute hide top-1/2 left-1/2 border-show flex flex-col p-4 items-center bg-slate-50 rounded-lg z-10 -translate-x-1/2 -translate-y-1/2" method="post" action="admin-product-delete.php">
            <h1 class="uppercase font-bold">delete product</h1>
            <h1 class="mt-4">Are you sure you want to delete this product?</h1>
            <div class="mt-4">
                <input id="admin-id-product" type="hidden" name="product-id">
                <input class="border-show w-24 rounded-sm on-hover-pointer" type="button" value="No" onclick="hideDeleteForm('#admin-delete-product');">
                <input class="border-show w-24 rounded-sm on-hover-pointer" type="submit" value="Yes" name="admin-product-delete-submit">
            </div>
        </form>
        <div class="w-full flex justify-center h-full absolute pb-4 z-0">
            <form class="container mt-20 w-4/5 border-show flex flex-col items-center p-4 rounded-lg" method="post">
                <div class="flex justify-end w-full">
                    <!-- <select class="sort px-4 rounded-sm">
                        <option>--sort--</option>
                    </select> -->
                    <div class="search flex rounded-lg p-1">
                        <input class="rounded-lg pl-2" type="search" onkeyup="searchBarList('.product-list', this);">
                        <img class=" w-8 h-8 pl-1" src="../img/icon/search-white.svg" alt="no image">
                    </div>
                </div>
                <div class='h-full my-4 overflow-y-auto rounded-lg w-full'>
                <?php
                    $products = $admin->adminAllProduct();
                    foreach($products as $product){
                        echo "<div class='product-container flex justify-between mt-4 items-center h-1/2 w-full rounded-lg'>";
                        echo "<div class='flex items-center'>"; 
                            echo "<div class='p-4 h-full relative'>";
                                echo "<img class='object-contain' src='../img/uploaded/$product[image]' alt='no image' width='300' style='width: 300px; height: 200px;'>";
                                echo $product['stock'] > 0 ? "<img class='hide absolute top-0 left-0' src='../img/oos.png' alt='no image' width='100'>" : "<img class='absolute top-0 left-0' src='../img/oos.png' alt='no image' width='100'>";   
                            echo "</div>";
                            echo "<ul class='ml-4 product-list'>";
                                echo "<li>Name: <a>$product[product]</a></li>";
                                echo "<li>Category: <a>$product[category]</a></li>";
                                echo "<li>Size: <a>$product[size]</a></li>";   
                                echo "<li>Weight/Volume: <a>$product[volume]</a>";
                                echo "<li>Price: <a>$product[price]</a></li>";
                                echo "<li>Cost: <a>$product[cost]</a></li>";
                                echo "<li>Stock: <a>$product[stock]</a></li>";
                                echo "<li>Date Created: <a>$product[date_created]</a></li>";
                                echo "<li>Time Created: <a>$product[time_created]</a></li>";
                            echo "</ul>";
                        echo "</div>";
                        echo "<div class='mr-4 h-1/2 flex flex-col justify-evenly'>";
                            echo "<button type='button' class='button2 border-show flex items-center rounded-lg px-2 w-20' onclick='navigate(`admin-product-edit.php?id=$product[product_id]`);'>";
                                echo "<img class='w-4 h-4 mr-1' src='../img/icon/edit-blue.svg' alt='no image'>";
                                echo "<h1 class='font-semibold'>edit</h1>";
                            echo "</button>";
                            echo "<button type='button' class='button2 border-show flex items-center rounded-lg px-2 w-20' onclick='showDeleteForm(this, `#admin-delete-product`, `#admin-id-product`);' data-id='$product[product_id]'>";
                                echo "<img class='w-4 h-4 mr-1' src='../img/icon/remove-all-red.svg' alt='no image'>";
                                echo "<h1 class='font-semibold'>delete</h1>";
                            echo "</button>";
                        echo "</div>";
                    echo "</div>";
                    }
                ?>
                </div>
                <div class="w-full flex justify-end">
                    <button type="button" class="button2 border-show flex items-center w-20 rounded-lg px-2" onclick="navigate('admin-product-add.php');">
                        <img class="w-4 h-4 mr-1" src="../img/icon/add-green.svg" alt="no image">
                        <h1 class='font-semibold'>add</h1>
                    </button>
                </div>
            </form>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>