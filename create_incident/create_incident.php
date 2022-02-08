<?php
session_start();
include '../view/header.php'; ?>
<main>

    <h2>Create Incident</h2>
    <?php if (isset($message)) : ?>
        <!--  ??? -->
        <p><?php echo $message; ?></p>
    <?php else: ?>
        <form action="." method="POST" id="aligned">
           <!--  ??? -->
           <label>Customer:</label>        
           <label><?php echo htmlspecialchars($customer['firstName']). " "; echo htmlspecialchars($customer['lastName']); ?></label><br>
           <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer['customerID']); ?>">

            <label>Product:</label>        
            <select name="products">
                <?php foreach($products as $product): ?>
                <option value="<?php echo htmlspecialchars($product['productCode']); ?>">
                    <?php echo htmlspecialchars($product['name']); ?>                
                </option>
               
                <?php endforeach; ?>
            </select> <br>

            <label>Title:</label>
            <input type="text" name="title" value=""> <br>

            <label>Description:</label>
            <textarea form="aligned" name="comment" rows="4" cols="50" placeholer=" description of the incident."></textarea> <br>
                   
            <label>&nbsp;</label>
           
            
            <input type="hidden" name="action" value="create_incident">
            <input type="submit" value="Create Incident">


        </form>
    <?php endif; ?>
</main>
<?php include '../view/footer.php'; ?>