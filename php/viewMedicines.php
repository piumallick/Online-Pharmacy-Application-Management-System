<?php

include("includes.php"); // Contain all necessary include files 

if (isset($_GET['show'])) {
	
    $query="SELECT * FROM MEDICINE";
    
} elseif (isset($_SESSION['medicine_id'])) {

    $medicine_id =  $_SESSION['medicine_id'];
    if ($_SESSION['form_action']== 'insert') {
        
        $msg = "New Medicine Shown Below: ";
    
    } elseif ($_SESSION['form_action']== 'update') {
    
        $msg = "The Medicine Below was Updated successfully: ";
    }
    $query="SELECT * FROM MEDICINE WHERE medicine_id =".$medicine_id.";";

} 

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List Medicines
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

            <h1> List Medicines </h1>
            
	    <div class="msg"> <p><?php echo $msg; ?></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Medicine Name</strong></th>
                        <th><strong>Description</strong></th>
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
                                <?php echo $row["medicine_name"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["medicine_desc"]; ?>
                            </td>
                            <td align="center">
                                <a href="editMedicine.php?medicine_id=<?php echo $row["medicine_id"]; ?>">Edit</a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    
                   
            <br />
        </div>
    </body>
</html>
