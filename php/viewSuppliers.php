<?php

include("includes.php"); // Contain all necessary include files 

if (isset($_GET['show'])) {

    $query="SELECT * FROM SUPPLIER";
    
} elseif (isset($_SESSION['the_supplier_id'])) {

    $the_supplier_id =  $_SESSION['the_supplier_id'];
    if ($_SESSION['form_action']== 'insert') {
        
        $msg = "The Supplier Shown Below Was Successfully Added: ";
    
    } elseif ($_SESSION['form_action']== 'update') {
    
        $msg = "The Supplier Shown Below was Updated successfully: ";
    }
    $query="SELECT * FROM SUPPLIER WHERE supplier_id =".$the_supplier_id.";";

} 

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List Suppliers
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
        <div class="form">
            <h1> List Suppliers </h1>
            
	        <div class="msg"> <p><?php echo $msg; ?></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Supplier Name</strong></th>
                        <th><strong>Address</strong></th>
                        <th><strong>Phone Number</strong></th>
                        <th><strong>Email Address</strong></th>
                        <th><strong>Edit</strong></th>
                    </tr>
                </thead>
            <tbody>
                <?php
                  $form_action = "edit";
                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td align="center">
                                <?php echo $row["supplier_name"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["address"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["phone_number"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["email_address"]; ?>
                            </td>
                            <td align="center">
                                <a href="editSupplier.php?the_supplier_id=<?php echo $row["supplier_id"]; ?>">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br />
        </div>
    </body>
</html>
