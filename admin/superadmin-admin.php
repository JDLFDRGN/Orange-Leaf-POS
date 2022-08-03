<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pos Inventory System">
    <title>Admin</title>
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
        <form id="admin-delete-admin" class="absolute hide top-1/2 left-1/2 border-show flex flex-col p-4 items-center bg-slate-50 rounded-lg z-10 -translate-x-1/2 -translate-y-1/2" method="post" action="superadmin-admin-delete.php">
            <h1 class="uppercase font-bold">delete admin</h1>
            <h1 class="mt-4">Are you sure you want to delete this admin?</h1>
            <div class="mt-4">
                <input id="admin-id-admin" type="hidden" name="admin-id">
                <input class="border-show w-24 rounded-sm on-hover-pointer" type="button" value="No" onclick="hideDeleteForm('#admin-delete-admin');">
                <input class="border-show w-24 rounded-sm on-hover-pointer" type="submit" value="Yes" name="admin-delete-submit">
            </div>
        </form>
        <div id="admin-view-employee" class=" bg-slate-50 p-4 hide absolute border-show rounded-lg w-2/5 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
            <div class="flex items-center">
                <img class="border-show rounded-lg mr-4 set-image" src="../img/no-profile.png" alt="no image" style="height: 10rem; width: 9rem;">
                <div class="w-full">
                    <div class="flex justify-end w-full">
                        <img class="h-8 w-8 on-hover-pointer" src="../img/icon/remove.svg" alt="no image" onclick="hideForm('#admin-view-employee');">
                    </div>
                    <div>
                        <span class="font-semibold capitalize">admin number:</span>
                        <span class="capitalize set-id"></span>
                    </div>
                    <div>
                        <span class="font-semibold capitalize">full name:</span>
                        <span class="capitalize set-fullname"></span>
                    </div>
                    <div>
                        <span class="font-semibold capitalize">username:</span>
                        <span class="set-email"></span>
                    </div>
                    <div>
                        <span class="font-semibold capitalize hide">gender:</span>
                        <span class="set-gender"></span>
                    </div>
                    <div>
                        <span class="font-semibold capitalize hide">phone number:</span>
                        <span class="set-number"></span>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <span class="font-semibold capitalize">password:</span>
                <span class="set-password"></span>
            </div>
            <div>
                <span class="font-semibold capitalize hide">address:</span>
                <span class="set-address"></span>
            </div>
            <div>
                <span class="font-semibold capitalize">account enabled:</span>
                <span class="set-account-enabled"></span>
            </div>
            <div>
                <span class="font-semibold capitalize">account active:</span>
                <span class="set-account-active"></span>
            </div>
            <div>
                <span class="font-semibold capitalize">date created:</span>
                <span class="set-date"></span>
            </div>
            <div>
                <span class="font-semibold capitalize">time created:</span>
                <span class="set-time"></span>
            </div>
        </div>
        <div class="w-full flex justify-center h-full absolute pb-4 z-0">
            <form class="container mt-20 w-4/5 border-show flex flex-col items-center p-4 rounded-lg" method="post">
                <div class="flex justify-end w-full">
                    <!-- <select class="px-4 rounded-sm sort">
                        <option>--sort--</option>
                    </select> -->
                    <div class="flex rounded-lg p-1 search">
                        <input class="rounded-lg pl-2" type="search" onkeyup="searchBar('#employee-table', this);">
                        <img class=" w-8 h-8 pl-1" src="../img/icon/search-white.svg" alt="no image">
                    </div>
                </div>
                <div class="h-full my-4 overflow-y-auto">
                    <table id="employee-table">
                        <tr>
                            <th class="capitalize w-14 text-start pl-2">no.</th>
                            <th class="capitalize w-fit text-start pl-2">profile</th>
                            <th class="capitalize w-32 text-start pl-2">firstname</th>
                            <th class="capitalize w-32 text-start pl-2">lastname</th>
                            <th class="capitalize w-32 text-start pl-2">date created</th>
                            <th class="capitalize w-32 text-start pl-2">time created</th>
                            <th class="capitalize w-32 text-start pl-2">action</th>
                        </tr>
                        <?php
                            $admins = $admin->adminAllAdmin();
                            $number = 1;
                            foreach($admins as $admin){
                                echo "<tr data-image='$admin[image]' data-id='$admin[admin_id]' data-firstname='$admin[firstname]' data-lastname='$admin[lastname]' data-email='$admin[username]' data-password='$admin[password]' data-gender='' data-number='' data-address='' data-account-enabled='$admin[account_enabled]' data-account-active='$admin[account_active]' data-date-created='$admin[date_created]' data-time-created='$admin[time_created]'>";
                                    echo "<td class='pl-2'>$number.</td>";
                                    echo "<td><img class='border-show' src='../img/uploaded/$admin[image]' alt='no image' style='width: 4em; height: 5em;'></td>";
                                    echo "<td class='pl-2'>$admin[firstname]</td>";
                                    echo "<td class='pl-2'>$admin[lastname]</td>";
                                    echo "<td class='pl-2'>$admin[date_created]</td>";
                                    echo "<td class='pl-2'>$admin[time_created]</td>";
                                    echo "<td>";
                                        echo "<div class='flex' style='margin-bottom: 5px;'>";
                                            echo "<button type='button' class='button2 flex items-center rounded-lg px-2 w-20 mx-1' onclick='showUser(this, `#admin-view-employee`);'>";
                                                echo "<img class='w-4 h-4 mr-1' src='../img/icon/pointer-skyblue.svg' alt='no image'>";
                                                echo "<h1 class='font-semibold'>view</h1>";
                                            echo "</button>";
                                            echo "<button type='button' class='button2 flex items-center rounded-lg px-2 w-20 mx-1' onclick='navigate(`superadmin-admin-state.php?id=$admin[admin_id]&state=$admin[account_enabled]`)' data-id='$admin[admin_id]'>";
                                                echo  $admin['account_enabled'] ? "<img class='w-4 h-4' src='../img/icon/employee-purple.svg' alt='no image'>" : "<img class='w-4 h-4' src='../img/icon/ban-purple.svg' alt='no image'>"; 
                                                echo !$admin['account_enabled'] ? "<h1 class='font-semibold'>enable</h1>" : "<h1 class='font-semibold'>disable</h1>";
                                            echo "</button>";    
                                        echo "</div>";                
                                        echo "<div class='flex' style='margin-top: 5px;'>";
                                            echo "<button type='button' class='button2 flex items-center rounded-lg px-2 w-20 mx-1' onclick='navigate(`superadmin-admin-edit.php?id=$admin[admin_id]`);'>";
                                                echo "<img class='w-4 h-4 mr-1' src='../img/icon/edit-blue.svg' alt='no image'>";
                                                echo "<h1 class='font-semibold'>edit</h1>";
                                            echo "</button>";
                                            echo "<button type='button' class='button2 flex items-center rounded-lg px-2 w-20 mx-1' onclick='showDeleteForm(this, `#admin-delete-admin`, `#admin-id-admin`);' data-id='$admin[admin_id]'>";
                                                echo "<img class='w-4 h-4 mr-1' src='../img/icon/remove-all-red.svg' alt='no image'>";
                                                echo "<h1 class='font-semibold'>delete</h1>";
                                            echo "</button>";    
                                        echo "</div>";                        
                                    echo "</td>";
                                echo "</tr>";
                                $number++;
                            }
                        ?>
                    </table>
                </div>
                <div class="w-full flex justify-end">
                    <button type="button" class="button2 flex items-center w-20 rounded-lg px-2" onclick="navigate('superadmin-admin-add.php');">
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