<?php
session_start();

require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/registration_db.php');


$action = filter_input(INPUT_POST, 'action');


if ($action === NULL) {
    // ???
    $action = filter_input(INPUT_GET, 'action');
        if(isset($_SESSION['mail'])){    
            $action = 'get_customer';
            //include('product_register.php');
        }
        if($action === NULL){
        $action = 'login_customer';
        }
    }


if ($action == 'login_customer') {
    // ???    
    include('customer_login.php');
}else if ($action == 'get_customer') {
    // ???    
//instantiate variable(s)
    $email = '';

    //start session
    $lifetime= 60 * 60 * 24 *14;
    session_set_cookie_params($lifetime, '/');
    

    //$_SESSION["email"] = filter_input(INPUT_POST, 'email');
    if(!isset($_SESSION['mail'])) {
        $_SESSION['mail'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    }
    $email = $_SESSION["mail"];

    if($email === NULL){
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    }
    else {
        if(!isset($_SESSION['customer'])) {
            $_SESSION['customer'] = array();
            $_SESSION['customer'] = get_customer_by_email($email);
        }
        
        $customer = $_SESSION['customer'];

        if(!isset($_SESSION['products'])){
            $_SESSION['products'] = array();
            $_SESSION ["products"] = get_products();
        }

        
        $products = $_SESSION ["products"];

        if($customer === NULL || $products === NULL){
            $error = "Invalid product data. Check all fields and try again.";
            include('../errors/error.php');
        } else if (empty($products)) {
            $error = "There is no product rgistered for this user. Please check all fields and try again.";
            include('../errors/error.php');

        }
        else {
            //$_SESSION["customer_id"] = $customer['customerID'];
            //$customer_id = $_SESSION["customer_id"];
            //start a session with customer_id
            include('product_register.php');
        }
    }

} else if ($action == 'register_product') {
    // ???
    $_SESSION["customer_id"] =filter_input(INPUT_POST, 'customer_id');
    $customer_id = $_SESSION["customer_id"];
    $_SESSION["register"] = filter_input(INPUT_POST, 'products');
    $product_code = $_SESSION["register"];
    if($product_code === NULL || $customer_id === NULL){
        // error
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        add_registration($customer_id, $product_code);
        //success message
        $success ="Product ({$product_code}) was registered successfully";
        include('../errors/success.php');
    }    
    

} elseif ($action == 'log_out') {
    // end session
    session_unset();    // remove all session variables
    session_destroy();  //cleanup the session ID
    include('customer_login.php');
}
?>