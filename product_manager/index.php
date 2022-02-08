<?php
session_start();
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

if ($action == 'list_products') {
    // Get product data
    $products = get_products();
    // Display the product list
    include('product_list.php');
} else if ($action == 'delete_product') {
    $product_code = filter_input(INPUT_POST, 'product_code');
    //Delete product
    $products=delete_product($product_code);
    // ??? [Done now working]
    header("Location: .");
} else if ($action == 'show_add_form') {
    include ('product_add.php');
    // ???  [done]
} else if ($action == 'add_product') {
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
    
    //$myregx = '~^\d{4}[[:punct:]]\d{2}[[:punct:]]\d{2}$~';
    $myregx ='/^(0?[1-9]|1[0-2])[[:punct:]](0?[1-9]|[12][[:digit:]]|3[01])[[:punct:]][[:digit:]]{4}$/';
    $release_date = filter_input(INPUT_POST, 'release_date', FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$myregx)));
    //$release_date=preg_replace('/[[:punct:]]/','-', $release_date);
    $split= '/[[:punct:]]/';
    $release_date =preg_split($split, $release_date);
    $release_date =array_reverse(($release_date));
    $release_date = implode('-', $release_date);

    // Validate the inputs [date Format]
    if ( $code === NULL || $name === FALSE || 
            $version === NULL || $version === FALSE || 
            $release_date === NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    }elseif(!DateTime::createFromFormat('Y-m-d',$release_date)){
        $error = "Invalid date is entered. Please try again.";
        include('../errors/error.php');
        
    }
     else {
        add_product($code, $name, $version, $release_date);
        header("Location: .");
    }
}
?>