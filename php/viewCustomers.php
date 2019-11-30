<?php

include("includes.php"); // Contain all necessary include files 

if (isset($_GET['show'])) {
	
    echo "No Results";
    $query="SELECT * FROM CUSTOMERS";
    
} elseif (isset($_SESSION['cust_id'])) {

    $cust_id =  $_SESSION['cust_id'];
    if ($_SESSION['form_action']== 'insert') {
        
        $msg = "New Customer Shown Below: ";
    
    } elseif ($_SESSION['form_action']== 'update') {
    
        $msg = "The Customer Below was Updated successfully: ";
    }
    $query="SELECT * FROM CUSTOMERS WHERE cust_id =".$cust_id;

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
            
	    <div class="msg"> <p><?php echo $msg; ?></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Name</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Phone</strong></th>
                        <th><strong>Address</strong></th>
                        <th><strong>Gender</strong></th>
                        <th><strong>Date of Birth</strong></th>
                        <th><strong>Edit</strong></th>
                    </tr>
                </thead>
            <tbody>
                <?php

                  //echo $query;
                  $form_action = "edit";
                  $result = mysqli_query($con, $query);
                  while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
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
                                <a href="editCustomer.php?cust_id=<?php echo $row['cust_id']; ?>">Edit</a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    
                   
            <br />
        </div>
    </body>
</html>
