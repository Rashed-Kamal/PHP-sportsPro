<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/countries_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    // ???
    $action = filter_input(INPUT_GET, 'action');
    if($action === NULL){
        $action = 'search_customers';
    }
    
}

//instantiate variable(s)
$last_name = '';
$customers = array();


switch($action){
case 'search_customers':  
    return include('customer_search.php');
case 'add_customer':
    $countries = get_countries();
    return include('customer_display.php');
 
case 'display_customers':
    // ???
    $last_name = filter_input(INPUT_POST, 'last_name');
    if (empty($last_name)) {
        $message = 'You must enter a last name.';
    } else {
        $customers = get_customers_by_last_name($last_name);
        if(empty($customers)){
            $message = 'No customer with this name. Please try again!';
        }
    }
    include('customer_search.php');
    break;

case 'display_customer':
    // ???
    $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);          
    $customer = get_customer($customer_id);
    $countries = get_countries();
    include('customer_display.php');  
    break;

case 'update_customer':

    $errors = array('first_name'=>'','last_name'=>'','address'=>'','city'=>'',
                    'state'=>'','postal_code'=>'','phone'=>'','email'=>'','password'=>'');
  
   $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);

   $first_name = filter_input(INPUT_POST, 'first_name');   
   $last_name = filter_input(INPUT_POST, 'last_name');   
   $address = filter_input(INPUT_POST, 'address');   
   $city = filter_input(INPUT_POST, 'city');
   $state = filter_input(INPUT_POST, 'state');
   $postal_code = filter_input(INPUT_POST, 'post_code');   
   $country_code = filter_input(INPUT_POST, 'country_name');
   $phone = filter_input(INPUT_POST, 'phone');
   $email = filter_input(INPUT_POST, 'email');   
   $password = filter_input(INPUT_POST, 'password');

   $name_pattern='/^[\D\. -]{1,51}$/'; 
   if(empty($first_name)){
    $errors['first_name'] ="Required";
   }elseif(!preg_match($name_pattern,$first_name)){
   $errors['first_name']= "please enter valid name";    
   }else {
       $customer['firstName']=$first_name;
   }

   if(empty($last_name)){
    $errors['last_name'] ="Required";
   }elseif(!preg_match($name_pattern,$last_name)){
   $errors['last_name']= "please enter valid name";    
   }else {
    $customer['lastName']=$last_name;
   }

    $address_pattern = '/^[a-zA-Z0-9 ]{1,51}$/';
    if(empty($address)){
         $errors['address'] ="Required";
   }elseif(!preg_match($address_pattern,$address)){
   $errors['address']= "please enter valid address";    
   }else {
    $customer['address']=$address;
    }
   
   $city_pattern = '/^[A-Z][a-z]{0,51}/';
   if(empty($city)){
    $errors['city'] ="Required";
   }elseif(!preg_match($city_pattern,$city)){
   $errors['city']= "please enter valid city name";    
   }else {
    $customer['city']=$city;
   }

   
   if(empty($state)){
    $errors['state'] ="Required";
   }elseif(!preg_match($city_pattern,$state)){
   $errors['state']= "please enter valid state name";    
   }else {
    $customer['state']=$state;
   }

   $pcode_pattern = '/^[0-9]{1,21}/';
   if(empty($postal_code)){
    $errors['postal_code'] ="Required";
   }elseif(!preg_match($pcode_pattern,$postal_code)){
   $errors['postal_code']= "please enter valid postal code";    
   }else {
    $customer['postalCode']=$postal_code;
   }

   $phone_pattern = '/^\(\d{3}\) ?\d{3}-\d{4}$/';
   if(empty($phone)){
    $errors['phone'] ="Required";
   }elseif(!preg_match($phone_pattern,$phone)){
    $errors['phone']= "Use (999) 999-9999 format";    
   }else {
    $customer['phone']=$phone;
   }

   //$valid_email = valid_email($email);
   if(empty($email)){
    $errors['email'] ="Required";
   }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email']= "Please enter a valid email address";    
   }else {
    $customer['email']=$email;
   }

   $pw_pattern = '/[[:print:]]{6,21}/';
   if(empty($password)){
    $errors['password'] ="Required";
   }elseif(!preg_match($pw_pattern,$password)){
    $errors['password']= "password between 6 to 21 chars";    
   }else {
    $customer['password']=$password;
   }

   if($customer_id != false){
       $customer['customerID']=$customer_id;
       
   }

  
    //$countries = get_countries();
    //include('customer_display.php');

   //if(isset($customer['firstName']) && isset($customer['lastName']) &&
     //    isset($customer['address']) && isset($customer['city']) &&
       // isset($customer['state']) && isset($customer['postalCode']) &&
        //isset($customer['phone']) && isset($customer['email']) && isset($customer['password'])){
       
            if(array_filter($errors)){
                $countries = get_countries();
                include('customer_display.php');
            } else {
    
            //include('customer_display.php');       
            if ($customer_id == false) {
                
                 add_customer($first_name, $last_name, 
                     $address, $city, $state, $postal_code, $country_code,
                     $phone, $email, $password);
                    // include('customer_search.php');
                    header('Location: .');
                
            }else {
            
                update_customer($customer_id, $first_name, $last_name,
                $address, $city, $state, $postal_code,
                $country_code, $phone, $email, $password);
                //include('customer_search.php');
                header('Location: .');
                
            }
          //  return include('customer_search.php');     
        }      

   break;
}

?>