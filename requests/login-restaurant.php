<?php

include_once('../config/db.php');

function generateToken($length = 7) {
    $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $token = '';
    while(strlen($token) < $length) {
        $token .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return $token;
}

if (isset($_POST['restaurantId']) && ($_POST['restaurantId'] != '')) {
    $restaurant_id = $_POST['restaurantId'];

    $sql_select_restaurant = 'SELECT * FROM restaurant WHERE restaurant_id = "'.$restaurant_id.'" ORDER BY id DESC LIMIT 1';
    $result_select_restaurant = $conn->query($sql_select_restaurant);
    // echo $sql_select_restaurant;

    if ($result_select_restaurant->num_rows === 1) {
        $row_select_restaurant = $result_select_restaurant->fetch_assoc();
        $id = $row_select_restaurant['id'];
        $user_auth = generateToken(80);
        $user_status = 'true';

        $sql_update_status = 
        '
        UPDATE rest_users_login SET
        user_auth = "'.$user_auth.'",
        user_status = "'.$user_status.'"
        WHERE user_id = "'.$id.'"
        ';
        $result_update_status = $conn->query($sql_update_status);

        if ($result_update_status) {
            setcookie('user_auth', $user_auth, time() + (10 * 365 * 24 *60 * 60), '/');
            setcookie('user_status', $user_status, time() + (10 * 365 * 24 *60 * 60), '/');

            echo $user_status;
        }
    }
}

?>