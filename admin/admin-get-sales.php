<?php
    include '../sql/queries.php';

    $option = '';
    if(isset($_POST['sales-submit'])){
        $option = $_POST['option'];
    }

    if($option == 'day'){
        $sales = $admin->adminSeasonSale('day');
    }else if($option == 'month'){
        $sales = $admin->adminSeasonSale('month');
    }else if($option == 'year'){
        $sales = $admin->adminSeasonSale('year');
    }else{
        $sales = $admin->adminAllSales();
    }
   
    $tax = 0;
    $bill = 0;
    $income = 0;
    $expenses = 0;

    $lineVerticalArr = array();
    $lineHorizontalArr = array();

    foreach($sales as $sale){
        $tax += $sale['tax'];
        $bill += $sale['bill'];
        $expenses += $sale['expenses'];
        
        array_push($lineVerticalArr, $sale['bill']);
        array_push($lineHorizontalArr, $sale['time_accepted']);
       
    }
   
    $income = $bill - ($tax + $expenses);

    $chart = new stdClass();

    $chart->pieTax = $tax;
    $chart->pieIncome = $income;
    $chart->pieExpenses = $expenses;
    $chart->lineVerticalArray = $lineVerticalArr;
    $chart->lineHorizontalArray = $lineHorizontalArr;

    echo json_encode($chart);
?>