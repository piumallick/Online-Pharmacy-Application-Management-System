<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
    
    $medicine_name = $_REQUEST["medicine_name"];
    $medicine_desc = $_REQUEST["medicine_desc"];
    $category_id = $_REQUEST["category_id"];
    
    //echo "Captured Values: ".$category_name.", ".$lower_age.", ".$upper_age.", ".$gender." ";

    // Validation :

    if ($error_msg == "") {
			
        // Put insert code here
        $insert_med = "INSERT INTO MEDICINE (medicine_name, medicine_desc )
                       VALUES ('".$medicine_name."', '".$medicine_desc."');";
        
        //echo "SQL: ".$sql;

        if (mysqli_query($con, $insert_med)) {
            
            $medicine_id = mysqli_insert_id($con);
            
            $insert_cat_med = "INSERT INTO MEDICINE_CATEGORY (category_id, medicine_id)
                               VALUES (".$category_id ", ".$medicine_id.")";

            if (mysqli_query($con, $insert_cat_med) ) {
            
                $_SESSION['medicine_id'] = $medicine_id;
                $_SESSION['form_action'] = $form_action;
                header("Location: viewMedicines.php"); // Redirect user to viewMedicines.php

            } else {

                echo "Error: " . $sql . "" . mysqli_error($con);
            }
            
        } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
        }

    } 
        
} else {
    
    //echo "First time here";
    $form_action = "insert";
    $error_msg = "";
    
}

?>

<!DOCTYPE html>
<html>
    <head>
   
   	<meta charset="utf-8">
	<title>	Enter Medication </title>
	<link rel="stylesheet" href="../css/style.css" />
    
    </head>
    <body>
	 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
        
        <h1> Enter New Medication</h1>
			
            <form name="form" method="post" action=""> 
			
                <div class="error_msg"> <?php echo $error_msg; ?> </div>

                <p><input type="text" name="medicine_name" placeholder="Enter Medicine Name" required /></p>

                <p><input type="text" name="medicine_desc"  placeholder="Enter Description/Purpose" required /></p>
                
                <p>
                 <select class="select" name="category">
                  <option value="">Select Category...</option>
                 <?php $query = "SELECT category_id, category_name FROM CATEGORY";
                       $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                              <option value="<?php echo $row['category_id'] ?>"> <?php echo $row["category_name"]?></option>

                        <?php } ?>
                  </select>
                </p>

                <p><input type="hidden" name="form_action" value="<?php echo $form_action; ?>" required /></p>

                <p><input name="submit" type="submit" value="Submit" /></p>

		    </form>
            
		 </div>

         <br />
         <br />
    </body>
</html>
