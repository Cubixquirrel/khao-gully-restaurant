<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Edit Item';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $sql_select_food = 'SELECT * FROM food WHERE id = "'.$_GET["id"].'"';
    $result_select_food = $conn->query($sql_select_food);
    $row_select_food = $result_select_food->fetch_assoc();
    $food_id = $row_select_food['id'];
    $food_name = $row_select_food['food_name'];
    $food_price = $row_select_food['tmp_price'];
    $food_description = $row_select_food['description'];
    $food_category_id = $row_select_food['category_id'];
    $veg_non_veg = $row_select_food['veg_non_veg'];    
} else {
    header ('location: ../views/edit-items.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $food_name; ?></title>
    <link rel="stylesheet" href="../assets/css/edit-item.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="edit-item-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="edit-item-title">
        <span><?php echo $food_name; ?></span>
    </div>

    <div class="edit-item-form">
        <div id="edit-item-form">
            <div class="pb-10">            
                
                    <?php
                    if ($veg_non_veg == 'veg') {
                        ?>
                        <div class="type-main">
                            <span class="type-box active" data-selected="true" data-type-id="1" onclick="switchType()">Veg</span>
                            <span class="type-box" onclick="switchType()" data-type-id="2">Non veg</span>
                        </div>

                        <input type="hidden" name="type" value="1">
                        <?php
                    } else if ($veg_non_veg == 'non veg') {
                        ?>
                        <div class="type-main">
                            <span class="type-box" data-type-id="1" onclick="switchType()">Veg</span>
                            <span class="type-box active" data-selected="true" onclick="switchType()" data-type-id="2">Non veg</span>
                        </div>
                        
                        <input type="hidden" name="type" value="2">
                        <?php
                    }
                    ?>

                <div class="label mt-25">
                    Category
                </div>
                <div class="category-main">
                <?php
                $sql_select_category = 'SELECT * FROM category WHERE restaurant_id = "'.$id.'" ORDER BY category_name ASC';
                $result_select_category = $conn->query($sql_select_category);
                while ($row_select_category = $result_select_category->fetch_assoc()) {
                    if($row_select_category['id'] == $food_category_id) {
                        $category_id = $row_select_category['id'];
                        ?><span class="category-box active" data-selected="true" data-category-id="<?php echo $row_select_category['id']; ?>" onclick="switchCategory()"><?php echo $row_select_category['category_name']; ?></span><?php
                    } else {
                        ?><span class="category-box" data-category-id="<?php echo $row_select_category['id']; ?>" onclick="switchCategory()"><?php echo $row_select_category['category_name']; ?></span><?php
                    }
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
                        <input type="text" name="foodName" id="food-name" value="<?php echo $food_name; ?>" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                
                <div class="label mt-25" style="display: none">
                    Price
                </div>
                <div class="input-group" style="display: none">
                    <div class="input-control-group">
                        <input type="tel" name="price" id="price" value="<?php echo $food_price; ?>" onkeyup="enableButton('1')">
                    </div>
                </div>
                

                <div class="label mt-25">
                    Description
                </div>
                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="description" id="description" value="<?php echo $food_description; ?>" onkeyup="enableButton('1')">
                    </div>
                </div>
                      
                
                <div class="button">
                    <input type="button" value="Update" id="update-button" onclick="updateItem('<?php echo $food_id; ?>')">
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/edit-item.js"></script>
</body>
</html>