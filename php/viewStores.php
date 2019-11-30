<?php

include("includes.php"); // Contain all necessary include files 

if (isset($_GET['show'])) {

    $query="SELECT * FROM STORE";
    
} elseif (isset($_SESSION['the_store_id'])) {

    $the_store_id =  $_SESSION['the_store_id'];
    if ($_SESSION['form_action']== 'insert') {
        
        $msg = "New Store Shown Below: ";
    
    } elseif ($_SESSION['form_action']== 'update') {
    
        $msg = "The Store Below was Updated successfully: ";
    }
    $query="SELECT * FROM STORE WHERE store_id =".$the_store_id.";";

} 

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List Stores
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>

        <div class="form">

            <?php include("nav_menu.php"); ?>

            <h1> List Stores </h1>
            
	    <div class="msg"> <p><?php echo $msg; ?></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Store Name</strong></th>
                        <th><strong>Store Location</strong></th>
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
                                <?php echo $row["store_name"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["store_address"]; ?>
                            </td>
                            <td align="center">
                                <a href="editStore.php?the_store_id=<?php echo $row["store_id"]; ?>">Edit</a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    
                   
            <br />
        </div>
    </body>
</html>
