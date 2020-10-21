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

$page_title = "Let's get started";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/edit-profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="edit-profile-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="edit-profile-title">
        <span><?php echo $page_title; ?></span>

        <span class="subtext">Enter your basic details here:</span>
    </div>

    <div class="edit-profile-form">
        <div id="edit-profile-form">
            <div class="pb-10">
                <div class="label">
                    Outlet name
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="outletName" id="outlet-name" onkeyup="enableButton('1')">
                    </div>
                </div>
                
                <div class="label mt-25">
                    Outlet address
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <span class="open-map-button" onclick="openMap()">Live Location</span>
                        <input type="hidden" name="" id="outlet-address">
                        <input type="hidden" name="" id="outlet-latlng">
                        <!-- <input type="text" name="outletAddress" id="outlet-address" onkeyup="enableButton('1')"> -->
                    </div>
                </div>
                
                <div class="label mt-25" style="display: none">
                    Pincode
                </div>

                <div class="input-group" style="display: none">
                    <div class="input-control-group">
                        <input type="tel" minlength="6" maxlength="6" name="pincode" id="pincode" onkeyup="enableButton('1')" readonly>
                    </div>
                </div>
                
                <div class="label mt-25">
                    Contact person's name
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="contactPersonsName" id="contact-persons-name" onkeyup="enableButton('1')">
                    </div>
                </div>
            
                <div class="label mt-25">
                    Email ID
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="emailId" id="email-id" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Mobile no.
                </div>

                <div class="input-group" style="margin: 20px 0;">
                    <img src="../assets/image/flag.png" width="24">

                    <div class="input-control-group">
                        <span>+91</span>
                        <input type="tel" minlength="10" maxlength="10" name="mobileNumber" id="mobile-number" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Main Category
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="mainTag" id="main-tag" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Cuisines
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="text" name="cuisines" id="cuisines" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Average pricing
                </div>

                <div class="input-group">
                    <div class="input-control-group">
                        <input type="tel" name="averagePricing" id="average-pricing" onkeyup="enableButton('1')">
                    </div>
                </div>

                <div class="label mt-25">
                    Uploads
                </div>

                <div class="input-group upload-main">                    
                    <div class="input-control-group uploads-box">
                        <span>Aadhaar card</span>
                        <span class="upload-button" onclick="selectUpload('aadhaar-card')">Upload</span>
                        <input type="file" name="aadhaarCard" id="aadhaar-card" onchange="validateUpload('aadhaar-card')">
                        <input type="hidden" id="aadhaar-card-value">
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Cancelled cheque / bank passbook</span>
                        <span class="upload-button" onclick="selectUpload('cheque-passbook')">Upload</span>
                        <input type="file" name="chequePassbook" id="cheque-passbook" onchange="validateUpload('cheque-passbook')">
                        <input type="hidden" id="cheque-passbook-value">
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Owner photo</span>
                        <span class="upload-button" onclick="selectUpload('owner-photo')">Upload</span>
                        <input type="file" name="ownerPhoto" id="owner-photo" onchange="validateUpload('owner-photo')">
                        <input type="hidden" id="owner-photo-value">
                    </div>

                    <div class="input-control-group uploads-box">
                        <span>FSSAI licence (Optional)</span>
                        <span class="upload-button" onclick="selectUpload('fssai-licence')">Upload</span>
                        <input type="file" name="fssaiLicence" id="fssai-licence" onchange="validateUpload('fssai-licence')">
                        <input type="hidden" id="fssai-licence-value">
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>GST number (Optional)</span>
                        <span class="upload-button" onclick="selectUpload('gst-number')">Upload</span>
                        <input type="file" name="gstNumber" id="gst-number" onchange="validateUpload('gst-number')">
                        <input type="hidden" id="gst-number-value">
                    </div>
                    
                    <div class="input-control-group uploads-box">
                        <span>Restaurant image (Optional)</span>
                        <span class="upload-button" onclick="selectUpload('restaurant-image')">Upload</span>
                        <input type="file" name="restaurantImage" id="restaurant-image" onchange="validateUpload('restaurant-image')">
                        <input type="hidden" id="restaurant-image-value">
                    </div>
                </div>

                <div class="label mt-25">
                    Opening hours
                </div>

                <?php
                for ($x = 0; $x < 7; $x++) {
                    if ($x == 0) $date = 'sun';
                    if ($x == 1) $date = 'mon';
                    if ($x == 2) $date = 'tue';
                    if ($x == 3) $date = 'wed';
                    if ($x == 4) $date = 'thu';
                    if ($x == 5) $date = 'fri';
                    if ($x == 6) $date = 'sat';
                    ?>                    
                    <div class="input-group">
                        <div class="input-control-group timing-group">
                            <span><?php echo ucwords($date); ?></span>

                            <div>
                                <select name="<?php echo $date; ?>Timing1" id="<?php echo $date; ?>-timing-1">
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <select name="<?php echo $date; ?>AmPm1" id="<?php echo $date; ?>-am-pm-1">
                                    <option value="am" selected>am</option>
                                    <option value="pm">pm</option>
                                </select>
                                <span class="timing-separator"></span>
                                <select name="<?php echo $date; ?>Timing2" id="<?php echo $date; ?>-timing-2">
                                    <?php
                                    for ($i = 1; $i < 13; $i++) {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <select name="<?php echo $date; ?>AmPm2" id="<?php echo $date; ?>-am-pm-2">
                                    <option value="am">am</option>
                                    <option value="pm" selected>pm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="button">
                    <input type="button" value="Confirm" id="confirm-button" onclick="editProfile()">
                </div>
            </div>
        </div>
    </div>
    
    <div class="map-container">
        <div id="map" class="map"></div>
        <div class="button map-button">
            <input type="submit" value="Save Address" id="save-address-button">
        </div>
    </div>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWh--A2qe-yWC2AOuC3J6ZiuxtXFUCh24&libraries=&v=weekly"
      defer
    ></script>
    <script src="../assets/js/edit-profile.js"></script>
</body>
</html>