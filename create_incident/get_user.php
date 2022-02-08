<?php 
session_start();
include '../view/header.php'; ?>
<main>

    <h2>Get Customer</h2>
    <p>You must enter the customer's email address to select the customer.</p>
    <!-- display a search form -->
    <form action="." method="POST">
        <!--  ??? -->
        <label>Email:</label>
        <input type="hidden" name="action" value="get_user">
        <input type="text" name="email">
        <input type="submit" value="Get Customer">
    </form>

</main>
<?php include '../view/footer.php'; ?>