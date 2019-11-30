<?php

include("includes.php"); // Contain all necessary include files 

// If cart if not empty display the items
if(isset($_SESSION['cart'])) {
    //display cart $_SESSION['cart'] = array();
} else {
    $message = "Your cart if empty";
}

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            View / Edit Cart
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

                <div>

                    <h1> View or Edit Cart </h1>

                    <!-- INSERT YOUR HTML CODE AFTER THIS LINE -->
                    <?php
                        // If cart if not empty display the items
                        if(isset($_SESSION['cart'])) {
                            //display cart $_SESSION['cart'] = array();
                        } else {
                            echo "<h1>Your cart is empty!</h1>";
                        }
                    ?>
                    <!-- INSERT YOUR HTML CODE BEFORE THIS LINE -->

                    <br />
                    <br />
                    <br />
                    <br />
                </div>
        </div>
    </body>
</html>
