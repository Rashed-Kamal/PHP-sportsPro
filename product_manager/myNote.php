<?php
// From Lec 5

//[mysql: host=host_address; dbname=database_name]      // Data Source Name
$dsn = 'mysql:host=localhost; dbname=my_guiter_shop1';  // Step 1:create/get the source of the database
$username = 'mgs_user';     // get user name in var $username
$password = 'pas55word';    // get password of the user in var $password 

$db = new PDO ($dsn, $username, $password); // Step 2: create an instance of database
$query = 'SELECT * FROM products
            WHERE categoryID = :category_id';           // Step 3: create query and store it in a variable. Here :category_id is a parameter
$statement = $db -> prepare($query);                    // Step 4: prepare/attach the query($query) to the database instance($db)
$statement->bindValue (':category_id', $category_id);  // Step 5: update statement if there is any parameter
                                                        // otherwise skip this step 
                                                        // [:category_id is parameter name for SQL, $category_id is a value in var]
$statement -> execute();                                // Step 6: Now execute the statement
$product = $statement ->fetch();                        // Step 7: fetch the outcome and store in var $product [ will be stored as array]
$statement->closeCursor();                              // Step 8: close the intermediate $statement that we used to collect data

/* Now maniputale data that we extracted from the database into $product var */
$product_code = $product['productCode'];
$product_name = $product['productName'];
$product_list_price =$product['listPrice'];
// another way to manipulate data using index value, but you need to know the sequence of data
$product_code = $product[0];
$product_name = $product[1];
$product_list_price =$product[2];


/* Note for Step 7:
    when we return a collection of record we use fetchAll() instead of fetch()
    */
    $products = $statement->fetchAll();

    // display list of recods using foreach loop
    foreach($products as $product) {
        echo $product['productCode'];
        echo $product['productName'];
        echo $product['listPrice'];
    }
?>
    // display above list in HTML Table
    <?php foreach($products as $product) { ?>
        <tr>
            <td><?echo $product['productCode'];?></td>
            <td><?echo $product['productName'];?></td>
            <td><?echo $product['listPrice'];?></td>
        </tr>
    <?php } ?>      // you can use endforeach instead of curly braces {}

<?php
    // *** Insert data into database ***

// procedure is same as from Step 1 to Step 8. Example below:

$category_id = 1;
$code = 'strat';
$name = 'Fender stratocaster';
$price =699.99;

$query = "INSERT INTO products
            (categoryID, productCode, productName, ListPrice) 
            VALUES
            (:category_id, :code, :name, :price)";

$statement = $db->prepare($query);
$statement->bindValue (':category_id', $category_id);
$statement->bindValue(':code', $code);
$statement->bindValue(':name', $name);
$statement->bindValue(':price', $price);
$statement->execute();
$statement->closeCursor();


//  *** Update statement

// Example:

$product_id =4;
$price = 599.99;

$query = "UPDATE products
            SET listPrice = :price
            WHERE productID = :product_id";

$statement = $db->prepare($query);
$staement->bindValue(':price', $price);
$statement-> bindValue(':product_id', $product_id);
$statement->execute();
$statement->closeCursor();


// *** Delete statement ***

//Example

$product_id = 4;
$query = "DELETE FROM products
            WHERE productID = :product_id";

$statement = $db->prepare($query);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$statement->closeCursor();

// Lec10

// php is a typeless language

class className {
    private $id, $name;
    private static $objectCount = 0;

    public function__construct($myID, $myName){
        $this->id = $myID;
        $this->name = $myName;
        self::$objectCount++;
    }

    public function getID () {
        return $this->id;
    }
    public function setID($value){
        $this->id = $value;
    }
    public function getName(){
        return this->name;
    }
    public static function getObjectCount() {
        return self::$objectCount;
    }
    public function setName($value){
        $this->name = $value

    }

}
 

?>