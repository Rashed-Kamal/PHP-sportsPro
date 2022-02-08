<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/registration_db.php');
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    // ???
    $action = filter_input(INPUT_GET, 'action');
        if($action === NULL){
        $action = 'incident_report';
        }
    }


//instantiate variable(s)
$email = '';

if ($action == 'incident_report') {
    // ???
    
    include("get_user.php");

} else if ($action == 'get_user') {
    // ???
           //start session
           $lifetime= 60 * 60 * 24 *14;
           session_set_cookie_params($lifetime, '/');
           session_start();   
   
      
    if(!isset($_SESSION['email'])) {

    $_SESSION['mail'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    }
    $email = $_SESSION['mail'];
  

    if($email === false){
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
           
    }    
    else {       

        $customer = get_customer_by_email($email);
 

        if(!isset($_SESSION['products'])){
            $_SESSION['products'] = array();
        }

        $_SESSION ["products"] = get_products_by_customer($email);
        $products = $_SESSION ["products"];

        if($customer === false){
            $error = "Invalid customer info. Check all fields and try again.";
            include('../errors/error.php');
        } else if (empty($products)) {
            $error = "There is no product rgistered for this user. Please check all fields and try again.";
            include('../errors/error.php');

        }
        else {
          
            include('create_incident.php');
          
        }
    }

} else if ($action == 'create_incident') {
  
    // ???
    $_SESSION["customer_id"] =filter_input(INPUT_POST, 'customer_id');
    $customer_id = $_SESSION["customer_id"];
    $_SESSION["register"] = filter_input(INPUT_POST, 'products');
    $product_code = $_SESSION["register"];

    $_SESSION["title"] =filter_input(INPUT_POST, 'title');
    $title = $_SESSION["title"];

    $_SESSION["comment"] =filter_input(INPUT_POST, 'comment');
    $comment = $_SESSION["comment"];

    $open_date = date('Y-m-d H:i:s');


    if($product_code === NULL || $customer_id === NULL || $title === NULL || $comment === NULL) {
        // error
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        add_incident($customer_id, $product_code, $open_date, $title, $comment);
        $message ="This incident [for product {$product_code}] added to our database";
        include('create_incident.php');
        // end session
        //session_unset();    // remove all session variables
        //session_destroy();  //cleanup the session ID
        
    }    // end session
    

}
session_unset();    // remove all session variables
session_destroy();  //cleanup the session ID

?>