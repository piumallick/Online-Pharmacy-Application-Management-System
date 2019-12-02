<?php

include("includes.php"); // Contain all necessary include files 
$cartMessage = "Your cart is empty";

// We always should have an empty cart
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
} else {
    $cartMessage = "Your cart is empty";
}

// Code to handle cart add button action
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        
        /* [INVALID REQUEST] */
        default:
            echo "INVALID REQUEST";
            break;

        /* [Submit Cart] */
        case "submit":
            // First insert into orders table
            $insert_orders = "INSERT INTO `orders`(`total_amt`, `order_date`, `cust_id`, `store_id`) VALUES(".$_SESSION['cart-ordertotal'].", SYSDATE(), ".$_SESSION['user_id'].", ".$_SESSION['cart-storeid'].")";
            mysqli_query($con, $insert_orders);
            $order_id = $con->insert_id;

            foreach($_SESSION['cart'] as $medicineId => $quantity) {
                // First get the cost per item
                $query = $query="SELECT `has_store_stock`.`availability_of_medicine`, `has_store_stock`.`stock_id`, `has_store_stock`.`unit_selling_price`FROM `medicine` , `has_store_stock` where medicine.medicine_id=has_store_stock.medicine_id and `has_store_stock`.`medicine_id` = ".$medicineId." and `has_store_stock`.`store_id` = ".$_SESSION['cart-storeid'].";"; 
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)) { 
                    $lineTotal = $quantity * $row["unit_selling_price"];

                    // Now insert into order_items table
                    $insert_order_items = "INSERT INTO `order_items`(`order_id`, `medicine_id`, `stock_id`, `unit_selling_price`, `quantity`, `total_amt`) VALUES(".$order_id.", ".$medicineId.", ".$row["stock_id"].", ".$row["unit_selling_price"].",".$quantity.",".$lineTotal.")";
                    mysqli_query($con, $insert_order_items);
                    
                    // Calculate remaining inventory
                    $updatedInventory = $row["availability_of_medicine"] - $quantity;

                    // Update has_stock_supply table to reduce inventory
                    $update_has_stock_supply = "UPDATE `has_store_stock` SET `availability_of_medicine` = $updatedInventory WHERE `store_id` = ".$_SESSION['cart-storeid']." and `stock_id` = ".$row["stock_id"]." and `medicine_id` = ".$medicineId."";
                    mysqli_query($con, $update_has_stock_supply);

                    if ($con->query($update_has_stock_supply) === TRUE) {
                        echo "updated successfully: ";
                    } else {
                        echo "Error: " . $update_has_stock_supply . "<br>" . $conn->error;
                    }
                }
            }
            // Redirect to confirmation page
            $cartMessage = "Your order has been successfully received";

            // Initialize cart to empty
            $_SESSION['cart'] = array();

            break;

        /* [Remove item from cart] */
        case "delete":
            $medid = intval($_GET['medid']);
            unset($_SESSION['cart'][$medid]); 
            echo '<script language="javascript">alert("Medicine deleted from cart!")</script>';
            break;

        /* [Empty cart] */
        case "empty":
            // Initialize to an empty cart
            $_SESSION['cart'] = array();
            echo '<script language="javascript">alert("All items from cart have beem removed!")</script>';
            break;
    }
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
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
        <div class="form">
        <div>
                    <h1> View or Edit Cart </h1>

                    <!-- INSERT YOUR HTML CODE AFTER THIS LINE -->
                    <?php
                        // If cart if not empty display the items
                        if(count($_SESSION['cart']) > 0) {
                    ?>
                    <form method="post" action="cart.php">
                        <table width="100%" border="1" style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th><strong>Medicine ID</strong></th>
                                    <th><strong>Medicine Name</strong></th>
                                    <th><strong>Unit Price</strong></th>
                                    <th><strong>Quantity</strong></th>
                                    <th><strong>Total Price</strong></th>
                                    <th><strong>Delete</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $orderTotal = 0;
                                    foreach($_SESSION['cart'] as $medicineId => $quantity) { 
                                        // Now execute the query
                                        $query = $query="SELECT `medicine`.`medicine_name`,`has_store_stock`.`unit_selling_price`FROM `medicine` , `has_store_stock` where medicine.medicine_id=has_store_stock.medicine_id and `has_store_stock`.`medicine_id` = ".$medicineId." and `has_store_stock`.`store_id` = ".$_SESSION['cart-storeid'].";"; 
                                        $result = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_assoc($result)) { 
                                            $lineTotal = $quantity * $row["unit_selling_price"];
                                            $orderTotal = $orderTotal + $lineTotal;
                                ?> 
                                    
                                        <tr>
                                            <td align="center">
                                                <?php echo $medicineId; ?>
                                            </td>
                                            <td align="center">
                                                <?php echo $row["medicine_name"]; ?>
                                            </td>
                                            <td align="center">
                                                <?php echo "$".number_format($row["unit_selling_price"], 2, '.', ','); ?>
                                            </td>
                                            <td align="center">
                                                <?php echo $quantity ?>
                                            </td>
                                            <td align="center">
                                                <?php echo "$".number_format($lineTotal, 2, '.', ','); ?>
                                            </td>
                                            <td align="center">
                                                <a href="cart.php?action=delete&medid=<?php echo $medicineId; ?>">Delete</a>
                                            </td>
                                        </tr>
                                <?php } } ?>
                                <tr>
                                    <td colspan="4" align="right">
                                        <strong> Grand Total:    </strong>                       
                                    </td>
                                    <td align="center">
                                        <strong> <?php echo "$".$orderTotal; $_SESSION['cart-ordertotal'] = $orderTotal ?> </strong>  
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="submit" value="Submit Order" class="btnAddAction" formaction="cart.php?action=submit" />
                        <input type="submit" value="Empty Cart" class="btnAddAction" formaction="cart.php?action=empty" />
                   <?php    
                        } else {
                            echo "<h1>$cartMessage</h1>";
                        }
                    ?>
                    </form>
                    <!-- INSERT YOUR HTML CODE BEFORE THIS LINE -->

                    <br />
                    <br />
                    <br />
                    <br />
                </div>
        </div>
    </body>
</html>
