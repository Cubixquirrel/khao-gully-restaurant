<?php

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_rest_user = 'SELECT user_id FROM rest_users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'"';
    $result_select_rest_user = $conn->query($sql_select_rest_user);
    
    if ($result_select_rest_user->num_rows === 1) {
        $row_select_rest_user = $result_select_rest_user->fetch_assoc();

        $sql_select_data = 'SELECT * FROM restaurant WHERE id = "'.$row_select_rest_user["user_id"].'"';
        $result_select_data = $conn->query($sql_select_data);
        $row_select_data = $result_select_data->fetch_assoc();

        if ($row_select_data['restaurant_status'] == '') {
            header ('location: ../views/dashboard-pending.php');    
        } else {
            $id               = $row_select_data['id'];
            $restaurant_id    = $row_select_data['restaurant_id'];
            $restaurant_name  = $row_select_data['name'];
        }
    } else {
        header ('location: ../views/login.php');
    } 
} else {
    header ('location: ../views/login.php');
}

?>