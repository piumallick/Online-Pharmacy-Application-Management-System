<?php

include("includes.php"); // Contain all necessary include files 
$orderid = intval($_GET['orderid']);
$orderTotal=0;
if ($_SESSION['role'] == "S" || $_SESSION['role'] == "M") {
    $query="select orders.order_id ,medicine.medicine_name ,orders.order_date ,order_items.stock_id, order_items.unit_selling_price ,order_items.quantity ,order_items.total_amt FROM orders, medicine, order_items WHERE order_items.order_id=orders.order_id and medicine.medicine_id=order_items.medicine_id and orders.order_id= ".$orderid.";";
}
else {
    $query="select orders.order_id ,medicine.medicine_name ,orders.order_date ,order_items.unit_selling_price ,order_items.quantity ,order_items.total_amt FROM orders, medicine, order_items WHERE order_items.order_id=orders.order_id and medicine.medicine_id=order_items.medicine_id and orders.order_id =".$orderid.";";
}

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            View Order Details
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

                <div>

                    <h1> View Order Details - <?php echo $orderid ?></h1>

                    <!-- INSERT YOUR HTML CODE AFTER THIS LINE -->
                    <div>
                    <table>
                        <thead>
                            <tr>
                                <th><strong>Order ID</strong></th>
                                <th><strong>Medicine Name</strong></th>
                                <th><strong>Order Date</strong></th>
                                <?php if ($_SESSION['role'] == "S" || $_SESSION['role'] == "M") { ?>
                                    <th><strong>Stock Id</strong></th>
                                <?php } ?>
                                <th><strong>Unit Price</strong></th>
                                <th><strong>Quantity</strong></th>                           
                                <th><strong>Total Amount</strong></th>
                            </tr>
                        </thead>
    
                        <tbody>
                            <?php
                                // Now execute the query
                                $result = mysqli_query($con, $query);
                                while($row = mysqli_fetch_assoc($result)) { 
                            ?>

                            <tr>
                                <td align="center">
                                    <?php echo $row["order_id"];?> 
                                </td>
                                                            
                                <td align="center">
                                    <?php echo $row["medicine_name"];?> 
                                </td>
                                <td align="center">
                                    <?php echo $row["order_date"];?> 
                                </td>
                                <?php if ($_SESSION['role'] == "S" || $_SESSION['role'] == "M") { ?>
                                    <td align="center">
                                        <?php echo $row["stock_id"];?> 
                                    </td>
                                <?php } ?>
                                <td align="center">
                                    <?php echo $row["unit_selling_price"];?> 
                                </td>
                                <td align="center">
                                    <?php echo $row["quantity"];?> 
                                </td>
                                <td align="center">
                                    <?php echo $row["total_amt"];?> 
                                </td>
                            </tr>
                            <?php $orderTotal = $orderTotal + $row["total_amt"]; } ?>
                            <tr>
                                <td colspan="5" align="right">
                                    <strong> Grand Total:    </strong>                       
                                </td>
                                <td>
                                    <strong> <?php echo $orderTotal ?> </strong>  
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    <!-- INSERT YOUR HTML CODE BEFORE THIS LINE -->

                    <br />
                    <br />
                    <br />
                    <br />
                </div>
        </div>
    </body>
</html>
