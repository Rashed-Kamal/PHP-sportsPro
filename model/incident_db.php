<?php
function add_incident($customer_id, $product_code,$open_date, $title, $comment) {
    // ???
    global $db;
    $query = 'INSERT INTO incidents
                (customerID, productCode, dateOpened, title, description)
            VALUES
                (:customer_id, :product_code, :open_date, :title, :comment)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':open_date', $open_date);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':comment', $comment);
    $statement->execute();
    $statement->closeCursor();
}

/*

// it is here for future reference
function get_products_by_customer($email) { 
    global $db;
    $query = 'SELECT products.productCode, products.name 
              FROM products
                INNER JOIN registrations ON products.productCode = registrations.productCode
                INNER JOIN customers ON registrations.customerID = customers.customerID
              WHERE customers.email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

// it is here for future reference
function update_product($code, $name, $version, $release_date) {  
    global $db;
    $query = 'UPDATE products
              SET name = :name,
                  version = :version,
                  releaseDate = :release_date
              WHERE productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->bindValue(':product_code', $code);
    $statement->execute();
    $statement->closeCursor();
}

*/
?>