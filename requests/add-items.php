<?php

include_once('../config/db.php');

if (
    ($_POST['restaurantId'] != '') && 
    ($_POST['type'] != '') && 
    ($_POST['category'] != '') && 
    ($_POST['foodName'] != '') && 
    ($_POST['price'] != '') && 
    ($_POST['description'] != '')
) {
    $restaurant_id = $_POST['restaurantId'];
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

    $sql_insert_food = 
    '
    INSERT INTO food (
        restaurant_id,
        category_id,
        food_name,
        tmp_price,
        description,
        veg_non_veg,
        stock
    ) VALUES (
        "'.$restaurant_id.'",
        "'.$category_id.'",
        "'.$food_name.'",
        "'.$price.'",
        "'.$description.'",
        "'.$veg_non_veg.'",
        "in"
    )
    ';
    $result_insert_food = $conn->query($sql_insert_food);
    
    if ($result_insert_food) {
        echo 'true';
    }
}

?>