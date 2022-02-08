<?php 
session_start();
include '../view/header.php'; ?>
<main>

    <h2>Customer Login</h2>
    <p>You must login before you can register a product.</p>
    <!-- display a search form -->
    <form action="." method="post">
        <!--  ??? -->
        <label>Email:</label>
        <input type="hidden" name="action" value="get_customer">
        <input type="text" name="email">
        <input type="submit" value="login">
    </form>

</main>
<?php include '../view/footer.php'; ?>