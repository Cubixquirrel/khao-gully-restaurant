<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Add Category';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/add-category.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="add-category-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="add-category-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="add-category-form">
        <div id="add-category-form">
            <div class="pb-10">                
                <div class="label">
                    Category name
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="category-name" id="category-name" onkeyup="enableButton('1')">
                    </div>
                </div>
                        
                <div class="button">
                    <input type="button" value="Add" id="add-button" onclick="addCategory('<?php echo $id; ?>')">
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/add-category.js"></script>
</body>
</html>