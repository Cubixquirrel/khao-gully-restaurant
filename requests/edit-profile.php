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

function generateRestaurantId($length = 7) {
    $chars = '1234567890';
    $token = '';
    while(strlen($token) < $length) {
        $token .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return $token;
}

if (
    ($_POST['outletName'] != '') && 
    ($_POST['outletAddress'] != '') && 
    ($_POST['outletLatlng'] != '') && 
    ($_POST['pincode'] != '') && 
    ($_POST['contactPersonsName'] != '') && 
    ($_POST['emailId'] != '') && 
    ($_POST['mobileNumber'] != '') && 
    ($_POST['mainTag'] != '') && 
    ($_POST['cuisines'] != '') && 
    ($_POST['averagePricing'] != '') && 
    ($_POST['aadhaarCardValue'] != '') && 
    ($_POST['chequePassbookValue'] != '') && 
    ($_POST['ownerPhotoValue'] != '')
) {
    $outlet_name = ucwords($_POST['outletName']);
    $outlet_address = ucwords($_POST['outletAddress']);
    $outlet_latlng = explode(',', $_POST['outletLatlng']);
    $outlet_lat = $outlet_latlng[0];
    $outlet_lng = $outlet_latlng[1];
    $pincode = $_POST['pincode'];
    $contact_persons_name = ucwords($_POST['contactPersonsName']);
    $email_id = strtolower($_POST['emailId']);
    $mobile_number = $_POST['mobileNumber'];
    $main_tag = ucwords($_POST['mainTag']);
    $cuisines = ucwords($_POST['cuisines']);
    $average_pricing = $_POST['averagePricing'];    
    $restaurant_id = generateRestaurantId(10);

    $sun_timing = $_POST['sunTiming1'].$_POST['sunAmPm1'].' - '.$_POST['sunTiming2'].$_POST['sunAmPm2'];
    $mon_timing = $_POST['monTiming1'].$_POST['monAmPm1'].' - '.$_POST['monTiming2'].$_POST['monAmPm2'];
    $tue_timing = $_POST['tueTiming1'].$_POST['tueAmPm1'].' - '.$_POST['tueTiming2'].$_POST['tueAmPm2'];
    $wed_timing = $_POST['wedTiming1'].$_POST['wedAmPm1'].' - '.$_POST['wedTiming2'].$_POST['wedAmPm2'];
    $thu_timing = $_POST['thuTiming1'].$_POST['thuAmPm1'].' - '.$_POST['thuTiming2'].$_POST['thuAmPm2'];
    $fri_timing = $_POST['friTiming1'].$_POST['friAmPm1'].' - '.$_POST['friTiming2'].$_POST['friAmPm2'];
    $sat_timing = $_POST['satTiming1'].$_POST['satAmPm1'].' - '.$_POST['satTiming2'].$_POST['satAmPm2'];

    // $aadhaar_card = explode('/', $_POST['aadhaarCardValue']);
    $aadhaar_card_name = $_POST['aadhaarCardValue'];

    // $cheque_passbook = explode('/', $_POST['chequePassbookValue']);
    $cheque_passbook_name = $_POST['chequePassbookValue'];

    // $owner_photo = explode('/', $_POST['ownerPhotoValue']);
    $owner_photo_name = $_POST['ownerPhotoValue'];
    
    if ($_POST['fssaiLicenceValue'] != '') {
        // $fssai_licence = explode('/', $_POST['fssaiLicenceValue']);
        $fssai_licence_name = $_POST['fssaiLicenceValue'];
    } else {
        $fssai_licence_name = '';
    }
    
    if ($_POST['gstNumberValue'] != '') {
        // $gst_number = explode('/', $_POST['gstNumberValue']);
        $gst_number_name = $_POST['gstNumberValue'];
    } else {
        $gst_number_name = '';
    }
    
    if ($_POST['restaurantImageValue'] != '') {
        // $restaurant_image = explode('/', $_POST['restaurantImageValue']);
        $restaurant_image_name = $_POST['restaurantImageValue'];
    } else {
        $restaurant_image_name = '';
    }

    $sql_insert_restaurant = 
    '
    INSERT INTO restaurant (
        restaurant_id,
        restaurant_lat,
        restaurant_lng,
        type,
        margin,
        rating,
        total_delivery,
        image,
        name,
        address,
        contact_persons_name,
        email_id,
        contact,
        main_tag,
        cuisines,
        average_pricing,
        sun_timing,
        mon_timing,
        tue_timing,
        wed_timing,
        thu_timing,
        fri_timing,
        sat_timing,
        aadhaar_card,
        cheque_passbook,
        owner_photo,
        fssai_licence,
        gst_number,
        pincode
    ) VALUES (
        "'.$restaurant_id.'",
        "'.$outlet_lat.'",
        "'.$outlet_lng.'",
        "free",
        "22",
        "0",
        "0",
        "'.$restaurant_image_name.'",
        "'.$outlet_name.'",
        "'.$outlet_address.'",
        "'.$contact_persons_name.'",
        "'.$email_id.'",
        "'.$mobile_number.'",
        "'.$main_tag.'",
        "'.$cuisines.'",
        "'.$average_pricing.'",
        "'.$sun_timing.'",
        "'.$mon_timing.'",
        "'.$tue_timing.'",
        "'.$wed_timing.'",
        "'.$thu_timing.'",
        "'.$fri_timing.'",
        "'.$sat_timing.'",
        "'.$aadhaar_card_name.'",
        "'.$cheque_passbook_name.'",
        "'.$owner_photo_name.'",
        "'.$fssai_licence_name.'",
        "'.$gst_number_name.'",
        "'.$pincode.'"
    )
    ';
    $result_insert_restaurant = $conn->query($sql_insert_restaurant);
    $id = $conn->insert_id;
    
    if ($result_insert_restaurant) {
        $sql_insert_category = 'INSERT INTO category (
            restaurant_id, category_name
        ) VALUES (
            "'.$id.'", "'.$main_tag.'"
        )';
        $result_insert_category = $conn->query($sql_insert_category);

        $user_auth = generateToken(80);
        $user_status = 'true';

        $sql_insert_status = 
        '
        INSERT INTO rest_users_login (
            user_id,
            user_auth,
            user_status
        ) VALUES (
            "'.$id.'",
            "'.$user_auth.'",
            "'.$user_status.'"
        )
        ';
        $result_insert_status = $conn->query($sql_insert_status);

        if ($result_insert_status) {
            setcookie('user_auth', $user_auth, time() + (10 * 365 * 24 *60 * 60), '/');
            setcookie('user_status', $user_status, time() + (10 * 365 * 24 *60 * 60), '/');

            echo $user_status;
        }
    }
}

?>