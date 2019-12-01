<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {


    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
       
    $medicine_id = $_REQUEST["medicine_id"];
    $medicine_name = $_REQUEST["medicine_name"];
    $medicine_desc = $_REQUEST["medicine_desc"];
    $category_ids= $_REQUEST["categories"];
    
/*
    echo "Captured Values: ".$medicine_id.", ".$medicine_name.", ".$medicine_desc." ";
    foreach ($category_ids as $category) 
        echo $category; 
*/
    
    if  ($form_action == "update") {

        $update = "UPDATE MEDICINE SET medicine_name='".$medicine_name."', 
                                       medicine_desc='".$medicine_desc."'      
                                       WHERE medicine_id=".$medicine_id;
            
     }
	    //echo "SQL: ".$update;
        
    if (mysqli_query($con, $update)) {

        //Delete existing 
        $del_exist_med_cat = "DELETE FROM MEDICINE_CATEGORY WHERE medicine_id=".$medicine_id;
        //echo $del_exist_med_cat; 
        if (mysqli_query($con, $del_exist_med_cat)) {
        
            foreach ($category_ids as $category_id) {
            //     echo $category; 

                $insert_cat_med = "INSERT INTO MEDICINE_CATEGORY (category_id, medicine_id)
                                    VALUES (".$category_id.", ".$medicine_id.")";
                echo $insert_cat_med;

                if (!mysqli_query($con, $insert_cat_med) ) {

                    echo "Error: " . $sql . "" . mysqli_error($con);
                    echo "All categories were sucessfully entered. Please try again later";
                    echo "<a href='editMedicine.php?medicine_id=".$medicine_id."' >";
                    die();
                }

            }

        
        } else {                    
            
            echo "Error: " . $sql . "" . mysqli_error($con);
            echo "There were problems updating the records. Please try again later";
            echo "<a href='editMedicine.php?medicine_id=".$medicine_id."' >";
            die();
            
        }

        $_SESSION['medicine_id'] = $medicine_id;
        $_SESSION['form_action'] = $form_action;
        header("Location: viewMedicines.php"); // Redirect user to viewMedicines.php

    } else {

            echo "Error: " . $sql . "" . mysqli_error($con);
            echo "<br /><br /> The Medicine record was not sucessfully entered. Please try again later";
            echo "<a href='medicine.php' >";
            die();
    }
        
} else {
       
    // First time hiting the page so set defaults 
   
    //echo "First time here";
    $form_action = $_SESSION['form_action'];
    $error_msg = "";
   
    $medicine_id = $_GET['medicine_id'];
    $query = "SELECT * FROM MEDICINE WHERE medicine_id=".$medicine_id;
        
    //echo "SQL: ".$query;
        
    if ($result = mysqli_query($con, $query)) {
            
        $med_row = mysqli_fetch_array($result);
        
        $cat_med_query = "SELECT category_id FROM MEDICINE_CATEGORY WHERE medicine_id=".$medicine_id;
                     
        $cat_query = "SELECT category_id, category_name FROM CATEGORY";
           
        $options = mysqli_query($con, $cat_query);
                       
        $cat_meds = mysqli_query($con, $cat_med_query);                       
                       
        //$seld_cat_meds = mysqli_fetch_array($cat_meds, MYSQLI_NUM);
        $seld_cat_meds[] = array();                
        while($row = mysqli_fetch_array($cat_meds))
        {
            $seld_cat_meds[] = $row['category_id'];
        }
    }
    $error_msg = "";

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>	Edit Medicine </title>
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body> 
        <div class="menu"> <?php include("nav_menu.php"); ?> </div>
       
        <div class="form">
            
		    <h1> Edit Medicine </h1>
			
		    <form name="form" method="post" action=""> 
			
                <div class="error_msg">  <?php echo $error_msg; ?>   </div>
                
                <p><input type="text" name="medicine_name" value="<?php echo $med_row["medicine_name"]; ?>" required /></p>

                <p><input type="text" name="medicine_desc"  value="<?php echo $med_row["medicine_desc"]; ?>" required /></p>
                
                <p>
                 <select autofocus class="multi_select" name="categories[]" multiple size = 3 required >
                  
                    <?php 
                                 
                        while($option = mysqli_fetch_assoc($options)) {
                           
                           $selected = "";
                           if ( in_array($option['category_id'], $seld_cat_meds) )  { $selected = 'selected'; }
                           
                    ?>
                              <option <?php echo $selected ?> value="<?php echo $option['category_id'] ?>" > 
                                  <?php echo $option['category_name']?>
                              </option>

                    <?php } ?>
                    
                 </select> 
                </p>

                <p><input type="hidden" name="medicine_id" value="<?php echo $med_row["medicine_id"]; ?>"  /></p>
                
                <p><input type="hidden" name="form_action" value="update"  /></p>
			
                <p><input name="Update" type="submit" value="submit" /></p>

		    </form>
		</div>

    	    <br /><br /><br />
    </body>
</html>
