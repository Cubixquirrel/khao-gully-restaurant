<?php

include_once('../config/db.php');

if (
    ($_POST['foodId'] != '') && 
    ($_POST['type'] != '') && 
    ($_POST['category'] != '') && 
    ($_POST['foodName'] != '') && 
    ($_POST['price'] != '') && 
    ($_POST['description'] != '')
) {
    $food_id = $_POST['foodId'];
    $type_id = $_POST['type'];
    $category_id = $_POST['category'];
    $food_name = ucwords($_POST['foodName']);
    $price = number_format($_POST['price']);
    $description = ucwords($_POST['description']);

    if ($type_id == '1') {
        $veg_non_veg = 'veg';
    } else if ($type_id == '2') {
        $veg_non_veg = 'non veg';
    }

    $sql_update_food = 
    '
    UPDATE food SET veg_non_veg = "'.$veg_non_veg.'", category_id = "'.$category_id.'", food_name = "'.$food_name.'", 
    tmp_price = "'.$price.'", description = "'.$description.'" WHERE id = "'.$food_id.'"
    ';
    $result_update_food = $conn->query($sql_update_food);
    
    if ($result_update_food) {
        echo 'true';
    }
}

?>