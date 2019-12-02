<?php

include("includes.php"); // Contain all necessary include files 

if (isset($_GET['show'])) {
	

    $query="SELECT * FROM CATEGORY";
    
} elseif (isset($_SESSION['category_id'])) {

    $category_id =  $_SESSION['category_id'];
    if ($_SESSION['form_action']== 'insert') {
        
        $msg = "New Category Shown Below: ";
    
    } elseif ($_SESSION['form_action']== 'update') {
    
        $msg = "The Catergory Below was Updated successfully: ";
    }
    $query="SELECT * FROM CATEGORY WHERE category_id =".$category_id.";";

} 

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>
            List Categories
        </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>

    <body>
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
        <div class="form">

            <h1> List Categories </h1>
            
            <div class="msg"> <p><?php echo $msg; ?></p> </div>

            <table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th><strong>Name</strong></th>
                        <th><strong>Lower Age Limit</strong></th>
                        <th><strong>Upper Age Limit</strong></th>
                        <th><strong>Gender</strong></th>
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
                                <?php echo $row["category_name"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["lower_age"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["upper_age"]; ?>
                            </td>
                            <td align="center">
                                <?php echo $row["gender"]; ?>
                            </td>
                            <td align="center">
                                <a href="editCategory.php?category_id=<?php echo $row["category_id"]; ?>">Edit</a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    
                   
            <br />
        </div>
    </body>
</html>
