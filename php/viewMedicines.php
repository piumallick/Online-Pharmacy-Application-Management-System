<?php

include("includes.php"); // Contain all necessary include files 

if (isset($_GET['show'])) {
	
    $query="SELECT M.medicine_id, M.medicine_name, M.medicine_desc, GROUP_CONCAT(category_name SEPARATOR',<br />') AS catergories 
              FROM MEDICINE AS M, CATEGORY as C, MEDICINE_CATEGORY AS MC 
             WHERE M.medicine_id = MC.medicine_id 
               AND MC.category_id = C.category_id 
          GROUP BY M.medicine_id";
    
    //echo $query;
    
} elseif (isset($_SESSION['medicine_id'])) {

    $medicine_id =  $_SESSION['medicine_id'];
    if ($_SESSION['form_action']== 'insert') {
        
        $msg = "New Medicine Shown Below: ";
    
    } elseif ($_SESSION['form_action']== 'update') {
    
        $msg = "The Medicine Below was Updated successfully: ";
    }
    
    $query="SELECT M.medicine_id, M.medicine_name, M.medicine_desc, GROUP_CONCAT(category_name SEPARATOR',  ') AS catergories 
              FROM MEDICINE AS M, CATEGORY as C, MEDICINE_CATEGORY AS MC 
             WHERE M.medicine_id = MC.medicine_id 
               AND MC.category_id = C.category_id 
               AND M.medicine_id = ".$medicine_id." 
          GROUP BY M.medicine_id";
        
    //echo $query;
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
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
        <div class="form">

            <h1> List Medicines </h1>
            
            <div class="msg"> <p><?php echo $msg; ?></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Medicine Name</strong></th>
                        <th><strong>Description</strong></th>
                        <th><strong>Medication Categories </strong></th>
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
                                <?php echo $row["catergories"]; ?>
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
