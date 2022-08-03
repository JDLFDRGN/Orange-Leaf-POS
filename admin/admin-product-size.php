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
        <form id="admin-delete-size" class="container absolute hide top-1/2 left-1/2 border-show flex flex-col p-4 items-center bg-slate-50 rounded-lg z-10 -translate-x-1/2 -translate-y-1/2" method="post" action="admin-size-delete.php">
            <h1 class="uppercase font-bold">delete size</h1>
            <h1 class="mt-4">Are you sure you want to delete this size?</h1>
            <div class="mt-4">
                <input id="admin-id-size" type="hidden" name="size-id">
                <input class="border-show w-24 rounded-sm on-hover-pointer" type="button" value="No" onclick="hideDeleteForm('#admin-delete-size')">
                <input class="border-show w-24 rounded-sm on-hover-pointer" type="submit" value="Yes" name="admin-size-delete-submit">
            </div>
        </form>
        <div class="w-full flex justify-center h-full absolute pb-4 z-0">
            <form class="mt-20 w-4/5 border-show container flex flex-col items-center p-4 rounded-lg" method="post">
                <div class="flex justify-end w-full">
                    <!-- <select class="px-4 rounded-sm sort">
                        <option>--sort--</option>
                    </select> -->
                    <div class="flex rounded-lg p-1 search">
                        <input class="rounded-lg pl-2" type="search" onkeyup="searchBar('#size-table', this);">
                        <img class=" w-8 h-8 pl-1" src="../img/icon/search-white.svg" alt="no image">
                    </div>
                </div>
                <div class="h-full my-4 overflow-y-auto">
                    <table id="size-table">
                        <tr>
                            <th class="capitalize w-32 text-start pl-2">no.</th>
                            <th class="capitalize w-32 text-start pl-2">size</th>
                            <th class="capitalize w-32 text-start pl-2">date created</th>
                            <th class="capitalize w-32 text-start pl-2">time created</th>
                            <th class="capitalize w-32 text-start pl-2">action</th>
                        </tr>
                        <?php
                            $sizes = $admin->adminAllSize();
                            $number = 1;
                            foreach($sizes as $size){
                                echo "<tr>";
                                    echo "<td class='pl-2'>$number.</td>";
                                    echo "<td class='pl-2'>$size[size]</td>";
                                    echo "<td class='pl-2'>$size[date_created]</td>";
                                    echo "<td class='pl-2'>$size[time_created]</td>";
                                    echo "<td>";
                                        echo "<div class='flex items-center'>";
                                            echo "<button type='button' class='button2 border-show flex items-center rounded-lg px-2 w-20 mx-1' onclick='navigate(`admin-size-edit.php?id=$size[size_id]`);'>";
                                                echo "<img class='w-4 h-4 mr-1' src='../img/icon/edit-blue.svg' alt='no image'>";
                                                echo "<h1 class='font-semibold'>edit</h1>";
                                            echo "</button>";
                                            echo "<button type='button' class='button2 border-show flex items-center rounded-lg px-2 w-20 mx-1' onclick='showDeleteForm(this, `#admin-delete-size`, `#admin-id-size`);' data-id='$size[size_id]'>";
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
                    <button type="button" class="button2 border-show flex items-center w-20 rounded-lg px-2" onclick="navigate('admin-size-add.php');">
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