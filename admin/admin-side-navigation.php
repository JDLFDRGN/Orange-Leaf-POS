<nav id="admin-side-nav" class="side-navigation fixed w-14 top-0 -left-14 h-full px-3 z-20 <?php if(!$account['side_bar']) echo "hide";?>">
    <img class="on-hover-pointer mx-2" src="../img/icon/home.svg" alt="no image" width="30" onclick="navigate('admin-home.php');">
    <img class="on-hover-pointer" src="../img/icon/product.svg" alt="no image" onclick="subNav(`<?php if($account['notification']) echo '#admin-products';?>`);" width="30">
    <img class="on-hover-pointer" src="../img/icon/sales.svg" alt="no image" onclick="navigate(`<?php if($account['notification']) echo 'admin-sales.php';?>`);" width="30">
    <img class="on-hover-pointer" src="../img/icon/users.svg" alt="no image" onclick="subNav(`<?php if($account['notification']) echo '#admin-accounts';?>`);" width="30">
    <img class="on-hover-pointer" src="../img/icon/setting.svg" alt="no image" width="30">
    <img class="on-hover-pointer" src="../img/icon/report.svg" alt="no image" width="30">
</nav>
<div id="admin-products" class="side-navigation admin-sub-navigation fixed h-full w-1/4 z-10 top-0 -left-1/4">
    <div class="on-hover-pointer p-1 font-bold"><img src="../img/icon/back.svg" alt="no image" width="30" onclick="subNav('#admin-products');"></div>
    <div class="on-hover-pointer flex justify-center font-bold"><h1 class=" py-4 text-2xl w-11/12 text-center capitalize" onclick="navigate('admin-product-size.php');">sizes</h1></div>
    <div class="on-hover-pointer flex justify-center font-bold"><h1 class=" py-4 text-2xl w-11/12 text-center capitalize" onclick="navigate('admin-product-categories.php');">categories</h1></div>
    <div class="on-hover-pointer flex justify-center font-bold"><h1 class=" py-4 text-2xl w-11/12 text-center capitalize" onclick="navigate('admin-product-ingredients.php');">ingredients</h1></div>
    <div class="on-hover-pointer flex justify-center font-bold"><h1 class=" py-4 text-2xl w-11/12 text-center capitalize" onclick="navigate('admin-product.php');">products</h1></div>
</div>
<div id="admin-accounts" class="side-navigation admin-sub-navigation fixed border-show h-full w-1/4 z-10 top-0 -left-1/4">
    <div class="on-hover-pointer p-1 "><img src="../img/icon/back.svg" alt="no image" width="30" onclick="subNav('#admin-accounts');"></div>
    <div class="on-hover-pointer flex justify-center font-bold <?php echo $account['admin_id'] != 1 ? 'hide' : '';?>"><h1 class=" py-4 text-2xl w-11/12 text-center capitalize" onclick="navigate('superadmin-admin.php')">admins</h1></div>
    <div class="on-hover-pointer flex justify-center font-bold"><h1 class=" py-4 text-2xl w-11/12 text-center capitalize" onclick="navigate('admin-employee.php')">employees</h1></div>
    <div class="on-hover-pointer flex justify-center font-bold"><h1 class=" py-4 text-2xl w-11/12 text-center capitalize" onclick="navigate('admin-user.php')">users</h1></div>
</div>