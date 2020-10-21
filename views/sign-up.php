<?php

include_once('../config/db.php');

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_user = 
    '
    SELECT user_id FROM rest_users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'" 
    ';
    $result_select_user = $conn->query($sql_select_user);
    
    if ($result_select_user->num_rows === 1) {
        header ('location: ../views/dashboard.php');
    }        
}

$page_title = 'Sign Up';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/sign-up.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="sign-up-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="sign-up-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="sign-up-menu">
        <div class="menu-first">
            <span class="sign-up-main-text">Select the margin you are interested in:</span>
            <div class="sign-up-menu-list">
                <span>Share 18% Margin<br>Currently Unavailable</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>

        <div class="menu-first">
            <div class="sign-up-menu-list">
                <span>Share 19% Margin<br>Currently Unavailable</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
        
        <div class="menu-first">
            <div class="sign-up-menu-list">
                <span>Share 20% Margin<br>Currently Unavailable</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
        
        <div class="menu-first">
            <div class="sign-up-menu-list">
                <span>Share 21% Margin<br>Currently Unavailable</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>

        <div class="menu-second">
            <div class="sign-up-menu-list" id="free-registration" onclick="openEditProfile('free')">
                <span>Share 22% Margin<br>Available</span>
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
    </div>

    <script src="../assets/js/sign-up.js"></script>
</body>
</html>