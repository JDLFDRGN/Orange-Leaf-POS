<?php  
    include 'sql/queries.php';
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $product = $admin->adminSpecificProduct($id)->fetch_assoc();
        $productsArr = explode("\n", $product['addons']);
        array_pop($productsArr);
        
        $addons = array();
        $ingredient = array();

        foreach($productsArr as $productArr){
            $addonPrice = $staff->employeeAddonPrice($productArr)->fetch_assoc();
            $ingredient['ingredient'] = $productArr;
            $ingredient['price'] = $addonPrice['price'];
            array_push($addons, $ingredient);
        }
        echo json_encode($addons);
    }
?>