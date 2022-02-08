<?php
require('../model/database_oo.php');
require('../model/technician_db_oo.php');
require('../model/technician.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if($action === NULL){
        $action = 'list_technicians';
    }
    
}

if ($action == 'list_technicians') {
    // ???
    // get technician data
    try{
        $technicians = TechnicianDB::getTechnicians();
    }catch (Throwable $e){
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }catch (Error $e){
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
    include('technician_list.php');
} else if ($action == 'delete_technician') {
    // ???
    $tecnician_id=filter_input(INPUT_POST, 'technician_id');
    
    try{
        $technicians= TechnicianDB::deleteTechnician($technician_id);
    }catch (Throwable $e){
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }catch (Error $e){
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
    header("location: .");
} else if ($action == 'show_add_form') {
    // ???
    include('technician_add.php');
} else if ($action == 'add_technician') {
    // Validate the inputs
    //$tecnician_id =filter_input(INPUT_POST, 'techID');
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $password = filter_input(INPUT_POST, 'password');

    // Validate the inputs [date Format]
    if ( $first_name === FALSE || $last_name === FALSE ||
            $email === NULL || $phone === NULL || 
            $password === NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    }
     else {        
        try{
            TechnicianDB::addTechnician($first_name,$last_name, $email, $phone, $password);
        }catch (Throwable $e){
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }catch (Error $e){
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }        
        header("Location: .");
    }
}
?>