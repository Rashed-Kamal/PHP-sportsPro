<?php
session_start();
include '../view/header.php'; ?>
<main>

    <h2>Register Product</h2>
    <?php if (isset($message)) : ?>
        <!--  ??? -->
        <p><?php echo $message; ?></p>
    <?php else: ?>
        <form action="." method="post" id="aligned">
           <!--  ??? -->
           <label>Customer:</label>        
           <label><?php echo htmlspecialchars($customer['firstName']); ?></label><br>
           <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer['customerID']); ?>">

            <label>Product:</label>        
            <select name="products">
                <?php foreach($products as $product): ?>
                <option value="<?php echo htmlspecialchars($product['productCode']); ?>">
                    <?php echo htmlspecialchars($product['name']); ?>                
                </option>
               
                <?php endforeach; ?>
            </select> <br>

            <label>&nbsp;</label>
            <!--- <input type="hidden" name="product_code" value="<?php echo htmlspecialchars($product['name']); ?>"> --->
            
            <input type="hidden" name="action" value="register_product">
            <input type="submit" value="Register Product">


        </form>
    <?php endif; 
         
         if (isset($_SESSION['mail'])){ 
         echo "<p>You are logged in as: <span>". $_SESSION['mail']."</span></p>";
         }         
    ?>
    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="log_out">
        <input type="submit" value="Logout">
    </form>
</main>
<?php include '../view/footer.php'; ?>