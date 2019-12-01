<?php
 
include("includes.php"); // Contain all necessary include files 


if ( isset($_REQUEST['form_action']) ) {

    $form_action = $_REQUEST['form_action'];
    $error_msg = "";
    
    $medicine_name = $_REQUEST["medicine_name"];
    $medicine_desc = $_REQUEST["medicine_desc"];
    $category_ids= $_REQUEST["categories"];
    

//   echo "Captured Values: ".$medicine_name.", ".$medicine_desc;
//   
//     Retrieving each selected option 
    foreach ($category_ids as $category) 
        echo $category; 

			
    // Put insert code here
    $insert_med = "INSERT INTO MEDICINE (medicine_name, medicine_desc )
                   VALUES ('".$medicine_name."', '".$medicine_desc."');";

    //echo "SQL: ".$insert_med;

    if (mysqli_query($con, $insert_med)) {

        $medicine_id = mysqli_insert_id($con);

        foreach ($category_ids as $category_id) {
        //     echo $category; 
            
            $insert_cat_med = "INSERT INTO MEDICINE_CATEGORY (category_id, medicine_id)
                                VALUES (".$category_id.", ".$medicine_id.")";
            echo $insert_cat_med;
            
            if (!mysqli_query($con, $insert_cat_med) ) {

                echo "Error: " . $sql . "" . mysqli_error($con);
                echo "All categories were sucessfulyy entered. Please try again later";
                echo "<a href='editMedicine.php?medicine_id=".$medicine_id."' >";
                die();
            }
                
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
                 <select class="multi_select" name="categories[]" multiple size = 3 required >
                  
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
