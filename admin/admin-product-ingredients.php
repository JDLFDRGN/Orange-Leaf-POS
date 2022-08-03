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
        <form id="admin-delete-ingredient" class="container absolute hide top-1/2 left-1/2 border-show flex flex-col p-4 items-center bg-slate-50 rounded-lg z-10 -translate-x-1/2 -translate-y-1/2" method="post" action="admin-ingredients-delete.php">
            <h1 class="uppercase font-bold">delete ingredient</h1>
            <h1 class="mt-4">Are you sure you want to delete this ingredient?</h1>
            <div class="mt-4">
                <input id="admin-id-ingredient" type="hidden" name="ingredient-id">
                <input class="border-show w-24 rounded-sm on-hover-pointer" type="button" value="No" onclick="hideDeleteForm('#admin-delete-ingredient')">
                <input class="border-show w-24 rounded-sm on-hover-pointer" type="submit" value="Yes" name="admin-ingredient-delete-submit">
            </div>
        </form>
        <div class="w-full flex justify-center h-full absolute pb-4 z-0">
            <form class="container mt-20 w-4/5 border-show flex flex-col items-center p-4 rounded-lg" method="post">
                <div class="flex justify-end w-full">
                    <!-- <select class="px-4 rounded-sm sort">
                        <option>--sort--</option>
                    </select> -->
                    <div class="flex rounded-lg p-1 search">
                        <input class="rounded-lg pl-2" type="search" onkeyup="searchBar('#ingredients-table',this);">
                        <img class=" w-8 h-8 pl-1" src="../img/icon/search-white.svg" alt="no image">
                    </div>
                </div>
                <div class="h-full my-4 overflow-y-auto">
                    <table id="ingredients-table">
                        <tr>
                            <th class="capitalize w-fit text-start pl-2">no.</th>
                            <th class="capitalize w-32 text-start pl-2">ingredients</th>
                            <th class="capitalize w-32 text-start pl-2">supplier</th>
                            <th class="capitalize w-32 text-start pl-2">stocks</th>
                            <th class="capitalize w-32 text-start pl-2">available</th>
                            <th class="capitalize w-32 text-start pl-2">price</th>
                            <th class="capitalize w-32 text-start pl-2">date created</th>
                            <th class="capitalize w-32 text-start pl-2">time created</th>
                            <th class="capitalize w-32 text-start pl-2">action</th>
                        </tr>
                        <?php
                            $ingredients = $admin->adminAllIngredient();
                            $number = 1;
                            foreach($ingredients as $ingredient){
                                echo "<tr>";
                                    echo "<td class='pl-2'>$number.</td>";
                                    echo "<td class='pl-2'>$ingredient[ingredient]</td>";
                                    echo "<td class='pl-2'>$ingredient[supplier]</td>";
                                    echo "<td class='pl-2'>$ingredient[stock]</td>";
                                    echo "<td class='pl-2'>";
                                    echo $ingredient['stock'] > 0?"yes":"no";
                                    echo "</td>";
                                    echo "<td class='pl-2'>$ingredient[price]</td>";
                                    echo "<td class='pl-2'>$ingredient[date_created]</td>";
                                    echo "<td class='pl-2'>$ingredient[time_created]</td>";
                                    echo "<td>";
                                        echo "<div class='flex'>";
                                            echo "<button type='button' class='button2 flex items-center rounded-lg px-2 w-20 mx-1' onclick='navigate(`admin-ingredients-edit.php?id=$ingredient[ingredient_id]`);'>";
                                                echo "<img class='w-4 h-4 mr-1' src='../img/icon/edit-blue.svg' alt='no image'>";
                                                echo "<h1 class='font-semibold'>edit</h1>";
                                            echo "</button>";
                                            echo "<button type='button' class='button2 flex items-center rounded-lg px-2 w-20 mx-1' onclick='showDeleteForm(this, `#admin-delete-ingredient`, `#admin-id-ingredient`);' data-id='$ingredient[ingredient_id]'>";
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
                    <button type="button" class="button2 flex items-center w-20 rounded-lg px-2" onclick="navigate('admin-ingredients-add.php');">
                        <img class="w-4 h-4 mr-1" src="../img/icon/add-green.svg" alt="no image">
                        <h1>add</h1>
                    </button>
                </div>
            </form>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>