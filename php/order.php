<?php

include("includes.php"); // Contain all necessary include files 

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            Order details
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <?php
    $fetch_order = "select * from orders where cust_id=".$_SESSION['cust_id'];

echo $insert_stock

if (mysqli_query($con, $insert_stock)) {

    $stock_id = mysqli_insert_id($con);
    
    if ($medicine1 != "") {
        
        $insert_has_stock_supply1 = "INSERT INTO HAS_STOCK_SUPPLY(stock_id, supplier_id, unit_cost_price, medicine_id,manufacture_date, expiry_date, quantity, total_cost) VALUES(".$stock_id.", ".$supplier.", ".$unit_cost_price1.", ".$medicine_id1.", ".$manufacture_date1.", ".$expiry_date1.", ".$quantity1.", ".$total_cost1.")";
        
        mysqli_query($con, $insert_has_stock_supply1);








    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

                <div>

                    <h1> (cust_name ) order history</h1>
                    <!-- INSERT YOUR HTML CODE AFTER THIS LINE -->
                    <?php
                    
                    <?php
                    
		    $query="SELECT * FROM CUSTOMERS WHERE cust_id =".$new_customer.";";
		   
		    //echo $query;
		    $result = mysqli_query($con, $query);
		    while($row = mysqli_fetch_assoc($result)) { ?>
                    
		    <tr>
                        <td align="center">
                            <?php echo $row["cust_id"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["first_name"]." ".$row["last_name"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["email_address"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["phone_number"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["address"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["gender"]; ?>
                        </td>
                        <td align="center">
                            <?php echo $row["dob"]; ?>
                        </td>
			<td align="center">
			    <a href="customer.php?id=<?php echo $row["cust_id"]; ?>">Edit</a></td>
                        <td align="center"><a href="delete.php?id=<?php echo $row["cust_id"]; ?>">Delete</a></td>
                   
                    //echo $query;
                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_assoc($result)) { ?>
                            
                    <tr>
                                <td align="center">
                                    <?php echo $row["cust_id"]; ?>
                                </td>
                                <td align="center">
                                    <?php echo $row["first_name"]." ".$row["last_name"]; ?>
                                </td>
                                <td align="center">
                                    <?php echo $row["email_address"]; ?>
                                </td>
                                <td align="center">
                                    <?php echo $row["phone_number"]; ?>
                                </td>
                                <td align="center">
                                    <?php echo $row["address"]; ?>
                                </td>
                                <td align="center">
                                    <?php echo $row["gender"]; ?>
                                </td>
                                <td align="center">
                                    <?php echo $row["dob"]; ?>
                                </td>
                    <td align="center">
                        <a href="customer.php?id=<?php echo $row["cust_id"]; ?>">Edit</a></td>
                                <td align="center"><a href="delete.php?id=<?php echo $row["cust_id"]; ?>">Delete</a></td>

                    <br />
                    <br />
                    <br />
                    <br />
                </div>
        </div>
    </body>
</html>
