<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Edit Items';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/edit-items.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="edit-items-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="edit-items-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="edit-items-menu">
        <?php
        $sql_select_food = 'SELECT * FROM food WHERE restaurant_id = "'.$id.'" ORDER BY food_name ASC';
        $result_select_food = $conn->query($sql_select_food);
        if ($result_select_food->num_rows > 0) {
            while ($row_select_food = $result_select_food->fetch_assoc()) {
                ?>
                <div class="menu-first">
                    <div class="edit-items-menu-list">
                        <?php
                        if ($row_select_food['stock'] == 'in') {
                            ?><span data-food-name-id="<?php echo $row_select_food['id']; ?>"><?php echo $row_select_food['food_name']; ?></span><?php
                        } else if ($row_select_food['stock'] == 'out') {
                            ?><span data-food-name-id="<?php echo $row_select_food['id']; ?>" class="out-of-stock-food-name"><?php echo $row_select_food['food_name']; ?> (Out of stock)</span><?php
                        }
                        ?>
                        <span>Rs. <?php echo $row_select_food['tmp_price']; ?></span>
                        <span><?php echo $row_select_food['description']; ?></span>

                        <div class="edit-items-action">
                            <div>
                                <span onclick="editItem('<?php echo $row_select_food['id']; ?>')">Edit</span>
                                <span data-food-span-id="<?php echo $row_select_food['id']; ?>" onclick="openChangeStock('<?php echo $row_select_food['id']; ?>', '<?php echo $row_select_food['stock']; ?>');">Change Stock</span>
                                <span onclick="deleteItem('<?php echo $row_select_food['id']; ?>')">Delete</span>
                            </div>

                            <?php
                                if ($row_select_food['food_status'] == 'true') {
                                    ?>
                                    <div>
                                        <span class="active">Approved</span>                            
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div>
                                        <span class="pending">Pending</span>                            
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?><span class="empty-box">No item added</span><?php
        }
        ?>
    </div>

    <div class="shadow-main"></div>

    <div class="change-stock-main">
        <div class="change-stock-group fl-sb">
            <span class="change-stock-title">Update Stock</span>
            <i class="fas fa-times close-button" onclick="closeChangeStock()"></i>
        </div>

        <div class="stock-main">
            <span onclick="updateChangeStock()" data-stock-id="1">In stock</span>
            <span onclick="updateChangeStock()" data-stock-id="2">Out of stock</span>
        </div>
        <input type="hidden" name="stock-id">

        <input type="submit" value="Save" class="change-stock-button">
    </div>
    
    <script src="../assets/js/edit-items.js"></script>
</body>
</html>