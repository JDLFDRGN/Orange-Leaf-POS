<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Home</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/functions.js" defer></script>
</head>
<?php
    include 'sql/queries.php';

    if(isset($_SESSION['account'])){
        $account = $_SESSION['account'];
        $user->userSetActive($account['user_id']);
        
        if(!$user->userEnabled($account['user_id'])) header('Location: disabled.php');
    }   
?>
<body>
    <section class="min-height-full relative">
        <?php require('user-header.php'); ?>
        <div class='index-login-form text-center p-4 border-show hide'>
            <div class=' font-extrabold link text-2xl'>Please Sign In to continue</div>
            <div class='flex mt-4'>
                <div class='button1 font-bold capitalize w-32 mx-2 rounded-lg py-2 on-hover-pointer' onclick='hideForm(`.index-login-form`);'>cancel</div>
                <div class='button1 font-bold capitalize w-32 mx-2 rounded-lg py-2 on-hover-pointer' onclick='navigate(`user-login.php`);'>sign in</div>
            </div>
        </div>
        <div>
            <div class="user-index-header pt-20 p-4 relative">
                <div class="user-index-body fixed" style="z-index: 5;">
                    <div class="flex justify-between w-full">
                        <form class=" w-3/5 flex items-center flex-wrap" method="post">
                            <div class="text-center">
                                <input class="border-show w-32 capitalize category on-hover-pointer" type="submit" name="category" value="All">
                            </div>
                            <?php
                                $categories = $admin->adminAllCategory();
                                
                                foreach($categories as $category){
                                    echo "<div class='text-center category'>";
                                    echo "<input class='border-show capitalize w-32 on-hover-pointer' type='submit' name='category' value='$category[category]'>";
                                    echo "</div>";
                                }
                            ?>
                        </form>
                        <div class="flex rounded-lg p-1 h-10 search" style="margin-right: 2em;">
                            <input class="rounded-lg pl-2" type="search" onkeyup="searchBarItem('.product-container', this);">
                            <img class=" w-8 h-8 pl-1" src="img/icon/search-white.svg" alt="no image">
                        </div>
                    </div>
                </div>
                <div class="product-slider">
                    <img class='h-16 w-16 absolute top-1/2 on-hover-pointer object-cover' style="left: 2em;" onclick="rotate('.product-slider-container', 'left');" src="img/icon/hand-point-left.svg" alt="no image">
                    <img class='h-16 w-16 absolute top-1/2 on-hover-pointer' style="right: 2em;" onclick="rotate('.product-slider-container', 'right');" src="img/icon/hand-point-right.svg" alt="no image">
                    <div class="product-slider-container" data-degree='0'>
                        <?php
                            $productsSlider = $user->userProductSlider();
                            $number = 0;
                            
                            foreach($productsSlider as $productSlider){
                                echo "<div style='--i: $number'><img class='border-show rounded-lg' src='img/uploaded/$productSlider[image]' alt='no img'></div>";
                                $number++;
                            }
                            for($i=$number;$i<6;$i++){
                                echo "<div style='--i: $i' class='border-show bg-white rounded-lg'><img src='img/coming-soon.png' alt='no img'></div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="mt-4 flex flex-wrap">
                    <?php
                        if(isset($_POST['category']) && $_POST['category'] != 'All') $products = $admin->adminFilterProduct($_POST['category']);
                        else $products = $admin->adminAllProduct();
                            
                        foreach($products as $product){
                            echo "<div class='border-show w-fit relative m-4 product-container' onclick='showOrderForm(`.order-container`); previewProduct(this); showAddons(this, `user`)' style='width: 30%; height: fit-content;' data-stock='$product[stock]' data-cost='$product[cost]' data-id='$product[product_id]' data-name='$product[product]' data-size='$product[size]' data-quantity=1 data-amount='$product[price]'>";
                                echo "<img class=' object-cover' src='img/uploaded/$product[image]' alt='no image' style='height: 15em; width: 100%;'>";
                                echo "<div class='bg-black text-center absolute bottom-0 left-0 h-8 w-full flex items-center justify-center'>";
                                    echo "<h1 class='font-bold uppercase' style='color: white;'>$product[product]</h1>";
                                echo "</div>";
                                echo "<div class='w-fit rounded-lg p-1 flex items-center absolute top-2 right-2' style='background: #ffe500;'>";
                                    echo "<img class='w-4 h-4' src='img/icon/tag.svg' alt='no image'>";
                                    echo "<h1 class='font-bold ml-2'>Php $product[price]</h1>";
                                echo "</div>";
                                echo $product['stock'] <= 0 ? "<img class='absolute left-0 top-0' src='img/oos.png' alt='no image' style='width: 5em;'>" : "";
                            echo "</div>";
                        }
                    ?>
                </div>         
            </div>
        </div>
        <div class="order-container flex hide relative">
            <div class='flex w-full justify-end p-2'>
                <img class="h-8 w-8 on-hover-pointer" src="img/icon/xmark-white.svg" alt="no image" onclick="removeOrderForm('.order-container');">
            </div>
            <div class='addons-container slide'>
                <div class="white uppercase font-bold text-2xl text-center">addons</div>
                <div class="addons-body bg-white h-3/5 p-2 overflow-y-auto rounded-lg mt-16">
                              
                </div>
                <div class='w-full flex justify-center mt-8'>
                    <div class='button3 uppercase font-bold w-fit p-2 rounded-lg on-hover-pointer' onclick="hideSlide('.addons-container'); addonsAddAmount();">confirm</div>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-full mt-2 grid place-items-center">
                    <div class="border-show relative" style="width: 70%; height: 10em;">
                        <img class="preview-image w-full h-full" src="img/no-product.jpg" alt="no image">
                    </div>
                </div>
                <div class="mt-4 w-full hide"> 
                    <div class="flex justify-between" style="width: 60%; padding-left: 15%;">
                        <label class="capitalize">name:</label>
                        <input class="border-show w-1/2 preview-name pl-2" type="text" readonly>
                    </div>
                </div>
                <input class="preview-cost" type="hidden">
                <div class="mt-4 w-full flex items-center"> 
                    <div class="flex justify-between" style="width: 60%; padding-left: 15%;">
                        <label class="capitalize white">size:</label>
                        <input class="border-show w-1/2 preview-size pl-2" type="text" readonly>
                    </div>
                    <img class='w-8 h-8 ml-4 on-hover-pointer' src="img/icon/addons-white.svg" alt="no image" onclick="showSlide('.addons-container');">
                </div>
                <div class="w-full flex items-center mt-4">
                    <div class="w-1/2 flex justify-between" style="width: 60%; padding-left: 15%;">
                        <label class="capitalize white">quantity:</label>
                        <input class="border-show w-1/2 pl-2 preview-quantity" type="number" readonly>
                    </div>
                    <div class="w-fit flex ml-4 p-1 rounded-lg">
                        <img class="w-4 h-4 subtract" src="img/icon/square-minus-red.svg" alt="no image" onclick="calculateAmount('subtract', this);">
                        <img class="w-4 h-4 add" src="img/icon/square-plus-green.svg" alt="no image" onclick="calculateAmount('add', this);">
                    </div>
                </div>
                <div class="w-full flex items-center mt-4">
                    <div class="w-1/2 flex justify-between" style="width: 60%; padding-left: 15%;">
                        <label class="capitalize white">amount:</label>
                        <input class="border-show w-1/2 pl-2 preview-amount" type="text" readonly>
                    </div>
                    <input class="button3 px-4 ml-4 add-button font-semibold" type="button" value="ADD" onclick="addOrder(this, 'user')">
                </div>
            </div>
            <div class="h-1/2">
                <form class="px-4 h-full flex flex-col justify-evenly items-center" method="post" data-logged-in="<?php echo isset($account) ? 1 : 0; ?>" action="user-add-order.php" onsubmit="submitOrder(event, this); showForm('.index-login-form');">
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
                        <input class="button3 w-2/5 rounded-lg py-1 font-semibold" type="submit" value="PLACE ORDER" name="user-order-submit">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include 'footer.php';?>
</body>
</html>