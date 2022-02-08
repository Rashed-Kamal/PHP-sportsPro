<?php
require_once('../model/database.php');

// Get IDs
$technician_id = filter_input(INPUT_POST, 'technician_id', FILTER_VALIDATE_INT);
//$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($technician_id != false ) {
    $query = 'DELETE FROM technicians
              WHERE techID = :tech_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':tech_id', $technician_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('index.php');