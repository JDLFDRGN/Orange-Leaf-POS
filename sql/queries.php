<?php
    //error_reporting(0);
    session_start();

    function dbInit(){
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "pos";

        $conn = new mysqli($host, $username, $password, $database);
        return $conn;
    }
    class Admin{
        function adminAddAdmin($image, $firstname, $lastname, $username , $password){
            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');

            $connect = dbInit();
            $query = "INSERT INTO tbl_admin(image, firstname, lastname, username, password, account_enabled, date_created, time_created) VALUES('$image', '$firstname', '$lastname', '$username', '$password', 1, '$date', '$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAllAdmin(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_admin WHERE admin_id != 1";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminSpecificAdmin($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_admin WHERE admin_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminLatestAdmin(){
            $connect = dbInit();
            $query = " SELECT * FROM tbl_admin WHERE admin_id != 1 ORDER BY admin_id DESC LIMIT 1;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminSetAccessibility($id){
            $connect = dbInit();
            $query = "INSERT INTO tbl_admin_accessibility(notification, side_bar, product, sales, accounts, settings, reports, admin_id) VALUES(1,1,1,1,1,1,1,'$id');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminDisableAdmin($id, $isEnabled){
            $connect = dbInit();
            $state = $isEnabled == 1 ? 0 : 1;
            $query = "UPDATE tbl_admin SET account_enabled = '$state' WHERE admin_id = '$id'";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminDeleteAdmin($id){
            $connect = dbInit();
            $query = "DELETE FROM tbl_admin WHERE admin_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminUpdateSession($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_admin INNER JOIN tbl_admin_accessibility ON tbl_admin.admin_id = tbl_admin_accessibility.admin_id WHERE tbl_admin.admin_id = '$id';";
            $result = $connect->query($query);
            $_SESSION['account'] = $result->fetch_assoc() or die($connect->error);
            $connect->close();
            return $result->num_rows > 0 ? 1 : 0;
        }
        function adminExists($username, $password){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_admin INNER JOIN tbl_admin_accessibility ON tbl_admin.admin_id = tbl_admin_accessibility.admin_id WHERE username = '$username' AND password = '$password';
            ";
            $result = $connect->query($query);
            $_SESSION['account'] = $result->fetch_assoc();
            $connect->close();
            return $result->num_rows > 0 ? 1 : 0;
        }
        function adminEnabled($id){
            $connect = dbInit();
            $query = "SELECT account_enabled FROM tbl_admin WHERE admin_id = '$id';";
            $result = $connect->query($query);
            $account = $result->fetch_assoc();
            $connect->close();
            return  $account['account_enabled'] == 1 && $result->num_rows >  0 ? 1 : 0;
        }
        function adminSetActive($id){
            $connect = dbInit();
            $query = "UPDATE tbl_admin SET account_active = 1 WHERE admin_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminSetInactive($id){
            $connect = dbInit();
            $query = "UPDATE tbl_admin SET account_active = 0 WHERE admin_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminUpdateProfile($id, $profile, $firstname, $lastname, $username){
            $connect = dbInit();
            if($profile == null) $query = "UPDATE tbl_admin SET firstname = '$firstname', lastname = '$lastname', username = '$username' WHERE admin_id = '$id';";
            else $query = "UPDATE tbl_admin SET image = '$profile', firstname = '$firstname', lastname = '$lastname', username = '$username' WHERE admin_id = '$id';";
            
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminUpdatePassword($id ,$newPassword){
            $connect = dbInit();
            $query = "UPDATE tbl_admin SET password = '$newPassword' WHERE admin_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAddSize($size){
            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');

            $connect = dbInit();
            $query = "INSERT INTO tbl_size(size, date_created, time_created) VALUES('$size', '$date', '$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminEditSize($id, $size){
            $connect = dbInit();
            $query = "UPDATE tbl_size SET size = '$size' WHERE size_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminDeleteSize($id){
            $connect = dbInit();
            $query = "DELETE FROM tbl_size WHERE size_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminSpecificSize($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_size WHERE size_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAllSize(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_size;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAddCategory($category){
            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');

            $connect = dbInit();
            $query = "INSERT INTO tbl_category(category, date_created, time_created) VALUES('$category', '$date', '$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminEditCategory($id, $category){
            $connect = dbInit();
            $query = "UPDATE tbl_category SET category = '$category' WHERE category_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminDeleteCategory($id){
            $connect = dbInit();
            $query = "DELETE FROM tbl_category WHERE category_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminSpecificCategory($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_category WHERE category_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAllCategory(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_category;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAddIngredient($ingredient, $supplier, $stock, $price){
            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');

            $connect = dbInit();
            $query = "INSERT INTO tbl_ingredient(ingredient, supplier, stock, price, date_created, time_created) VALUES('$ingredient', '$supplier', $stock, '$price', '$date', '$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminEditIngredient($id, $ingredient, $supplier, $stock, $price){
            $connect = dbInit();
            $query = "UPDATE tbl_ingredient SET ingredient = '$ingredient', supplier = '$supplier', stock = $stock, price = '$price' WHERE ingredient_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminDeleteIngredient($id){
            $connect = dbInit();
            $query = "DELETE FROM tbl_ingredient WHERE ingredient_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminSpecificIngredient($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_ingredient WHERE ingredient_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAllIngredient(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_ingredient;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAddProduct($image, $name, $category, $size, $ingredient, $addons, $volume, $price, $cost, $stock){
            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');

            $connect = dbInit();
            $query = "INSERT INTO tbl_product(image,
                                        product,
                                        category, 
                                        size, 
                                        ingredient, 
                                        addons,
                                        volume, 
                                        price, 
                                        cost,
                                        stock, 
                                        date_created, 
                                        time_created)
                                VALUES('$image', 
                                '$name', 
                                '$category', 
                                '$size', 
                                '$ingredient', 
                                '$addons',
                                '$volume', 
                                '$price', 
                                '$cost',
                                $stock, 
                                '$date', 
                                '$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminEditProduct($id, $image, $name, $category, $size, $ingredient, $addons, $volume, $price, $cost, $stock){
            $connect = dbInit();
            $query = $image != '' ? "UPDATE tbl_product SET image = '$image', product = '$name', category = '$category', size = '$size', volume = '$volume', price = $price, cost='$cost', stock = $stock, ingredient = '$ingredient', addons = '$addons' WHERE product_id = '$id';" : "UPDATE tbl_product SET product = '$name', category = '$category', size = '$size', volume = '$volume', price = $price, cost='$cost', stock = $stock, ingredient = '$ingredient', addons = '$addons' WHERE product_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminDeleteProduct($id){
            $connect = dbInit();
            $query = "DELETE FROM tbl_product WHERE product_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminSpecificProduct($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_product WHERE product_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminFilterProduct($category){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_product WHERE category = '$category';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAllProduct(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_product;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAddEmployee($profile, $firstname, $lastname, $email, $password, $gender, $number, $address){
            $connect = dbInit();

            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');
            
            $query = "INSERT INTO tbl_employee(image,
                                        firstname,
                                        lastname,
                                        email, 
                                        password, 
                                        gender, 
                                        phone_number, 
                                        address, 
                                        account_enabled, 
                                        date_created, 
                                        time_created)
                    VALUES('$profile', 
                            '$firstname', 
                            '$lastname', 
                            '$email', 
                            '$password', 
                            '$gender', 
                            '$number', 
                            '$address', 
                            1, 
                            '$date', 
                            '$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminDeleteEmployee($id){
            $connect = dbInit();
            $query = "DELETE FROM tbl_employee WHERE employee_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminSpecificEmployee($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_employee WHERE employee_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAllEmployee(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_employee;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminLatestEmployee(){
            $connect = dbInit();
            $query = " SELECT * FROM tbl_employee ORDER BY employee_id DESC LIMIT 1;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminAllUser(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_user;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminLatestUser(){
            $connect = dbInit();
            $query = " SELECT * FROM tbl_user ORDER BY user_id DESC LIMIT 1;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminSpecificUser($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_user WHERE user_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminDisableUser($id, $isEnabled){
            $connect = dbInit();
            $state = $isEnabled == 1 ? 0 : 1;
            $query = "UPDATE tbl_user SET account_enabled = '$state' WHERE user_id = '$id'";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminDeleteUser($id){
            $connect = dbInit();
            $query = "DELETE FROM tbl_user WHERE user_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminUpdateUserProfile($id, $profile, $firstname, $lastname, $email, $gender, $number, $address){
            $connect = dbInit();
            if($profile == null) $query = "UPDATE tbl_user SET firstname = '$firstname', lastname = '$lastname', email = '$email', gender = '$gender', phone_number = '$number', address = '$address' WHERE user_id = '$id';";
            else $query = "UPDATE tbl_user SET image = '$profile', firstname = '$firstname', lastname = '$lastname', email = '$email', gender = '$gender', phone_number = '$number', address = '$address' WHERE user_id = '$id';";
            
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminUpdateEmployeeProfile($id, $profile, $firstname, $lastname, $email, $gender, $number, $address){
            $connect = dbInit();
            if($profile == null) $query = "UPDATE tbl_employee SET firstname = '$firstname', lastname = '$lastname', email = '$email', gender = '$gender', phone_number = '$number', address = '$address' WHERE employee_id = '$id';";
            else $query = "UPDATE tbl_employee SET image = '$profile', firstname = '$firstname', lastname = '$lastname', email = '$email', gender = '$gender', phone_number = '$number', address = '$address' WHERE employee_id = '$id';";
            
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminDisableEmployee($id, $isEnabled){
            $connect = dbInit();
            $state = $isEnabled == 1 ? 0 : 1;
            $query = "UPDATE tbl_employee SET account_enabled = '$state' WHERE employee_id = '$id'";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function admminUpdateIngredientStock($id, $newval){
            $connect = dbInit();
            $query = "UPDATE tbl_ingredient SET stock = '$newval' WHERE ingredient_id = '$id'";
            $result = $connect->query($query);
            $connect->close();
            return $connect;
        }
        function adminAllSales(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_sales INNER JOIN tbl_orders ON tbl_sales.orders_id = tbl_orders.orders_id;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function adminSeasonSale($season){
            $connect = dbInit();
            date_default_timezone_set('Asia/Manila');

            if($season == 'day'){
                $day = date('m-d-Y');
                $query = "SELECT * FROM tbl_sales INNER JOIN tbl_orders ON tbl_sales.orders_id = tbl_orders.orders_id WHERE date_accepted = '$day';";
            }else if($season == 'month'){
                $month = date('m');
                $year = date('Y');
                $query = "SELECT * FROM tbl_sales INNER JOIN tbl_orders ON tbl_sales.orders_id = tbl_orders.orders_id WHERE date_accepted LIKE '$month%$year';";
            }else if($season == 'year'){
                $year = date('Y');
                $query = "SELECT * FROM tbl_sales INNER JOIN tbl_orders ON tbl_sales.orders_id = tbl_orders.orders_id WHERE date_accepted LIKE '%$year%';";
            }
            $time = date('h:ia');

            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
    }
    class Employee{
        function employeeUpdatePassword($id, $newPassword){    
            $connect = dbInit();
            $query = "UPDATE tbl_employee SET password = '$newPassword' WHERE employee_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeExists($email, $password){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_employee WHERE email = '$email' AND password = '$password';";
            $result = $connect->query($query);
            $_SESSION['account'] = $result->fetch_assoc();
            $connect->close();
            return $result->num_rows > 0 ? 1 : 0;
        }
        function employeeEnabled($id){
            $connect = dbInit();
            $query = "SELECT account_enabled FROM tbl_employee WHERE employee_id = '$id';";
            $result = $connect->query($query);
            $account = $result->fetch_assoc();
            $connect->close();
            return  $account['account_enabled'] == 1 && $result->num_rows >  0 ? 1 : 0;
        }  
        function employeeSetActive($id){
            $connect = dbInit();
            $query = "UPDATE tbl_employee SET account_active = 1 WHERE employee_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeSetInactive($id){
            $connect = dbInit();
            $query = "UPDATE tbl_employee SET account_active = 0 WHERE employee_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeHideOrder($id){
            $connect = dbInit();
            $query = "UPDATE tbl_orders SET employee_hide = 1 WHERE orders_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeAcceptOrder($id){
            $connect = dbInit();
            $query = "UPDATE tbl_orders SET order_successful = 1 WHERE orders_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeDeclineOrder($id){
            $connect = dbInit();
            $query = "UPDATE tbl_orders SET order_successful = -1 WHERE orders_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeAddSales($id, $acceptor){
            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');

            $connect = dbInit();
            $query = "INSERT INTO tbl_sales(orders_id, acceptor_id, date_accepted, time_accepted) VALUES('$id', '$acceptor', '$date', '$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeUpdateStock($id, $newval){
            $connect = dbInit();
            $query = "UPDATE tbl_product SET stock = $newval WHERE product_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeUpdateSession($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_employee WHERE employee_id = '$id';";
            $result = $connect->query($query);
            $_SESSION['account'] = $result->fetch_assoc() or die($connect->error);
            $connect->close();
            return $result->num_rows > 0 ? 1 : 0;
        }
        function employeeSales($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_sales INNER JOIN tbl_orders ON tbl_sales.orders_id = tbl_orders.orders_id WHERE acceptor_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function employeeAddonPrice($addon){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_ingredient WHERE ingredient = '$addon' LIMIT 1;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
    }
    class User{
        function userExists($email, $password){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password';";
            $result = $connect->query($query);
            $_SESSION['account'] = $result->fetch_assoc();
            $connect->close();
            return $result->num_rows > 0 ? 1 : 0;
        }
        function userUpdatePassword($id, $newPassword){    
            $connect = dbInit();
            $query = "UPDATE tbl_user SET password = '$newPassword' WHERE user_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userSignup($profile, $firstname, $lastname, $email, $password, $gender, $number, $address){
            $connect = dbInit();

            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');
            
            $query = "INSERT INTO tbl_user(image,
                                        firstname,
                                        lastname,
                                        email, 
                                        password, 
                                        gender, 
                                        phone_number, 
                                        address, 
                                        account_enabled, 
                                        date_created, 
                                        time_created)
                    VALUES('$profile', 
                            '$firstname', 
                            '$lastname', 
                            '$email', 
                            '$password', 
                            '$gender', 
                            '$number', 
                            '$address', 
                            1, 
                            '$date', 
                            '$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userSetActive($id){
            $connect = dbInit();
            $query = "UPDATE tbl_user SET account_active = 1 WHERE user_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userSetInactive($id){
            $connect = dbInit();
            $query = "UPDATE tbl_user SET account_active = 0 WHERE user_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userEnabled($id){
            $connect = dbInit();
            $query = "SELECT account_enabled FROM tbl_user WHERE user_id = '$id';";
            $result = $connect->query($query);
            $account = $result->fetch_assoc();
            $connect->close();
            return  $account['account_enabled'] == 1 && $result->num_rows >  0 ? 1 : 0;
        }
        function userAddOrder($id, $order, $bill, $tax, $expenses, $orderText, $priceText){
            date_default_timezone_set('Asia/Manila');
            $date = date('m-d-Y');
            $time = date('h:ia');

            $connect = dbInit();
            $query = "INSERT INTO tbl_orders(user_id, orders, bill, tax, expenses, order_text, price_text, date_ordered, time_ordered) VALUES('$id','$order', '$bill', '$tax', '$expenses','$orderText', '$priceText',  '$date','$time');";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userAllOrders(){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_orders;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userLatestOrders(){
            $connect = dbInit();
            $query = " SELECT * FROM tbl_orders ORDER BY orders_id DESC LIMIT 1;";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userSpecificOrders($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_orders WHERE orders_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userMyOrders($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_orders INNER JOIN tbl_user ON tbl_orders.user_id = tbl_user.user_id WHERE tbl_user.user_id = '$id';";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
        function userUpdateSession($id){
            $connect = dbInit();
            $query = "SELECT * FROM tbl_user WHERE user_id = '$id';";
            $result = $connect->query($query);
            $_SESSION['account'] = $result->fetch_assoc() or die($connect->error);
            $connect->close();
            return $result->num_rows > 0 ? 1 : 0;
        }
        function userProductSlider(){
            $connect = dbInit();
            $query = "SELECT image FROM tbl_product ORDER BY product_id DESC LIMIT 6";
            $result = $connect->query($query);
            $connect->close();
            return $result;
        }
    }
    $user = new User();
    $admin = new Admin();
    $staff = new Employee();
    $connect = dbInit();
?>