<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Home</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
    <script src="../js/functions.js" defer></script>
</head>
<?php
    include '../sql/queries.php';

    $account = $_SESSION['account'];

    if(!$account) header('Location: employee-login.php');
    else if(!$staff->employeeEnabled($account['employee_id'])) header('Location: ../disabled.php');
    
    $staff->employeeSetActive($account['employee_id']);
?>
<body>
    <section class="min-height-full relative">
        <?php require('employee-header.php'); ?>
        <div>
            <div class="w-3/4 pt-20 p-4 relative" style='left: 25%;'>
                <div class='fixed' style="z-index: 10;">
                    <div class="flex justify-between w-full">
                        <form class=" w-3/5 flex items-center flex-wrap" method="post">
                            <div class="text-center">
                                <input type='submit' class="border-show w-32 capitalize category on-hover-pointer" value='All'></input>
                            </div>
                            <?php
                                $categories = $admin->adminAllCategory();
                                foreach($categories as $category){
                                    echo "<div class='category text-center'>";
                                    echo "<input class='border-show capitalize w-32 on-hover-pointer' type='submit' name='category' value='$category[category]'>";
                                    echo "</div>";
                                }
                            ?>
                        </form>
                        <div class="flex rounded-lg p-1 h-10 search">
                            <input class="rounded-lg pl-2" type="search" onkeyup="searchBarItem('.product-container', this);">
                            <img class=" w-8 h-8 pl-1" src="../img/icon/search-white.svg" alt="no image">
                        </div>
                    </div>
                </div>
                <div class="mt-16 flex flex-wrap">
                    <?php
                        if(isset($_POST['category']) && $_POST['category'] != 'All') $products = $admin->adminFilterProduct($_POST['category']);
                        else $products = $admin->adminAllProduct();
                        
                        foreach($products as $product){
                            echo "<div class='border-show w-fit relative m-4 product-container' onclick='previewProduct(this);' style='width: 30%; height: fit-content;' data-stock='$product[stock]' data-id='$product[product_id]' data-cost='$product[cost]' data-name='$product[product]' data-size='$product[size]' data-quantity=1 data-amount='$product[price]'>";
                                echo "<img src='../img/uploaded/$product[image]' alt='no image' style='width: 100%; height: 15em;'>";
                                echo "<div class='bg-black text-center absolute bottom-0 left-0 h-8 w-full flex items-center justify-center'>";
                                    echo "<h1 class='font-bold uppercase' style='color: white;'>$product[product]</h1>";
                                echo "</div>";
                                echo "<div class='w-fit rounded-lg p-1 flex items-center absolute top-2 right-2' style='background: #ffe500;'>";
                                    echo "<img class='w-4 h-4' src='../img/icon/tag.svg' alt='no image'>";
                                    echo "<h1 class='font-bold ml-2'>Php $product[price]</h1>";
                                echo "</div>";
                                echo $product['stock'] <= 0 ? "<img class='absolute left-0 top-0' src='../img/oos.png' alt='no image' style='width: 5em;'>" : "";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="order-container-2">
            <div class="flex flex-col items-center">
                <div class="w-full mt-4 grid place-items-center">
                    <div class="border-show relative" style="width: 70%; height: 10em;">
                        <img class="preview-image w-full h-full" src="../img/no-product.jpg" alt="no image">
                    </div>
                </div>
                <div class="mt-4 w-full hide"> 
                    <div class="flex justify-between" style="width: 60%; padding-left: 15%;">
                        <label class="capitalize">name:</label>
                        <input class="border-show w-1/2 preview-name pl-2" type="text" readonly>
                    </div>
                </div>
                <input class="preview-cost" type="hidden">
                <div class="mt-4 w-full"> 
                    <div class="flex justify-between" style="width: 60%; padding-left: 15%;">
                        <label class="capitalize white">size:</label>
                        <input class="border-show w-1/2 preview-size pl-2" type="text" readonly>
                    </div>
                </div>
                <div class="w-full flex items-center mt-4">
                    <div class="w-1/2 flex justify-between" style="width: 60%; padding-left: 15%;">
                        <label class="capitalize white">quantity:</label>
                        <input class="border-show w-1/2 pl-2 preview-quantity" type="number" readonly>
                    </div>
                    <div class="w-fit flex ml-4 p-1 rounded-lg">
                        <img class="w-4 h-4 subtract" src="../img/icon/square-minus-red.svg" alt="no image" onclick="calculateAmount('subtract', this);">
                        <img class="w-4 h-4 add" src="../img/icon/square-plus-green.svg" alt="no image" onclick="calculateAmount('add', this);">
                    </div>
                </div>
                <div class="w-full flex items-center mt-4">
                    <div class="w-1/2 flex justify-between" style="width: 60%; padding-left: 15%;">
                        <label class="capitalize white">amount:</label>
                        <input class="border-show w-1/2 pl-2 preview-amount" type="text" readonly>
                    </div>
                    <input class="button3 px-4 ml-4 add-button font-semibold" type="button" value="ADD" onclick="addOrder(this, 'employee')">
                </div>
            </div>
            <div class="h-1/2">
                <form class="px-4 h-full flex flex-col justify-evenly items-center" method="post" action="employee-add-order.php" onsubmit="submitOrder(event)">
                    <input class="order-list" type="hidden" name="order" required>
                    <input class="order-bill" type="hidden" name="bill" required> 
                    <input class="order-tax" type="hidden" name="tax" required>
                    <input class="order-cost" type="hidden" name="cost" required>
                    <input class="order-list-text" type="hidden" name="order-list-text" required>
                    <input class="order-price-text" type="hidden" name="order-price-text" required>

                    <h1 class="font-extrabold uppercase white">order</h1>
                    <div class="receipt border-show h-3/5 w-full p-2 overflow-y-auto">
                        <h1 class="capitalize font-bold text-end">total:</h1>
                        <div class="flex justify-between">
                            <pre class="order"></pre>
                            <pre class="amount text-end"></pre>
                        </div>
                        <div class="flex justify-between">
                            <div>Tax (2%)</div>
                            <div class="tax">0.00</div>
                        </div>
                        <div class="border-show my-4"></div>
                        <div class="text-end bill">Php 0.00</div>   
                    </div>
                    <div class="flex justify-between w-full">
                        <input class="button3 w-2/5 rounded-lg py-1 font-semibold" type="button" value="CLEAR" onclick="clearOrder()">
                        <input class="button3 w-2/5 rounded-lg py-1 font-semibold" type="submit" value="PLACE ORDER" name="employee-order-submit">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>