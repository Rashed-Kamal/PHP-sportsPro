<?php
function add_registration($customer_id, $product_code) {
    // ???
    global $db;
    $query = 'INSERT INTO registrations
                 (customerID, productCode, registrationDate)
              VALUES
                 (:customer_id, :product_code, :registration_date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':registration_date', time());
    $statement->execute();
    $statement->closeCursor();
}
?>