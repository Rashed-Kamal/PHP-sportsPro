<?php include '../view/header.php'; ?>
<main>

    <!-- display a table of customer information -->
    <h2>View/Update Customer</h2>
    <form action="." method="post" id="aligned">
        <!--  ??? -->
        
        
       

        <input type="hidden" name="customer_id"
                value="<?php echo htmlspecialchars($customer['customerID']); ?>"><br>        

        <label>First Name:</label>        
        <input type="text" name="first_name"
                value="<?php echo htmlspecialchars($customer['firstName']); ?>"><label class="label2"><p class="error"> <?php echo $errors['first_name']?></p></label><br>

        <label>Last Name:</label>
        <input type="text" name="last_name"
                value="<?php echo htmlspecialchars($customer['lastName']); ?>"><label><p class="error"><?php echo $errors['last_name']?></p></label><br>

        <label>Address</label>
        <input type="text" name="address"
                value="<?php echo htmlspecialchars($customer['address']); ?>"><label><p class="error"><?php echo $errors['address']?></p></label><br>

        <label>City:</label>
        <input type="text" name="city"
                value="<?php echo htmlspecialchars($customer['city']); ?>"><label class="error"><?php echo $errors['city']?></label><br>

        <label>State:</label>
        <input type="text" name="state"
                value="<?php echo htmlspecialchars($customer['state']); ?>"><label class="error"><?php echo $errors['state']?></label><br>

        <label>Postal Code:</label>
        <input type="text" name="post_code"
                value="<?php echo htmlspecialchars($customer['postalCode']); ?>"><label class="error"><?php echo $errors['postal_code']?></label><br>

        <label>Country:</label>
        <select name="country_name">
                <?php foreach($countries as $country): ?>
                <option value="<?php echo htmlspecialchars($country['countryCode']);?>"
                <?php if(isset($customer['countryCode'])) echo "selected";
                        else if($country['countryCode'] == 'US') echo "selected" ;
                ?> >
                    <?php echo htmlspecialchars($country['countryName']); ?>                
                </option>
               
                <?php endforeach; ?>
            </select> <br>


      <!---  <input type="text" name="country_name"
                value="<?php echo htmlspecialchars($customer['countryCode']); ?>"><br>
                        --->
        <label>Phone</label>
        <input type="text" name="phone"
                value="<?php echo htmlspecialchars($customer['phone']); ?>"><label class="error"><?php echo $errors['phone']?></label><br>

        <label>Email:</label>
        <input type="text" name="email"
                value="<?php echo htmlspecialchars($customer['email']); ?>"><label class="error"><?php echo $errors['email']?></label><br>

        <label>Password:</label>
        <input type="text" name="password"
                value="<?php echo htmlspecialchars($customer['password']); ?>"><label class="error"><?php echo $errors['password']?></label><br>

        <label>&nbsp;</label>
        <input type="hidden" name="action" value="update_customer">
        <input type="submit" value="<?php if ($customer['customerID']) echo "Update Customer"; else echo "Add Customer"; ?>" ><br>
      
    </form>
    <p><a href=".">Search Customers</a></p>
    
</main>
<?php include '../view/footer.php'; ?>