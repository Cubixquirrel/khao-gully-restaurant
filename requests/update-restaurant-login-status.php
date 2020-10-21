<?php

include_once('../config/db.php');

if (
    ($_POST['restaurantId'] != '') && 
    ($_POST['status'] != '')
) {
    $restaurant_id = $_POST['restaurantId'];
    $status = $_POST['status'];

    if ($status == 'online') {
        $sql_update_restaurant_id = 
        '
        UPDATE restaurant SET restaurant_login_status = "" WHERE id = "'.$restaurant_id.'"
        ';
    } else if ($status == 'offline') {
        $sql_update_restaurant_id = 
        '
        UPDATE restaurant SET restaurant_login_status = "false" WHERE id = "'.$restaurant_id.'"
        ';
    }
    $result_update_restaurant_id = $conn->query($sql_update_restaurant_id);
    
    if ($result_update_restaurant_id) {
        echo $status;
    }
}

?>