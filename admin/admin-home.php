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

    if(!$account) header('Location: admin-login.php');
    else if(!$admin->adminEnabled($account['admin_id'])) header('Location: ../disabled.php');
    
    $admin->adminSetActive($account['admin_id']);
    $adminCount = $admin->adminAllAdmin()->num_rows;
    $employeeCount = $admin->adminAllEmployee()->num_rows;
    $userCount = $admin->adminAllUser()->num_rows;
    $productCount = $admin->adminAllProduct()->num_rows;

    $adminLatest = $admin->adminLatestAdmin()->fetch_assoc();
    $userLatest = $admin->adminLatestUser()->fetch_assoc();
    $employeeLatest = $admin->adminLatestEmployee()->fetch_assoc();
?>
<body>
    <section class="min-height-full relative">
        <?php
            require('admin-header.php');
            require('admin-side-navigation.php');
        ?>
        <div id="admin-home">
            <div id="total-admin" class="border-show w-full text-center rounded-lg p-4 relative">
                <h1 class="uppercase text-2xl font-bold">total admins:</h1>
                <h1 class="uppercase text-2xl font-bold"><?php echo $adminCount;?></h1>
                <a class="flex items-center justify-end mt-8" href="superadmin-admin.php">
                    <h1 class="capitalize font-medium">view</h1>
                    <img class=" h-4 w-4" src="../img/icon/view.svg" alt="no image">
                </a>
            </div>
            <div id="total-employee" class="border-show w-full text-center rounded-lg p-4 relative">
                <h1 class=" uppercase text-2xl font-bold">total employees:</h1>
                <h1 class=" uppercase text-2xl font-bold"><?php echo $employeeCount;?></h1>
                <a class="flex items-center justify-end mt-8" href="admin-employee.php">
                    <h1 class="capitalize font-medium">view</h1>
                    <img class=" h-4 w-4" src="../img/icon/view.svg" alt="no image">
                </a>
            </div>
            <div id="total-user" class="border-show w-full text-center rounded-lg p-4 relative">
                <h1 class=" uppercase text-2xl font-bold">total users:</h1>
                <h1 class=" uppercase text-2xl font-bold"><?php echo $userCount;?></h1>
                <a class="flex items-center justify-end mt-8" href="admin-user.php">
                    <h1 class="capitalize font-medium">view</h1>
                    <img class=" h-4 w-4" src="../img/icon/view.svg" alt="no image">
                </a>
            </div>
            <div id="total-product" class="border-show w-full text-center rounded-lg p-4 relative">
                <h1 class=" uppercase text-2xl font-bold">total products:</h1>
                <h1 class=" uppercase text-2xl font-bold"><?php echo $productCount;?></h1>
                <a class="flex items-center justify-end mt-8" href="admin-product.php">
                    <h1 class="capitalize font-medium">view</h1>
                    <img class=" h-4 w-4" src="../img/icon/view.svg" alt="no image">
                </a>
            </div>
            <div id="new-accounts" class="container border-show h-full w-full rounded-lg p-4 flex flex-col justify-between">
                <div>
                    <h1 class=" uppercase font-semibold text-2xl">new admin:</h1>
                    <table class="w-full mt-4">
                        <tr class="w-full">
                            <th class="capitalize w-1/4 text-start pl-4">image</th>
                            <th class="capitalize w-1/4 text-start pl-4">username</th>
                            <th class="capitalize w-1/4 text-start pl-4">date created</th>
                            <th class="capitalize w-1/4 text-start pl-4">time created</th>
                        </tr>
                        <tr>
                            <td class="capitalize w-1/4"><?php echo isset($adminLatest) ? '' : 'No data';?><img class=" rounded-lg border-show mx-auto <?php echo !isset($adminLatest) ? 'hide' : '';?>" src="../img/uploaded/<?php echo $adminLatest['image'];?>" alt="no image" style="height: 10em; width: 9em"></th>
                            <td class="capitalize w-1/4 text-start pl-4"><?php echo isset($adminLatest) ? $adminLatest['username'] : 'No data';?></td>
                            <td class="capitalize w-1/4 text-start pl-4"><?php echo isset($adminLatest) ? $adminLatest['date_created'] : 'No data';?></td>
                            <td class="capitalize w-1/4 text-start pl-4"><?php echo isset($adminLatest) ? $adminLatest['time_created'] : 'No data';?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h1 class=" uppercase font-semibold text-2xl">new employee:</h1>
                    <table class="w-full mt-4">
                        <tr class="w-full">
                            <th class="capitalize w-1/4 text-start pl-4">image</th>
                            <th class="capitalize w-1/4 text-start pl-4">email</th>
                            <th class="capitalize w-1/4 text-start pl-4">date created</th>
                            <th class="capitalize w-1/4 text-start pl-4">time created</th>
                        </tr>
                        <tr>
                            <td class="capitalize w-1/4"><?php echo isset($employeeLatest) ? '' : 'No data';?><img class=" rounded-lg border-show mx-auto <?php echo !isset($employeeLatest) ? 'hide' : '';?>" src="../img/uploaded/<?php echo $employeeLatest['image'];?>" alt="no image" style="height: 10em; width: 9em"></th>
                            <td class="w-1/4 text-start pl-4"><?php echo isset($employeeLatest) ? $employeeLatest['email'] : 'No data';?></td>
                            <td class="capitalize w-1/4 text-start pl-4"><?php echo isset($employeeLatest) ? $employeeLatest['date_created'] : 'No data';?></td>
                            <td class="capitalize w-1/4 text-start pl-4"><?php echo isset($employeeLatest) ? $employeeLatest['time_created'] : 'No data';?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h1 class=" uppercase font-semibold text-2xl">new user:</h1>
                    <table class="w-full mt-4">
                        <tr class="w-full">
                            <th class="capitalize w-1/4 text-start pl-4">image</th>
                            <th class="capitalize w-1/4 text-start pl-4">email</th>
                            <th class="capitalize w-1/4 text-start pl-4">date created</th>
                            <th class="capitalize w-1/4 text-start pl-4">time created</th>
                        </tr>
                        <tr>
                            <td class="capitalize w-1/4"><?php echo isset($userLatest) ? '' : 'No data';?><img class=" rounded-lg border-show mx-auto <?php echo !isset($userLatest) ? 'hide' : '';?>" src="../img/uploaded/<?php echo $userLatest['image'];?>" alt="no image" style="height: 10em; width: 9em"></th>
                            <td class="w-1/4 text-start pl-4"><?php echo isset($userLatest) ? $userLatest['email'] : 'No data';?></td>
                            <td class="capitalize w-1/4 text-start pl-4"><?php echo isset($userLatest) ? $userLatest['date_created'] : 'No data';?></td>
                            <td class="capitalize w-1/4 text-start pl-4"><?php echo isset($userLatest) ? $userLatest['time_created'] : 'No data';?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="product-recognition" class="container border-show w-full rounded-lg p-4 h-full relative flex flex-col justify-between">
                <div>
                    <h1 class="capitalize text-2xl font-bold text-center">product of the year</h1>
                    <img class=" mt-4" src="../img/hamburger.jpg" alt="no image" style="height: 15em; width: 100%">
                    <p class="capitalize mt-4 font-medium">name: hawaiian burger</p>
                    <p class="capitalize font-medium">price: P520.00</p>
                </div>
                <div>
                    <h1 class="capitalize text-2xl font-bold text-center">product of the month</h1>
                    <img class=" mt-4" src="../img/nacho.jpg" alt="no image" style="height: 15em; width: 100%">
                    <p class="capitalize mt-4 font-medium">name: nachos overload</p>
                    <p class="capitalize font-medium">price: P999.00</p>
                </div>
                <div>
                    <h1 class="capitalize text-2xl font-bold text-center">product of the day</h1>
                    <img class=" mt-4" src="../img/ice-tea.jpg" alt="no image" style="height: 15em; width: 100%">
                    <p class="capitalize mt-4 font-medium">name: Orange Cold-Brewed Tea</p>
                    <p class="capitalize font-medium">price: P200.00</p>
                </div>
            </div>
        </div>
    </section>
    <?php include '../footer.php';?>
</body>
</html>