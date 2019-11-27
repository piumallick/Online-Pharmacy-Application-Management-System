<?php

include("includes.php"); // Contain all necessary include files 

if (isset($_SESSION['new_customer'])) {

    $new_customer =  $_SESSION['new_customer'];
    $msg = "New Customer Shown Below: ";

} else {
	
    echo "No Results";
    die();
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List Customers
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

            <h1> List Customers </h1>
            
	    <div class="msg">  <?php echo $msg; ?> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Customer ID</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Phone</strong></th>
                        <th><strong>Address</strong></th>
                        <th><strong>Gender</strong></th>
                        <th><strong>Date of Birth</strong></th>
                        <th><strong>Edit</strong></th>
                        <th><strong>Delete</strong></th>
                </tr>
            </thead>
            <tbody>
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                    
                    <br />
                    <br />
                    <br />
                    <br />
        </div>
    </body>
</html>
