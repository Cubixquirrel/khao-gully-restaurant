<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Add Items';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/add-items.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="add-items-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="add-items-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="add-items-form">
        <div id="add-items-form">
            <div class="pb-10">            

                <div class="type-main">
                    <span class="type-box active" data-selected="true" data-type-id="1" onclick="switchType()">Veg</span>
                    <span class="type-box" onclick="switchType()" data-type-id="2">Non veg</span>
                </div>
                <input type="hidden" name="type" value="1">


                <div class="label mt-25">
                    Category
                </div>
                <div class="category-main">
                <?php
                $sql_select_category = 'SELECT * FROM category WHERE restaurant_id = "'.$id.'" ORDER BY category_name ASC';
                $result_select_category = $conn->query($sql_select_category);
                $first = true;
                while ($row_select_category = $result_select_category->fetch_assoc()) {
                    if($first == true) {
                        $category_id = $row_select_category['id'];
                        ?><span class="category-box active" data-selected="true" data-category-id="<?php echo $row_select_category['id']; ?>" onclick="switchCategory()"><?php echo $row_select_category['category_name']; ?></span><?php
                    } else {
                        ?><span class="category-box" data-category-id="<?php echo $row_select_category['id']; ?>" onclick="switchCategory()"><?php echo $row_select_category['category_name']; ?></span><?php
                    }
                    $first = false;
                }
                ?>
                <span class="category-add-box" onclick="openAddCategory()">+ Add category</span>
                </div>
                <input type="hidden" name="category" value="<?php echo $category_id; ?>">


                <div class="label mt-25">
                    Food name
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="foodName" id="food-name" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                
                <div class="label mt-25">
                    Price
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" name="price" id="price" onkeyup="enableButton('1')">
                    </div>
                </div>
                

                <div class="label mt-25">
                    Description
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="description" id="description" onkeyup="enableButton('1')">
                    </div>
                </div>
                      
                
                <div class="button">
                    <input type="button" value="Add" id="add-button" onclick="addItems('<?php echo $id; ?>')">
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/add-items.js"></script>
</body>
</html>