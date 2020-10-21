<?php

include_once('../config/db.php');

if (
    ($_POST['categoryName'] != '')
) {
    $restaurant_id = ucwords($_POST['restaurantId']);
    $category_name = ucwords($_POST['categoryName']);

    $sql_insert_category = 
    '
    INSERT INTO category (
        restaurant_id,
        category_name
    ) VALUES (
        "'.$restaurant_id.'",
        "'.$category_name.'"
    )
    ';
    $result_insert_category = $conn->query($sql_insert_category);
    
    if ($result_insert_category) {
        echo 'true';
    }
}

?>