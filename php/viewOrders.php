<?php

include "includes.php"; // Contain all necessary include files

if ($_SESSION['role'] == "S" || $_SESSION['role'] == "M") {
    $query="SELECT order_id ,order_date ,store.store_name ,customer.first_name ,customer.last_name ,(SELECT sum(`total_amt`) FROM `order_items` WHERE order_id=orders.order_id) AS order_total FROM `orders` orders ,`customers` customer ,`store` store ,`staff` staff where customer.cust_id = orders.cust_id and store.store_id = orders.store_id and staff.store_id=orders.store_id and staff.staff_id = ".$_SESSION["user_id"]." ORDER BY order_date DESC;"; 
}
else {
    $query="SELECT order_id ,order_date ,store.store_name ,customer.first_name ,customer.last_name ,(SELECT sum(`total_amt`) FROM `order_items` WHERE order_id=orders.order_id) AS order_total FROM `orders` orders ,`customers` customer ,`store` store where customer.cust_id = orders.cust_id and store.store_id = orders.store_id and orders.cust_id =".$_SESSION["user_id"]." ORDER BY order_date DESC;";
}

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Your Order History
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
        <div class="form">
            <?php if ($_SESSION['role'] == "S" || $_SESSION['role'] == "M") { ?>
                        <h1>  Store Sales Order History </h1>
            <?php } else { ?>
                        <h1>  Customer Order History </h1>
            <?php } ?>
            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Customer Name</strong></th>
                        <th><strong>Order ID</strong></th>
                        <th><strong>Order Date</strong></th>
                        <th><strong>Store Name</strong></th>
                        <th><strong>Total Amount</strong></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        // Define the query

                        // Now execute the query
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tr>
                        <td align="center">
                            <?php echo $row["first_name"];?> <?php echo $row["last_name"]; ?>
                        </td>
                        <td align="center">
                            <a href="viewOrderDetail.php?orderid=<?php echo $row["order_id"]; ?>">Order Id - <?php echo $row["order_id"]; ?></a>
                        </td>                                
                        <td align="center">
                            <?php echo $row["order_date"];?> 
                        </td>
                        <td align="center">
                            <?php echo $row["store_name"];?> 
                        </td>
                        <td align="center">
                            <?php echo "$".number_format($row["order_total"], 2, '.', ','); ?> 
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
