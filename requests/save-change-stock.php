<?php

include_once('../config/db.php');

if (
    ($_POST['foodId'] != '') && 
    ($_POST['stockId'] != '')
) {
    $food_id = $_POST['foodId'];
    $stock_id = $_POST['stockId'];

    if ($stock_id == '1') {
        $stock = 'in';
    } else if ($stock_id == '2') {
        $stock = 'out';
    }

    $sql_update_food = 'UPDATE food SET stock = "'.$stock.'" WHERE id = "'.$food_id.'"';
    $result_update_food = $conn->query($sql_update_food);
    
    if ($result_update_food) {
        echo 'true';
    }
}

?>