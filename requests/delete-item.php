<?php

include_once('../config/db.php');

if (
    ($_POST['foodId'] != '')
) {
    $food_id = $_POST['foodId'];

    $sql_delete_food = 'DELETE FROM food WHERE id = "'.$food_id.'"';
    $result_delete_food = $conn->query($sql_delete_food);
    
    if ($result_delete_food) {
        echo 'true';
    }
}

?>