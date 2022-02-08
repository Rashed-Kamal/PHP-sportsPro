<?php
session_start();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>SportsPro Technical Support</title>
    <link rel="stylesheet" type="text/css"
          href="/tech_support/main.css">
</head>

<!-- the body section -->
<body>
<header>
    <h1>SportsPro Technical Support</h1>
    <p>Sports management software for the sports enthusiast</p>
    <nav>
        <ul>
            <li><a href="/tech_support/">Home</a></li>
        </ul>
    </nav>

    <?php
    //if (isset($_SESSION['mail'])){ 
    //echo "<p>You are logged in as: <span>". $_SESSION['mail']."</span></p>";   
    //}    
    ?>

</header>
