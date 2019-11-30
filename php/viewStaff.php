<?php

include("includes.php"); // Contain all necessary include files 

if (isset($_GET['show'])) {
	
    $query="SELECT * FROM STAFF WHERE store_id=".$_SESSION['store_id'];
    
} elseif (isset($_SESSION['staff_id'])) {

    $staff_id =  $_SESSION['staff_id'];
    if ($_SESSION['form_action']== 'insert') {
        
        $msg = "New Staff Shown Below: ";
    
    } elseif ($_SESSION['form_action']== 'update') {
    
        $msg = "The Staff Below was Updated successfully: ";
    }
    $query="SELECT * FROM STAFF WHERE staff_id =".$staff_id.";";
    
} 

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List Staff
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

            <h1> List Staff </h1>
            
	    <div class="msg"> <p><?php echo $msg; ?></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Name</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Phone</strong></th>
                        <th><strong>SSN</strong></th>
                        <th><strong>Date of Joining</strong></th>
                        <th><strong>Salary</strong></th>
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
                                <?php echo $row["ssn"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["date_of_joining"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["salary"]; ?>
                            </td>
                            <td align="center">
                                <a href="editStaff.php?staff_id=<?php echo $row['staff_id']; ?>">Edit</a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    
                   
            <br />
        </div>
    </body>
</html>
