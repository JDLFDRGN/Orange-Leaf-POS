<div id="user-header-popup" class="header-popup w-40 absolute flex flex-col items-center top-full -left-4 p-2 rounded-lg hide">
    <div class="flex items-center mb-2 z-10 w-full">
        <img class="mr-1 w-8 h-8 on-hover-pointer" src="img/icon/user-white.svg" alt="no image">
        <h3 class="on-hover-pointer font-bold" onclick="navigate('user-my-account.php')">My account</h3>
    </div>
    <div class="flex items-center mb-2 z-10 w-full" onclick="navigate('user-my-order.php')">
        <img class="mr-1 h-8 w-8 on-hover-pointer" src="img/icon/order-white.svg" alt="no image">
        <h3 class="on-hover-pointer font-bold">My order</h3>
    </div>
    <div class=" z-10">
        <input class="button2 border-show rounded-lg px-4 py-1 on-hover-pointer font-bold" type="button" value="Sign Out" onclick="navigate('user-logout.php')">
    </div>
    <div class="absolute w-4 h-4 right-6 -top-2 rotate-45 header-popup z-0"></div>
</div>
